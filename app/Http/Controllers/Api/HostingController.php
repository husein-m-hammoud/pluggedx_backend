<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VpsPlan;
use App\Models\DedicatedServer;

class HostingController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'vps_plans'         => VpsPlan::orderBy('sort_order')->get(),
                'dedicated_servers' => DedicatedServer::orderBy('sort_order')->get(),
            ],
        ]);
    }
}
