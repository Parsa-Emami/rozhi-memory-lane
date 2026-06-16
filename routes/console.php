<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-rozhi', function () {
    $this->info('Rozhi Memory Lane is ready.');
})->purpose('Show Rozhi project status');
