<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\Http\Traits\CrudController;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use DatabaseMigrations, CrudController;

    private $model = Video::class;

    public function test_index()
    {
        $this->assertIndexMethod([
            'id',
            'title',
            'description',
            'year_launched',
            'opened',
            'rating',
            'duration',
            'deleted_at',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_show()
    {
        $this->assertShowMethod([
            'id',
            'title',
            'description',
            'year_launched',
            'opened',
            'rating',
            'duration',
            'deleted_at',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_store()
    {
        $this->assertStoreMethod([
            'title' => 'It is a test',
            'description' => 'It is a test',
            'year_launched' => 2021,
            'rating' => 'L',
            'duration' => 120,
        ]);
    }

    public function test_destroy()
    {
        $this->assertDestroyMethod();
    }

    public function test_name_and_type_must_be_valid()
    {
        $response = $this->post(route('videos.store'), [
            'title' => 12,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'year_launched', 'description', 'rating', 'duration'])
            ->assertJsonFragment([
                __('validation.string', ['attribute' => 'title']),
            ])->assertJsonFragment([
                __('validation.required', ['attribute' => 'year launched']),
            ])->assertJsonFragment([
                __('validation.required', ['attribute' => 'description']),
            ])->assertJsonFragment([
                __('validation.required', ['attribute' => 'rating']),
            ])->assertJsonFragment([
                __('validation.required', ['attribute' => 'duration']),
            ]);
    }
}
