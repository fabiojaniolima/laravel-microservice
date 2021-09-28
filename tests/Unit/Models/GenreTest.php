<?php

namespace Tests\Unit\Models;

use App\Models\Genre;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class GenreTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $model = new Genre();

        $this->assertEqualsCanonicalizing([
            'name',
            'is_active',
        ], $model->getFillable());
    }

    public function test_casts_data_type()
    {
        $model = new Genre();

        $this->assertEquals('boolean', $model->getCasts()['is_active']);
    }

    public function test_if_softdelete_and_hasuuid_traits_are_being_used()
    {
        $traitNames = (new ReflectionClass(Genre::class))->getTraitNames();

        $this->assertTrue(!array_diff([SoftDeletes::class, HasUuid::class], $traitNames));
    }
}
