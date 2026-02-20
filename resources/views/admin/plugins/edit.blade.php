@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Plugin</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('plugins.update', $plugin->id) }}" method="POST">
            @method('PUT')
            @include('admin.plugins.form')
        </form>
    </div>
</div>

@endsection
