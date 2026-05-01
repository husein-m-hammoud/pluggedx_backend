@csrf

<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control"
           value="{{ old('slug', $plugin->slug ?? '') }}" required>
</div>

<hr>
<h5>English</h5>

<div class="mb-3">
    <label>Name (EN)</label>
    <input type="text" name="name_en" class="form-control"
           value="{{ old('name_en', $plugin->name_en ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Summary (EN)</label>
    <textarea name="summary_en" class="form-control" required>{{ old('summary_en', $plugin->summary_en ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Description (EN)</label>
    <textarea name="description_en" class="form-control" rows="4" required>{{ old('description_en', $plugin->description_en ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Features (EN) - comma separated</label>
    <input type="text" name="features_en" class="form-control"
           value="{{ old('features_en', isset($plugin) ? implode(',', $plugin->features_en ?? []) : '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Icon</label>
    @php
    $icons = [
        'BarChart3'   => 'BarChart3 — Analytics / Charts',
        'LineChart'   => 'LineChart — Line Charts / Trends',
        'PieChart'    => 'PieChart — Pie / Distribution',
        'TrendingUp'  => 'TrendingUp — Growth / Performance',
        'ArrowUpDown' => 'ArrowUpDown — Trading / Orders',
        'Wallet'      => 'Wallet — Finance / Funds',
        'Users'       => 'Users — Multi-user / Groups',
        'UsersRound'  => 'UsersRound — Team / Community',
        'Shield'      => 'Shield — Security / Protection',
        'ShieldCheck' => 'ShieldCheck — Verified / Compliance',
        'Lock'        => 'Lock — Private / Secured',
        'Network'     => 'Network — Connectivity / Infrastructure',
        'Globe'       => 'Globe — Global / Web',
        'Zap'         => 'Zap — Speed / High-Performance',
        'Settings'    => 'Settings — Configuration / Admin',
        'Clock'       => 'Clock — Time / Scheduling',
        'Copy'        => 'Copy — Copy Trading / Replication',
    ];
    $selected = old('icon', $plugin->icon ?? '');
    @endphp
    <select name="icon" class="form-select">
        <option value="">— No icon —</option>
        @foreach($icons as $value => $label)
            <option value="{{ $value }}" {{ $selected === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <div class="form-text">Icon name maps to a <a href="https://lucide.dev/icons/" target="_blank">Lucide</a> icon shown on the products page.</div>
</div>

<hr>
<h5>Arabic</h5>

<div class="mb-3">
    <label>Name (AR)</label>
    <input type="text" name="name_ar" class="form-control"
           value="{{ old('name_ar', $plugin->name_ar ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Summary (AR)</label>
    <textarea name="summary_ar" class="form-control" required>{{ old('summary_ar', $plugin->summary_ar ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Description (AR)</label>
    <textarea name="description_ar" class="form-control" rows="4" required>{{ old('description_ar', $plugin->description_ar ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Features (AR) - comma separated</label>
    <input type="text" name="features_ar" class="form-control"
           value="{{ old('features_ar', isset($plugin) ? implode(',', $plugin->features_ar ?? []) : '') }}">
</div>

<button class="btn btn-success">
    Save Plugin
</button>

<a href="{{ route('plugins.index') }}" class="btn btn-secondary">
    Cancel
</a>
