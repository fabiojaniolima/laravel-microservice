<?php

namespace Tests\Unit\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;
use App\Models\CastMember;
use PHPUnit\Framework\TestCase;

class CastMemberTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $model = new CastMember();

        $this->assertEqualsCanonicalizing([
            'name',
            'type',
        ], $model->getFillable());
    }

    public function test_casts_data_type()
    {
        $model = new CastMember();

        $this->assertEquals('integer', $model->getCasts()['type']);
    }

    public function test_if_softdelete_and_hasuuid_traits_are_being_used()
    {
        $traitNames = (new ReflectionClass(CastMember::class))->getTraitNames();

        $this->assertTrue(!array_diff([SoftDeletes::class, HasUuid::class], $traitNames));
    }
}
