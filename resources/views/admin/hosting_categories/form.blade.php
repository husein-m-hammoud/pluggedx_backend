@csrf

@php
$icons = [
    'Server'    => 'Server — VPS / General',
    'Cpu'       => 'Cpu — Dedicated / High-Performance',
    'Cloud'     => 'Cloud — Cloud Hosting',
    'HardDrive' => 'HardDrive — Storage / Backup',
    'Database'  => 'Database — Database Hosting',
    'Monitor'   => 'Monitor — Remote Desktop / RDP',
    'Globe'     => 'Globe — Web Hosting / CDN',
    'Shield'    => 'Shield — Secure / Protected',
    'Zap'       => 'Zap — High-Speed / Performance',
    'Layers'    => 'Layers — Managed Services',
    'Box'       => 'Box — Container / Docker',
    'Lock'      => 'Lock — Private / Secured',
    'Wifi'      => 'Wifi — Network / Connectivity',
];
$selectedIcon = old('icon', $category->icon ?? 'Server');
@endphp

<div class="mb-3">
    <label class="form-label">Category Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. VPS Plans">
</div>

<div class="mb-3">
    <label class="form-label">Icon</label>
    <select name="icon" class="form-select" required>
        @foreach($icons as $value => $label)
            <option value="{{ $value }}" {{ $selectedIcon === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <div class="form-text">Icon is a <a href="https://lucide.dev/icons/" target="_blank">Lucide</a> icon name shown on the public hosting page.</div>
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control"
           value="{{ old('sort_order', $category->sort_order ?? 0) }}">
</div>

<button class="btn btn-success">Save Category</button>
<a href="{{ route('hosting-categories.index') }}" class="btn btn-secondary">Cancel</a>
