<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\PdfDocumentController;
use App\Http\Controllers\Api\PluginController;



Route::post('/send-email', [FormController::class, 'sendEmail']);

Route::post('pdfs/remote-push', [PdfDocumentController::class, 'receiveRemotePush']);

Route::post('/verify-code', [FormController::class, 'verifyCode']);

Route::post('/request-verification', [FormController::class, 'requestVerification'])
    ->middleware('throttle:5,1');
Route::get('/plugins', [PluginController::class, 'index']);
