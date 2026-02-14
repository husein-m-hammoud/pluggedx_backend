@extends('layouts.app')

@section('content')
<div class="container">
  <h1>PDFs in storage</h1>
  <table class="table">
    <thead><tr><th>Filename</th><th>Size</th><th>Modified</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($items as $it)
      <tr>
        <td>{{ $it['filename'] }}</td>
        <td>{{ number_format($it['size'] / 1024, 2) }} KB</td>
        <td>{{ $it['modified'] }}</td>
        <td>
          <a href="{{ $it['url'] }}" class="btn btn-sm btn-primary" target="_blank">Open</a>
          <a href="{{ route('pdfs.storageView', $it['filename']) }}" class="btn btn-sm btn-secondary" target="_blank">Serve</a>
          <button class="btn btn-sm btn-outline-secondary" onclick="copyUrl('{{ $it['url'] }}')">Copy URL</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
function copyUrl(url) {
  navigator.clipboard.writeText(url).then(()=> alert('Copied!'), ()=> alert('Copy failed'));
}
</script>
@endsection
