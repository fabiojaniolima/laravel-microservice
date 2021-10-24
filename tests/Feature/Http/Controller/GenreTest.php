<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\Http\Traits\CrudController;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use DatabaseMigrations, CrudController;

    private $model = Genre::class;

    public function test_index()
    {
        $this->assertIndexMethod([
            'id',
            'name',
            'is_active',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_show()
    {
        $this->assertShowMethod([
            'id',
            'name',
            'is_active',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_store()
    {
        $this->assertStoreMethod([
            'name' => 'It is a test',
            'is_active' => false,
        ]);
    }

    public function test_destroy()
    {
        $this->assertDestroyMethod();
    }

    public function test_name_and_is_active_must_be_valid()
    {
        $response = $this->post(route('genres.store'), [
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
}
