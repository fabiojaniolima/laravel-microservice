<?php

namespace Tests\Feature\Http\Controller;

use App\Models\CastMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\Http\Traits\CrudController;
use Tests\TestCase;

class CastMemberTest extends TestCase
{
    use DatabaseMigrations, CrudController;

    private $model = CastMember::class;

    public function test_index()
    {
        $this->assertIndexMethod([
            'id',
            'name',
            'type',
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
            'type',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_store()
    {
        $this->assertStoreMethod([
            'name' => 'It is a test',
            'type' => CastMember::TYPE_ACTOR,
        ]);
    }

    public function test_destroy()
    {
        $this->assertDestroyMethod();
    }

    public function test_name_and_type_must_be_valid()
    {
        $response = $this->post(route('cast-members.store'), [
            'type' => 'A',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'type'])
            ->assertJsonFragment([
                __('validation.required', ['attribute' => 'name']),
            ])->assertJsonFragment([
                __('validation.integer', ['attribute' => 'type']),
            ]);
    }
}
