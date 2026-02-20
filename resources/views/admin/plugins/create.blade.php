@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Add Plugin</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('plugins.store') }}" method="POST">
            @include('admin.plugins.form')
        </form>
    </div>
</div>

@endsection
