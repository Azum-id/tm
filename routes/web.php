<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsrfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScanTicketController;
use App\Http\Controllers\TransactionController;

// Auth Routes
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', fn () => redirect('/'))->middleware('auth')->name('logout');
Route::post('/logout', [LoginController::class, 'logout']);

// Testing Routes
Route::get('/test', function () {
    return "Testing route";
})->middleware('admin');

Route::middleware('gate')->group(function () {
    Route::get('/kasir-simple', function () {
        return "halaman kasir simple";
    });
    Route::resource('scan', ScanTicketController::class)->except(['edit', 'update', 'destroy']);
});

Route::middleware('kasir')->group(function () {
    Route::resource('kasir', TransactionController::class);
});

Route::middleware('admin')->group(function () {
    Route::resource('/admin/user', UserController::class);
    Route::get('admin/tickets', function () {
        $tickets = Ticket::whereDate('created_at', date('Y-m-d'))->get();
        // return $tickets;
        return view('admin.listticket', compact('tickets'));
    });
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Closure based routes
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Public Routes
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/time', function () {
        return date('Y-m-d H:i:s');
    });
    // Basic routes
    Route::get('/validate-token', [CsrfController::class, 'getCsrfToken']);
});
