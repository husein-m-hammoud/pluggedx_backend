@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>VPS Plans</h2>
    <a href="{{ route('vps-plans.create') }}" class="btn btn-primary">+ Add VPS Plan</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
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
                        <td>{{ $plan->name }}</td>
                        <td>
                            @foreach($plan->specs as $spec)
                                <span class="badge bg-secondary me-1">{{ $spec['label'] }}: {{ $spec['value'] }}</span>
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
                            <a href="{{ route('vps-plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('vps-plans.destroy', $plan->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this plan?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No VPS plans found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
