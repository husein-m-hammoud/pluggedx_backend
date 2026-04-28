@csrf

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $vpsPlan->name ?? '') }}" required placeholder="e.g. VPS-1">
</div>

<div class="mb-3">
    <label class="form-label">Specs (JSON array)</label>
    <textarea name="specs" class="form-control" rows="8" required
              placeholder='[{"label":"vCPU","value":"6 vCores"},{"label":"RAM","value":"12 GB RAM"}]'>{{ old('specs', isset($vpsPlan) ? json_encode($vpsPlan->specs, JSON_PRETTY_PRINT) : '') }}</textarea>
    <div class="form-text">Each spec: <code>{"label": "vCPU", "value": "6 vCores"}</code></div>
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control"
           value="{{ old('sort_order', $vpsPlan->sort_order ?? 0) }}">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="highlighted" class="form-check-input" id="highlighted" value="1"
           {{ old('highlighted', isset($vpsPlan) && $vpsPlan->highlighted ? '1' : '0') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="highlighted">Mark as Popular / Highlighted</label>
</div>

<button class="btn btn-success">Save VPS Plan</button>
<a href="{{ route('vps-plans.index') }}" class="btn btn-secondary">Cancel</a>
