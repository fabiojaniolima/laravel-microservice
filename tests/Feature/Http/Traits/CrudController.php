<?php

namespace Tests\Feature\Http\Traits;

use Illuminate\Support\Str;

trait CrudController
{
    private function getRoutePrefix()
    {
        return Str::lower(Str::plural(substr(strrchr($this->model, "\\"), 1)));
    }

    public function assertIndexMethod(array $fieldStructure)
    {
        $this->model::factory()->count(5)->create();

        $response = $this->get(route($this->getRoutePrefix() . '.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [$fieldStructure]
            ]);
    }

    public function assertShowMethod(array $fieldStructure)
    {
        $model = $this->model::factory(['name' => 'isso é um teste'])->create();
        $response = $this->get(route($this->getRoutePrefix() . '.show', $model->id));

        $response
            ->assertStatus(200)
            ->assertJsonStructure($fieldStructure);
    }

    public function assertStoreMethod(array $params)
    {
        $response = $this->post(route($this->getRoutePrefix() . '.store'), $params);

        $response
            ->assertStatus(201)
            ->assertJsonFragment($params);
        $this->assertTrue(Str::isUuid($response->json('id')));
    }

    public function assertDestroyMethod()
    {
        $model = $this->model::factory()->create();

        $response = $this->delete(route($this->getRoutePrefix() . '.destroy', $model->id));

        $response->assertStatus(204);
        $this->assertNotNull($model->refresh()['deleted_at']);
    }
}
