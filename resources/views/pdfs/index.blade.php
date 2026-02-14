@extends('layouts.app')

@section('content')
<div class="container">
  <h1>PDFs</h1>
  <a href="{{ route('pdfs.create') }}" class="btn btn-success mb-3">Add PDF</a>
  <a href="{{ route('pdfs.storageIndex') }}" class="btn btn-info mb-3">View Storage</a>


  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Preview</th>
        <th>Actions</th>
        <th>Pushed</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pdfs as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td>
          <a href="{{ route('pdfs.show', $p) }}" target="_blank">Open</a>
        </td>
        <td>
          <button
            onclick="copyName('{{ asset(Str::replaceFirst('public/', 'storage/', $p->pdf_path)) }}')"
            class="btn btn-sm btn-outline-secondary">
            Copy URL
          </button>

          <a href="{{ asset(Str::replaceFirst('public/', 'storage/', $p->pdf_path)) }}"
            target="_blank"
            class="btn btn-sm btn-primary">
            View PDF URL
          </a>

          <a href="{{ asset(Str::replaceFirst('public/', 'storage/', $p->pdf_path)) }}" class="btn btn-sm btn-primary" target="_blank">Download</a>

          <form action="{{ route('pdfs.destroy', $p) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>

          <form action="{{ route('pdfs.pushToRemote', $p) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-warning">{{ $p->is_pushed ? 'Repush' : 'Push to Server' }}</button>
          </form>


        </td>
        <td>
          @if($p->is_pushed)
          <span class="badge badge-success">Pushed</span>
          <small class="text-muted d-block">at {{ optional($p->pushed_at)->format('Y-m-d H:i') }}</small>
          @else
          <span class="badge badge-danger">Not pushed</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $pdfs->links() }}
</div>

<script>
  function copyName(text) {
    navigator.clipboard.writeText(text);
  }
</script>
@endsection