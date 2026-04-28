@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>Dedicated Servers</h2>
    <a href="{{ route('dedicated-servers.create') }}" class="btn btn-primary">+ Add Server</a>
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
                @forelse($servers as $server)
                    <tr>
                        <td>{{ $server->id }}</td>
                        <td>{{ $server->name }}</td>
                        <td>
                            @foreach($server->specs as $spec)
                                <span class="badge bg-secondary me-1">{{ $spec['label'] }}: {{ $spec['value'] }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($server->highlighted)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-light text-dark">No</span>
                            @endif
                        </td>
                        <td>{{ $server->sort_order }}</td>
                        <td>
                            <a href="{{ route('dedicated-servers.edit', $server->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('dedicated-servers.destroy', $server->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this server?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No dedicated servers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
