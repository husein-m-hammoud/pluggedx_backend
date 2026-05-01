@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>Hosting Categories</h2>
    <a href="{{ route('hosting-categories.create') }}" class="btn btn-primary">+ Add Category</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Plans</th>
                    <th>Order</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><code>{{ $category->icon }}</code></td>
                        <td>
                            <a href="{{ route('hosting-plans.index', ['category' => $category->id]) }}" class="badge bg-primary text-decoration-none">
                                {{ $category->plans_count }} plans
                            </a>
                        </td>
                        <td>{{ $category->sort_order }}</td>
                        <td>
                            <a href="{{ route('hosting-categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('hosting-categories.destroy', $category->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category and all its plans?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
