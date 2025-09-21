<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function (Request $request) {
    $h = $request->get('help');
    if ($h) {
        App\Helps\Example::$help = $h;
    }

    return response()->json([
        'pong' => true,
        'message' => 'Admins',
        'helpValue' => App\Helps\Example::help(),
        'users' => \App\Models\User::query()->get()
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
