<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



Route::get('/', function () {
    return view('welcome');
});


// routes/web.php
use App\Http\Controllers\PdfDocumentController;

Route::resource('pdfs', PdfDocumentController::class);

// AJAX endpoints
Route::post('pdfs/convert-upload', [PdfDocumentController::class, 'convertUpload'])->name('pdfs.convertUpload'); // upload -> pdf2htmlEX -> return html
Route::post('pdfs/check-name', [PdfDocumentController::class, 'checkName'])->name('pdfs.checkName');
Route::post('pdfs/save-html', [PdfDocumentController::class, 'saveHtml'])->name('pdfs.saveHtml'); // save HTML -> convert to pdf

Route::post('pdfs/{pdf}/push-remote', [PdfDocumentController::class, 'pushToRemote'])->name('pdfs.pushToRemote');
Route::get('/pdfs/storage-index', [PdfDocumentController::class, 'storageIndex'])->name('pdfs.storageIndex'); // server only
Route::get('pdfs/storage-view/{filename}', [PdfDocumentController::class, 'storageView'])->name('pdfs.storageView'); // server onlyRoute::get('pdfs/storage-index', [PdfDocumentController::class, 'storageIndex'])->name('pdfs.storageIndex');

Route::get('/pdfs/{pdf}/edit', [PdfDocumentController::class, 'edit'])->name('pdfs.edit');
// Route::post('/pdfs/{pdf}/update', [PdfDocumentController::class, 'update'])->name('pdfs.update');


// Route::get('/proxy-download', function (Request $request) {
//     $url = $request->query('url');

//     $contents = file_get_contents($url);
//     $fileName = basename($url);

//     return response($contents)
//         ->header('Content-Type', 'application/pdf')
//         ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
// });


Route::get('/proxy-download', function (Request $request) {
    $url = $request->query('url');

    abort_unless($url, 400, 'URL is required');

    $response = Http::withHeaders([
        'User-Agent' => 'Mozilla/5.0',
        'Accept' => 'application/pdf',
    ])->get($url);

    abort_unless($response->successful(), 403, 'Cannot fetch file');

    $fileName = basename(parse_url($url, PHP_URL_PATH));

    return response($response->body(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
});