@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Add Hosting Plan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('hosting-plans.store') }}" method="POST">
            @include('admin.hosting_plans.form')
        </form>
    </div>
</div>

@endsection
