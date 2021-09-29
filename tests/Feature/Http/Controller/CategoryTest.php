<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_list()
    {
        Category::factory()->count(5)->create();

        $response = $this->get(route('categories.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'is_active',
                        'description',
                        'deleted_at',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function test_show()
    {
        $model = Category::factory()->create();
        $response = $this->get(route('categories.show', ['category' => $model->id]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'is_active',
                'description',
                'deleted_at',
                'created_at',
                'updated_at'
            ]);
    }

    public function test_store()
    {
        $response = $this->post(route('categories.store'), [
            'name' => 'It is a test',
            'is_active' => false,
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'is_active' => false,
                'name' => 'It is a test',
            ]);
        $this->assertTrue(Str::isUuid($response->json('id')));
    }

    public function test_name_and_is_active_must_be_valid()
    {
        $response = $this->post(route('categories.store'), [
            'is_active' => 10,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'is_active'])
            ->assertJsonFragment([
                __('validation.required', ['attribute' => 'name']),
            ])->assertJsonFragment([
                __('validation.boolean', ['attribute' => 'is active']),
            ]);
    }

    public function test_destroy()
    {
        $model = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', ['category' => $model->id]));

        $response->assertStatus(204);
        $this->assertNotNull($model->refresh()['deleted_at']);
    }
}
