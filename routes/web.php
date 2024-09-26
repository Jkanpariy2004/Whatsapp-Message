<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-whatsapp', [WhatsAppController::class, 'sendWhatsAppMessage']);