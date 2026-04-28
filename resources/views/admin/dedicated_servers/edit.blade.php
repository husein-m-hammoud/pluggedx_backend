@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Dedicated Server</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('dedicated-servers.update', $dedicatedServer->id) }}" method="POST">
            @method('PUT')
            @include('admin.dedicated_servers.form')
        </form>
    </div>
</div>

@endsection
