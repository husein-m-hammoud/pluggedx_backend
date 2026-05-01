<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingPlan extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'specs',
        'highlighted',
        'sort_order',
    ];

    protected $casts = [
        'specs'       => 'array',
        'highlighted' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(HostingCategory::class, 'category_id');
    }
}
