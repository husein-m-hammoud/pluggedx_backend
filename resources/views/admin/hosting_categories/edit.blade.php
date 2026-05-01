@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Hosting Category</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('hosting-categories.update', $hostingCategory->id) }}" method="POST">
            @method('PUT')
            @include('admin.hosting_categories.form', ['category' => $hostingCategory])
        </form>
    </div>
</div>

@endsection
