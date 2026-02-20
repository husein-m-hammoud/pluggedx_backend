@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>Plugins</h2>
    <a href="{{ route('plugins.create') }}" class="btn btn-primary">
        + Add Plugin
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name (EN)</th>
                    <th>Name (AR)</th>
                    <th>Slug</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plugins as $plugin)
                    <tr>
                        <td>{{ $plugin->id }}</td>
                        <td>{{ $plugin->name_en }}</td>
                        <td>{{ $plugin->name_ar }}</td>
                        <td>{{ $plugin->slug }}</td>
                        <td>
                            <a href="{{ route('plugins.edit', $plugin->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('plugins.destroy', $plugin->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this plugin?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No plugins found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
