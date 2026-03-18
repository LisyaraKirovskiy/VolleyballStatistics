<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::delete('/players/{player}/scores/clear', [ScoreController::class, 'clearAllScores'])
    ->name('players.scores.clearAllScores');
Route::get('/', function () {
    return redirect()->route('players.index');
});
Route::resource('players', PlayerController::class);
Route::resource('players.scores', ScoreController::class)->only(['store', 'destroy']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
