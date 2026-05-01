@csrf

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-select" required>
        <option value="">— Select category —</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $plan->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $plan->name ?? '') }}" required placeholder="e.g. VPS-1">
</div>

<div class="mb-3">
    <label class="form-label">Specs (JSON array)</label>
    <textarea name="specs" class="form-control @error('specs') is-invalid @enderror" rows="8" required
              placeholder='[{"label":"vCPU","value":"6 vCores"},{"label":"RAM","value":"12 GB"}]'>{{ old('specs', isset($plan) ? json_encode($plan->specs, JSON_PRETTY_PRINT) : '') }}</textarea>
    @error('specs')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">Each spec: <code>{"label": "vCPU", "value": "6 vCores"}</code></div>
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control"
           value="{{ old('sort_order', $plan->sort_order ?? 0) }}">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="highlighted" class="form-check-input" id="highlighted" value="1"
           {{ old('highlighted', isset($plan) && $plan->highlighted ? '1' : '0') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="highlighted">Mark as Popular / Highlighted</label>
</div>

<button class="btn btn-success">Save Plan</button>
<a href="{{ route('hosting-plans.index') }}" class="btn btn-secondary">Cancel</a>
