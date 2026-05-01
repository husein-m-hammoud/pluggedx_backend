@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Add Hosting Category</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('hosting-categories.store') }}" method="POST">
            @include('admin.hosting_categories.form')
        </form>
    </div>
</div>

@endsection
