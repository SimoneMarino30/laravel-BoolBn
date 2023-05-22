<?php

// * Auth
// use App\Http\Controllers\ProfileController;

// * Admin
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\UserDetailController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// * Rotte risorse autenticate
Route::middleware('auth')
->prefix('/admin')
->name('admin.')
->group(function () {

    // * Risorsa Apartment
    
    // Delete form image
    Route::delete('apartments/{apartment}/delete-image', [ApartmentController::class, 'deleteimage'])->name('apartments.deleteimage');
    
    Route::resource('apartments', ApartmentController::class);

    
    // * Message softDelete
    Route::get('messages/trash', [MessageController::class, 'trash'])->name('messages.trash');
    Route::put('messages/{message}/restore', [MessageController::class, 'restore'])->name('messages.restore');
    Route::delete('messages/{message}/forcedelete', [MessageController::class, 'forcedelete'])->name('messages.forcedelete');

    // * Risorsa Message
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    
    // * Risorsa UserDetail
    Route::resource('user_details', UserDetailController::class)->only(['update', 'edit', 'index']);

    // * Risorsa Service
    Route::resource('services', ServiceController::class)->only('edit');

    // * Risorsa Sponsor
    Route::resource('sponsors', SponsorController::class)->only('index');
});



// Route::middleware('auth')->group(function () {
//     Route::get(     '/profile', [ProfileController::class, 'edit'       ])->name('profile.edit');
//     Route::patch(   '/profile', [ProfileController::class, 'update'     ])->name('profile.update');
//     Route::delete(  '/profile', [ProfileController::class, 'destroy'    ])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';