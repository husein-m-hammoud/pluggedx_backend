<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpsPlan extends Model
{
    protected $fillable = [
        'name',
        'specs',
        'highlighted',
        'sort_order',
    ];

    protected $casts = [
        'specs' => 'array',
        'highlighted' => 'boolean',
    ];
}
