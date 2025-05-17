<?php

use App\Http\Controllers\ProfileController;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

        Route::get('/admin/list', function () {
        return view('admin.list');
    })->name('admin.list');

Route::get('/admin/users-data', function () {
    return response()->json([
        'data' => User::select('id', 'name', 'email')->get()
    ]);

});
        Route::get('/admin/itemlisting', function () {
        return view('admin.itemlisting');
    })->name('admin.itemlisting');

Route::get('/admin/item-data', function () {
    return DataTables::of(Item::select('id', 'name'))
        ->addIndexColumn() 
        ->make(true);
})->name('admin.items.data');

});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

