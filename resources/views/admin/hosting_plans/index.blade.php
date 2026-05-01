@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>Hosting Plans</h2>
    <a href="{{ route('hosting-plans.create') }}" class="btn btn-primary">+ Add Plan</a>
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
                    <th>Category</th>
                    <th>Name</th>
                    <th>Specs</th>
                    <th>Highlighted</th>
                    <th>Order</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td><span class="badge bg-info text-dark">{{ $plan->category->name }}</span></td>
                        <td>{{ $plan->name }}</td>
                        <td>
                            @foreach($plan->specs as $spec)
                                @if(is_array($spec) && isset($spec['label'], $spec['value']))
                                    <span class="badge bg-secondary me-1">{{ $spec['label'] }}: {{ $spec['value'] }}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($plan->highlighted)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-light text-dark">No</span>
                            @endif
                        </td>
                        <td>{{ $plan->sort_order }}</td>
                        <td>
                            <a href="{{ route('hosting-plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('hosting-plans.destroy', $plan->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this plan?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No plans found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
