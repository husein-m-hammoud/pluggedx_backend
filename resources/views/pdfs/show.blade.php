@extends('layouts.app')

@section('content')
<div class="container">
  <h2>{{ $pdf->name }}</h2>
  <iframe src="{{ asset(Str::replaceFirst('public/', 'storage/', $pdf->pdf_path)) }}" style="width:100%; height:80vh;" frameborder="0"></iframe>
</div>
@endsection
