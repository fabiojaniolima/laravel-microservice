<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CastMember extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    const TYPE_ACTOR = 1;
    const TYPE_DIRECTOR = 2;

    protected $fillable = [
        'name',
        'type',
    ];

    protected $casts = [
        'type' => 'integer',
    ];
}
