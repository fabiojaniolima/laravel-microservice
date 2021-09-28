<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create()
    {
        $model = Category::factory([
            'is_active' => false,
            'description' => null
        ])->create();

        $this->assertTrue(Str::isUuid($model->id->toString()));
        $this->assertFalse($model->is_active);
        $this->assertIsString($model->name);
        $this->assertNull($model->description);
    }

    public function test_list()
    {
        Category::factory()->create();

        $model = Category::first();
        $attributes = array_keys($model->getAttributes());

        $this->assertEqualsCanonicalizing([
            'is_active',
            'name',
            'description',
            'id',
            'deleted_at',
            'updated_at',
            'created_at',
        ], $attributes);
    }

    public function test_update()
    {
        $model_old = Category::factory()->create();

        $model_new = clone $model_old;
        $model_new->update(['name' => 'old value here!']);

        $model_new = $model_new->toArray();
        $model_old = $model_old->toArray();

        $this->assertNotEquals($model_old['name'], $model_new['name']);
        $this->assertTrue(Carbon::parse($model_new['updated_at'])->gte(Carbon::parse($model_old['updated_at'])));

        unset($model_new['name'], $model_old['name']);
        unset($model_new['updated_at'], $model_old['updated_at']);

        $this->assertEqualsCanonicalizing($model_old, $model_new);
    }

    public function test_soft_delete()
    {
        $model = Category::factory()->create();
        $model->delete();

        $this->assertTrue($model->trashed());
    }
}
