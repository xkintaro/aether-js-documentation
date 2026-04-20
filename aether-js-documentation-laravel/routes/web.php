<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use TCG\Voyager\Facades\Voyager;

Route::get('/', function () {
    $defaultLocale = config('app.fallback_locale');
    return redirect($defaultLocale);
});

Route::prefix('/{locale}')
    ->where(['locale' => '[a-z]{2}'])
    ->middleware(['web', 'set.locale'])
    ->group(function () {

        Route::get('/', [SiteController::class, 'index'])->name('index');

        Route::get('/{slug}', [SiteController::class, 'resolve'])
            ->where('slug', '.*')
            ->name('resolver');
    });

Route::group(['prefix' => 'admin', 'middleware' => 'admin.user'], function () {

    Route::get('/clear-cache', function (\Illuminate\Http\Request $request) {

        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');

        return 'Cleaning Successful';
    })->name('admin.clear-cache');

    Route::get('/translations', [\App\Http\Controllers\Admin\TranslationController::class, 'index'])
        ->name('admin.translations.index');

    Route::post('/translations/scan', [\App\Http\Controllers\Admin\TranslationController::class, 'scan'])
        ->name('admin.translations.scan');

    Route::post('/translations/update', [\App\Http\Controllers\Admin\TranslationController::class, 'update'])
        ->name('admin.translations.update');

    Route::delete('/translations/delete', [\App\Http\Controllers\Admin\TranslationController::class, 'delete'])
        ->name('admin.translations.delete');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
