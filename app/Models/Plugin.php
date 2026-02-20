<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Plugin extends Model
{
    protected $fillable = [
        'slug',
        'name_en',
        'summary_en',
        'description_en',
        'name_ar',
        'summary_ar',
        'description_ar',
        'features_en',
        'features_ar',
        'icon',
    ];

    protected $casts = [
        'features_en' => 'array',
        'features_ar' => 'array',
    ];
}
