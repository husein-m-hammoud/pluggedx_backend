<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingCategory extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'sort_order',
    ];

    public function plans()
    {
        return $this->hasMany(HostingPlan::class, 'category_id')->orderBy('sort_order');
    }
}
