@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Hosting Plan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('hosting-plans.update', $hostingPlan->id) }}" method="POST">
            @method('PUT')
            @include('admin.hosting_plans.form', ['plan' => $hostingPlan])
        </form>
    </div>
</div>

@endsection
