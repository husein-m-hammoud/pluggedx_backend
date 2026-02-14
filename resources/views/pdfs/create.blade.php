@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Create / Edit PDF</h1>

  <div class="row">
    <div class="col-md-12">
      <form id="uploadForm" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label>Upload One IBC PDF</label>
          <input type="file" name="pdf" id="pdfInput" accept="application/pdf" class="form-control"/>
        </div>

        <div class="mb-3">
          <label>Document Name</label>
          <input type="text" id="docName" name="name" class="form-control" />
          <small id="nameWarning" class="text-danger" style="display:none;">Name already exists!</small>
        </div>
      </form>
    </div>
  </div>

  <div class="row" style="height:75vh;">
    <div class="col-md-6" style="overflow:auto; border-right:1px solid #eee;">
      <h5>HTML Editor</h5>

      <!-- Placeholders -->
      <div class="mb-3">
        <h6>Placeholders</h6>
        <div class="d-flex flex-wrap gap-2">
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$color1}}">primary 1 (#163041)</button>
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$color2}}">secondary 2 (#3797a0)</button>
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$color3}}">red 1 (#cd2029)</button>
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$color4}}">red 2 (#df4a5c)</button>
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$logo}}">Logo</button>
          <button type="button" class="btn btn-sm btn-outline-dark copyPlaceholder" data-value="{{$icon}}">Icon</button>

          <button type="button" class="btn btn-sm btn-outline-dark " onclick="changeHeader()" >changeHeader</button>
          <button type="button" class="btn btn-sm btn-outline-dark " onclick="replaceParagraphsAndRemoveFooter()" >replaceParagraphsAndRemoveFooter</button>
          <button type="button" class="btn btn-sm btn-outline-dark " onclick="addPageBreaks()" >addPageBreaks</button>
        </div>
        <div class="mt-3">
    <button id="saveBtn" class="btn btn-primary">Save (Convert to PDF)</button>
  </div>
      </div>

      <!-- Monaco Editor container -->
      <div id="editor1" style="height:60vh; width:100%; border:1px solid #ddd;"></div>
    </div>

    <div class="col-md-6">
      <h5>Live Preview</h5>
      <iframe id="previewFrame" style="width:100%; height:100%; border:1px solid #ddd;"></iframe>
    </div>
  </div>

  
</div>



<div id="loadingOverlay" style="
  display:none;
  position:fixed;
  top:0; left:0; right:0; bottom:0;
  background:rgba(0,0,0,0.4);
  z-index:9999;
  align-items:center;
  justify-content:center;
  color:white;
  font-size:1.5rem;
  backdrop-filter: blur(2px);
">
  <div class="spinner-border text-light" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <span style="margin-left:10px;">Processing...</span>
</div>
<!-- Load Monaco via loader -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.0/min/vs/loader.min.js"></script>

<script>
    let monacoEditor;
    let logo = "{{ $logo }}";

document.querySelectorAll('.copyPlaceholder').forEach(btn => {
  btn.addEventListener('click', () => {
    const value = btn.dataset.value;
    navigator.clipboard.writeText(value);
  });
});
document.addEventListener('DOMContentLoaded', function () {
  const previewFrame = document.getElementById('previewFrame');
  const docName = document.getElementById('docName');
  const saveBtn = document.getElementById('saveBtn');


  // Setup Monaco
  require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.0/min/vs' }});
  require(['vs/editor/editor.main'], function () {
    monacoEditor = monaco.editor.create(document.getElementById("editor1"), {
      value: "<!DOCTYPE html>\n<html>\n<head>\n\t<title>Document</title>\n</head>\n<body>\n\t<h1>Hello World</h1>\n</body>\n</html>",
      language: "html",
      theme: "vs-dark",
      automaticLayout: true
    });

    // Sync Monaco changes to preview
    monacoEditor.onDidChangeModelContent(function () {
      updatePreview();
    });
  });

  // Upload & convert to HTML
  document.getElementById('pdfInput').addEventListener('change', async function() {
    if (!this.files.length) return;
    const f = this.files[0];
    const fd = new FormData();
    fd.append('_token', '{{ csrf_token() }}');
    fd.append('pdf', f);

    var overlay = document.getElementById('loadingOverlay');
  overlay.style.display = 'flex'; // show loader

    const res = await fetch('{{ route('pdfs.convertUpload') }}', { method: 'POST', body: fd });
    const json = await res.json();
     overlay.style.display = 'none'; 
    if (!json.success) {
      alert('Conversion failed: ' + (json.message || ''));
      return;
    }

    // put HTML into Monaco editor
    monacoEditor.setValue(json.html);

    // auto-set document name
    const originalName = json.original_name || f.name;
    docName.value = originalName.replace(/\.[^/.]+$/, "");

    updatePreview();
    window.stored_path = json.stored_path;
    window.original_name = json.original_name;
  });

  function updatePreview() {
    if (!monacoEditor) return;
    const html = `
      <!doctype html>
      <html><head><meta charset="utf-8"></head><body>${monacoEditor.getValue()}</body></html>
    `;
    const blob = new Blob([html], { type: 'text/html' });
    previewFrame.src = URL.createObjectURL(blob);
  }



  // Save (convert to pdf)
  saveBtn.addEventListener('click', async function(e) {
    e.preventDefault();
    if (!monacoEditor) return;
    const name = docName.value.trim();
    if (!name) { alert('Please enter a document name'); return; }

    const payload = {
      name,
      html: monacoEditor.getValue(),
      stored_path: window.stored_path || null,
      original_name: window.original_name || null
    };

        var overlay = document.getElementById('loadingOverlay');
  overlay.style.display = 'flex'; // show loader

    const res = await fetch('{{ route('pdfs.saveHtml') }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(payload)
    });

    const json = await res.json();
      overlay.style.display = 'none';
    if (!json.success) {
      alert('Save failed: ' + (json.message || ''));
      return;
    }
    alert('Saved! You can download at: ' + json.download_url);
    window.location.href = '{{ route('pdfs.index') }}';
  });
});


function changeHeader() {
    if (!monacoEditor) {
        console.error("Monaco editor not found");
        return;
    }
    
    console.log("Changing all headers...");
    
    let content = monacoEditor.getValue();
    const originalContent = content;
    
    // Define the new header with placeholder
    const newHeader = `<div class="header" style="width: 0.00rem; height: 0.00rem; z-index: 0; position: absolute; display: block; left: 0.00rem; top: 0.00rem;">
     <div class="group" style="width: 3.75rem; height: 2.76rem; display: block; left: 5.26rem; top: 2.93rem;">
     @@logo@@
     </div>
    </div>`;
    
    // Count replacements
    let replacementCount = 0;
    
    // Method 1: Simple string replacement for all header divs
    const headerPattern = /<div class="header"[^>]*>[\s\S]*?<\/div>\s*<\/div>/gi;
    
    content = content.replace(headerPattern, function(match) {
        replacementCount++;
        return newHeader;
    });
    
    // If no replacements with first method, try alternative patterns
    if (replacementCount === 0) {
        console.log("Trying alternative patterns...");
        
        const patterns = [
            /<div[^>]*class="header"[^>]*>[\s\S]*?<\/div>\s*<\/div>/gi,
            /<div[^>]*class\s*=\s*["']header["'][^>]*>[\s\S]*?<\/div>/gi
        ];
        
        for (const pattern of patterns) {
            const matches = content.match(pattern);
            if (matches) {
                content = content.replace(pattern, newHeader);
                replacementCount = matches.length;
                break;
            }
        }
    }
    
    // Update editor if changes were made
    if (content !== originalContent) {
        monacoEditor.setValue(content);
        console.log(`Successfully replaced ${replacementCount} headers!`);
    } else {
        console.log("No headers found to replace");
        console.log("Current content sample:", content.substring(0, 200));
    }
}


function replaceParagraphsAndRemoveFooter() {
    if (!monacoEditor) return;
    
    let content = monacoEditor.getValue();
    let replacementCount = 0;
    
    // Find all sections that match the pattern: heading-3 followed by body-texts and another heading-3
    const sectionPattern = /(<p class="paragraph heading-3"[^>]*>[\s\S]*?<\/p>\s*<p class="paragraph body-text"[^>]*>[\s\S]*?<\/p>\s*<p class="paragraph body-text"[^>]*>[\s\S]*?<\/p>\s*<p class="paragraph heading-3"[^>]*>[\s\S]*?<\/p>)([\s\S]*?)(?=<\/div>)/gi;
    
    let match;
    const replacements = [];
    
    // Find all matches
    while ((match = sectionPattern.exec(content)) !== null) {
        const fullSection = match[0];
        const firstHeading3 = match[1];
        const remainingContent = match[2];
        
        // Extract style from the first heading-3
        const styleMatch = firstHeading3.match(/style="([^"]*)"/);
        const originalStyle = styleMatch ? ` style="${styleMatch[1]}"` : '';
        
        // Create replacement content
        const contactContent = `<p class="paragraph heading-3"${originalStyle}><br>
	Phone: + 7 909 366 8325
	<br>
	email: info@Bridgevise.com
	<br>
	Address: 5th Floor, Ashmoun Bldg, Bechara Al Khoury Srt, Beirut, Lebanon
in 15+ countries</p>`;
        
        replacements.push({
            start: match.index,
            end: match.index + fullSection.length,
            content: contactContent
        });
    }
    
    // Apply replacements (backwards to maintain indices)
    for (let i = replacements.length - 1; i >= 0; i--) {
        const replacement = replacements[i];
        const before = content.substring(0, replacement.start);
        const after = content.substring(replacement.end);
        content = before + replacement.content + after;
        replacementCount++;
    }
    
    if (replacementCount > 0) {
        monacoEditor.setValue(content);
        console.log(`Successfully replaced ${replacementCount} contact sections!`);
    } else {
        console.log("No contact sections found matching the pattern");
    }
}

function addPageBreaks() {
    if (!monacoEditor) return;
    
    let content = monacoEditor.getValue();
    let pageBreakCount = 0;
    
    // Find all divs with class "page"
    const pagePattern = /<div[^>]*class="page"[^>]*>/gi;
    let match;
    const pageDivs = [];
    
    // Collect all page divs
    while ((match = pagePattern.exec(content)) !== null) {
        pageDivs.push({
            text: match[0],
            index: match.index
        });
    }
    
    if (pageDivs.length <= 1) {
        console.log("Not enough page divs found (need at least 2)");
        return;
    }
    
    // Add page breaks before all page divs except the first one
    // Process backwards to maintain indices
    for (let i = pageDivs.length - 1; i >= 1; i--) {
        const pageDiv = pageDivs[i];
        const pageBreak = '<div style="page-break-before:always">&nbsp;</div>';
        
        // Insert page break before this page div
        const before = content.substring(0, pageDiv.index);
        const after = content.substring(pageDiv.index);
        content = before + pageBreak + after;
        
        pageBreakCount++;
    }
    
    if (pageBreakCount > 0) {
        monacoEditor.setValue(content);
        console.log(`Added ${pageBreakCount} page breaks before page divs`);
    }
}
</script>

@endsection
