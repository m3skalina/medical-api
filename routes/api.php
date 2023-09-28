<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\InvoiceController;
use App\Http\Controllers\Api\v1\SaleController;
use App\Http\Controllers\Api\v1\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('auth.')
    ->prefix('auth')
    ->middleware(['api'])
    ->group(
        function () {
            Route::post('/login', LoginController::class)
                ->middleware('guest')
                ->name('login');

        });

Route::group(
    ['middleware' => [
        'auth:api',
    ]],
    function () {

        Route::prefix('services')
            ->name('services.')
            ->group(
                function () {

                    Route::get('/', [ServiceController::class, 'index'])
                        ->name('index');

                    Route::get('/show/{service}', [ServiceController::class, 'show'])
                        ->name('show');

                    Route::post('/store', [ServiceController::class, 'store'])
                        ->name('store');

                    Route::put('/update/{service}', [ServiceController::class, 'update'])
                        ->name('update');

                    Route::patch('/status/{service}', [ServiceController::class, 'updateStatus'])
                        ->name('update_status');

                    Route::delete('/delete/{service}', [ServiceController::class, 'delete'])
                        ->name('delete');

                });

        Route::prefix('sales')
            ->name('sales.')
            ->group(
                function () {

                    Route::get('/', [SaleController::class, 'index'])
                        ->name('index');

                }
            );

        Route::prefix('invoices')
            ->name('invoices.')
            ->group(
                function () {

                    Route::get('/', [InvoiceController::class, 'index'])
                        ->name('index');

                    Route::post('/', [InvoiceController::class, 'store'])
                        ->name('store');
                }
            );

    }
);
