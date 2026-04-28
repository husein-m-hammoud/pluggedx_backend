<?php

namespace App\Http\Controllers;

use App\Models\DedicatedServer;
use Illuminate\Http\Request;

class DedicatedServerController extends Controller
{
    public function index()
    {
        $servers = DedicatedServer::orderBy('sort_order')->get();
        return view('admin.dedicated_servers.index', compact('servers'));
    }

    public function create()
    {
        return view('admin.dedicated_servers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        DedicatedServer::create([
            'name'        => $request->name,
            'specs'       => json_decode($request->specs, true) ?? [],
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('dedicated-servers.index');
    }

    public function edit(DedicatedServer $dedicatedServer)
    {
        return view('admin.dedicated_servers.edit', compact('dedicatedServer'));
    }

    public function update(Request $request, DedicatedServer $dedicatedServer)
    {
        $request->validate([
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        $dedicatedServer->update([
            'name'        => $request->name,
            'specs'       => json_decode($request->specs, true) ?? [],
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('dedicated-servers.index');
    }

    public function destroy(DedicatedServer $dedicatedServer)
    {
        $dedicatedServer->delete();
        return back();
    }
}
