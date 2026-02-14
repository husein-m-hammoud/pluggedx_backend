@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Edit PDF</h1>

  <input type="hidden" id="pdfId" value="{{ $pdf->id }}">

  <div class="mb-3">
    <label>Document Name</label>
    <input type="text" id="docName" class="form-control" value="{{ $pdf->name }}" />
  </div>

  <div class="row" style="height:75vh;">
    <div class="col-md-6" style="overflow:auto; border-right:1px solid #eee;">
      <h5>HTML Editor</h5>

      <div class="mt-3 mb-3">
        <button id="updateBtn" class="btn btn-success">Update PDF</button>
      </div>

      <div id="editor1" style="height:60vh; width:100%; border:1px solid #ddd;"></div>
    </div>

    <div class="col-md-6">
      <h5>Live Preview</h5>
      <iframe id="previewFrame" style="width:100%; height:100%; border:1px solid #ddd;"></iframe>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.0/min/vs/loader.min.js"></script>

<script>
let monacoEditor;

document.addEventListener('DOMContentLoaded', function () {

  const previewFrame = document.getElementById('previewFrame');
  const docName = document.getElementById('docName');
  const updateBtn = document.getElementById('updateBtn');
  const pdfId = document.getElementById('pdfId').value;

  require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.0/min/vs' }});

  require(['vs/editor/editor.main'], function () {

    monacoEditor = monaco.editor.create(document.getElementById("editor1"), {
      value: @json($pdf->html),
      language: "html",
      theme: "vs-dark",
      automaticLayout: true
    });

    monacoEditor.onDidChangeModelContent(function () {
      updatePreview();
    });

    updatePreview();
  });

  function updatePreview() {
    if (!monacoEditor) return;

    const html = `
      <!doctype html>
      <html>
      <head><meta charset="utf-8"></head>
      <body>${monacoEditor.getValue()}</body>
      </html>
    `;

    const blob = new Blob([html], { type: 'text/html' });
    previewFrame.src = URL.createObjectURL(blob);
  }

  updateBtn.addEventListener('click', async function(e) {
    e.preventDefault();

    const name = docName.value.trim();
    if (!name) {
      alert('Please enter a document name');
      return;
    }

    const payload = {
      name: name,
      html: monacoEditor.getValue()
    };

    const res = await fetch(`/pdfs/${pdfId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(payload)
    });

    const json = await res.json();

    if (!json.success) {
      alert('Update failed: ' + (json.message || ''));
      return;
    }

    alert('PDF updated successfully');
    window.location.href = '{{ route('pdfs.index') }}';
  });

});
</script>

@endsection
