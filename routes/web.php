<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function (): void {
    Route::get('/', 'home')->name('home');
    Route::get('/story', 'story')->name('story');
    Route::get('/memories', 'memories')->name('memories');
    Route::get('/quiz', 'quiz')->name('quiz');
    Route::get('/letter', 'letter')->name('letter');

    Route::post('/letter/unlock', 'unlockLetter')
        ->middleware('throttle:6,1')
        ->name('letter.unlock');

    Route::post('/letter/reply', 'storeLetterReply')
        ->middleware('throttle:4,1')
        ->name('letter.reply');

    Route::get('/future', 'future')->name('future');
    Route::get('/invite', 'invite')->name('invite');
});
