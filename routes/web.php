<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resources(['users' => UsersController::class]);
    Route::middleware([
        'can:admin',
    ])->group(function () {
        Route::get('/export-pdf', [UsersController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/checkPDF', [UsersController::class, 'checkPDF'])->name('checkPDF');
        Route::get('/deleteExportPDF', [UsersController::class, 'deleteExportPDF'])->name('deleteExportPDF');
    });
});
