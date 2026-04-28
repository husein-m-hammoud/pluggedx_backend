@csrf

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $dedicatedServer->name ?? '') }}" required placeholder="e.g. Offer 1">
</div>

<div class="mb-3">
    <label class="form-label">Specs (JSON array)</label>
    <textarea name="specs" class="form-control" rows="10" required
              placeholder='[{"label":"CPU","value":"AMD EPYC 4244P"},{"label":"RAM","value":"32 GB"}]'>{{ old('specs', isset($dedicatedServer) ? json_encode($dedicatedServer->specs, JSON_PRETTY_PRINT) : '') }}</textarea>
    <div class="form-text">Each spec: <code>{"label": "CPU", "value": "AMD EPYC 4244P"}</code></div>
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control"
           value="{{ old('sort_order', $dedicatedServer->sort_order ?? 0) }}">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="highlighted" class="form-check-input" id="highlighted" value="1"
           {{ old('highlighted', isset($dedicatedServer) && $dedicatedServer->highlighted ? '1' : '0') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="highlighted">Mark as Popular / Highlighted</label>
</div>

<button class="btn btn-success">Save Server</button>
<a href="{{ route('dedicated-servers.index') }}" class="btn btn-secondary">Cancel</a>
