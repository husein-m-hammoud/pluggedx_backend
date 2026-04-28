@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit VPS Plan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('vps-plans.update', $vpsPlan->id) }}" method="POST">
            @method('PUT')
            @include('admin.vps_plans.form')
        </form>
    </div>
</div>

@endsection
