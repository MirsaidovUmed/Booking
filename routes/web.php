<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
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
    return view('index');
})->name('index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'getHotelById'])->name('hotels.show');

Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('/room/{id}', [RoomController::class, 'getRoomById'])->name('room.getRoomById');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/hotels', [HotelController::class, 'store']);
    Route::put('/hotels/{id}', [HotelController::class, 'update']);
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);

    Route::post('/rooms', [RoomController::class, 'store']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
});

Route::middleware('auth')->group(function(){
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.delete');
});
