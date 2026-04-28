@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Add VPS Plan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('vps-plans.store') }}" method="POST">
            @include('admin.vps_plans.form')
        </form>
    </div>
</div>

@endsection
