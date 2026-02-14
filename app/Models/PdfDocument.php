<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfDocument extends Model
{
   protected $fillable = [
        'name','slug','pdf_path','original_pdf_path','original_filename',
        'html','mime','size','created_by','is_pushed','pushed_at'
    ];

    protected $casts = [
        'is_pushed' => 'boolean',
        'pushed_at' => 'datetime',
    ];
}
