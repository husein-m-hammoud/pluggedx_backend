<?php

namespace App\Http\Controllers;

use App\Models\HostingCategory;
use App\Models\HostingPlan;
use Illuminate\Http\Request;

class HostingPlanController extends Controller
{
    public function index()
    {
        $plans = HostingPlan::with('category')->orderBy('category_id')->orderBy('sort_order')->get();
        return view('admin.hosting_plans.index', compact('plans'));
    }

    public function create()
    {
        $categories = HostingCategory::orderBy('sort_order')->get();
        return view('admin.hosting_plans.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:hosting_categories,id',
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        $specs = $this->decodeSpecs($request->specs);
        if ($specs === null) {
            return back()->withErrors(['specs' => 'Specs must be a JSON array of objects, e.g. [{"label":"vCPU","value":"6 vCores"}]'])->withInput();
        }

        HostingPlan::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'specs'       => $specs,
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('hosting-plans.index')->with('success', 'Plan created.');
    }

    public function edit(HostingPlan $hostingPlan)
    {
        $categories = HostingCategory::orderBy('sort_order')->get();
        return view('admin.hosting_plans.edit', compact('hostingPlan', 'categories'));
    }

    public function update(Request $request, HostingPlan $hostingPlan)
    {
        $request->validate([
            'category_id' => 'required|exists:hosting_categories,id',
            'name'        => 'required|string',
            'specs'       => 'required|string',
            'highlighted' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        $specs = $this->decodeSpecs($request->specs);
        if ($specs === null) {
            return back()->withErrors(['specs' => 'Specs must be a JSON array of objects, e.g. [{"label":"vCPU","value":"6 vCores"}]'])->withInput();
        }

        $hostingPlan->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'specs'       => $specs,
            'highlighted' => $request->boolean('highlighted'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('hosting-plans.index')->with('success', 'Plan updated.');
    }

    public function destroy(HostingPlan $hostingPlan)
    {
        $hostingPlan->delete();
        return back()->with('success', 'Plan deleted.');
    }

    /**
     * Decode and validate the specs JSON input.
     * Returns the decoded array, or null if invalid.
     */
    private function decodeSpecs(string $raw): ?array
    {
        $decoded = json_decode($raw, true);

        if (!is_array($decoded)) {
            return null;
        }

        foreach ($decoded as $item) {
            if (!is_array($item) || !array_key_exists('label', $item) || !array_key_exists('value', $item)) {
                return null;
            }
        }

        return $decoded;
    }
}
