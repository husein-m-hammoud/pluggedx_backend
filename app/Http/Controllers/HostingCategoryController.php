<?php

namespace App\Http\Controllers;

use App\Models\HostingCategory;
use Illuminate\Http\Request;

class HostingCategoryController extends Controller
{
    public function index()
    {
        $categories = HostingCategory::withCount('plans')->orderBy('sort_order')->get();
        return view('admin.hosting_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.hosting_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'icon'       => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        HostingCategory::create([
            'name'       => $request->name,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('hosting-categories.index')->with('success', 'Category created.');
    }

    public function edit(HostingCategory $hostingCategory)
    {
        return view('admin.hosting_categories.edit', compact('hostingCategory'));
    }

    public function update(Request $request, HostingCategory $hostingCategory)
    {
        $request->validate([
            'name'       => 'required|string',
            'icon'       => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $hostingCategory->update([
            'name'       => $request->name,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('hosting-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(HostingCategory $hostingCategory)
    {
        $hostingCategory->delete();
        return back()->with('success', 'Category deleted.');
    }
}
