<?php

namespace App\Http\Controllers;

use App\Models\VpsPlan;
use Illuminate\Http\Request;

class VpsPlanController extends Controller
{
    public function index()
    {
        $plans = VpsPlan::orderBy('sort_order')->get();
        return view('admin.vps_plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.vps_plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        VpsPlan::create([
            'name'        => $request->name,
            'specs'       => json_decode($request->specs, true) ?? [],
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('vps-plans.index');
    }

    public function edit(VpsPlan $vpsPlan)
    {
        return view('admin.vps_plans.edit', compact('vpsPlan'));
    }

    public function update(Request $request, VpsPlan $vpsPlan)
    {
        $request->validate([
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        $vpsPlan->update([
            'name'        => $request->name,
            'specs'       => json_decode($request->specs, true) ?? [],
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('vps-plans.index');
    }

    public function destroy(VpsPlan $vpsPlan)
    {
        $vpsPlan->delete();
        return back();
    }
}
