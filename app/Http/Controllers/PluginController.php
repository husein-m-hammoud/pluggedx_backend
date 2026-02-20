<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Illuminate\Http\Request;
class PluginController extends Controller
{
    public function index()
{
    $plugins = Plugin::latest()->get();
    return view('admin.plugins.index', compact('plugins'));
}

public function create()
{
    return view('admin.plugins.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'slug' => 'required|unique:plugins',
        'name_en' => 'required',
        'summary_en' => 'required',
        'description_en' => 'required',
        'name_ar' => 'required',
        'summary_ar' => 'required',
        'description_ar' => 'required',
        'icon' => 'nullable|string',
    ]);

    $data['features_en'] = explode(',', $request->features_en);
    $data['features_ar'] = explode(',', $request->features_ar);

    Plugin::create($data);

    return redirect()->route('plugins.index');
}

public function edit(Plugin $plugin)
{
    return view('admin.plugins.edit', compact('plugin'));
}

public function update(Request $request, Plugin $plugin)
{
    $data = $request->validate([
        'slug' => 'required|unique:plugins,slug,' . $plugin->id,
        'name_en' => 'required',
        'summary_en' => 'required',
        'description_en' => 'required',
        'name_ar' => 'required',
        'summary_ar' => 'required',
        'description_ar' => 'required',
        'icon' => 'nullable|string',
    ]);

    $data['features_en'] = explode(',', $request->features_en);
    $data['features_ar'] = explode(',', $request->features_ar);

    $plugin->update($data);

    return redirect()->route('plugins.index');
}

public function destroy(Plugin $plugin)
{
    $plugin->delete();
    return back();
}

}
