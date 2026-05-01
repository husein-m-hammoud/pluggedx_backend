<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HostingCategory;

class HostingController extends Controller
{
    public function index()
    {
        $categories = HostingCategory::with(['plans' => function ($q) {
            $q->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        return response()->json([
            'success' => true,
            'data'    => $categories,
        ]);
    }
}
