<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/admin/update-user/{id}', function ($id, Request $request) {
    $user = User::findOrFail($id);
    $user->update($request->only('name', 'email'));
    return response()->json(['message' => 'User updated successfully.']);
});

});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

