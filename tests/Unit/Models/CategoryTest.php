<?php

namespace Tests\Unit\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;
use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $model = new Category();

        $this->assertEqualsCanonicalizing([
            'name',
            'is_active',
            'description',
        ], $model->getFillable());
    }

    public function test_casts_data_type()
    {
        $model = new Category();

        $this->assertEquals('boolean', $model->getCasts()['is_active']);
    }

    public function test_if_softdelete_and_hasuuid_traits_are_being_used()
    {
        $traitNames = (new ReflectionClass(Category::class))->getTraitNames();

        $this->assertTrue(!array_diff([SoftDeletes::class, HasUuid::class], $traitNames));
    }
}
