<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en'); // default en

        $plugins = Plugin::all()->map(function ($plugin) use ($lang) {
            return [
                'id' => $plugin->id,
                'slug' => $plugin->slug,
                'name' => $plugin->{'name_'.$lang},
                'icon' => $plugin->icon,
                'summary' => $plugin->{'summary_'.$lang},
                'description' => $plugin->{'description_'.$lang},
                'features' => $plugin->{'features_'.$lang} ?? [],
                'created_at' => $plugin->created_at,
                'updated_at' => $plugin->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $plugins
        ]);
    }
}