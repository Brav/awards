<?php

use App\Http\Controllers\AutomatedResponseController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->middleware(['auth'])->group(function () {

    Route::get('', [UserController::class, 'index'])->name('users.index');
    Route::get('create', [UserController::class, 'create'])->name('users.create');
    Route::get('delete/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('store', [UserController::class, 'store'])->name('users.store');
    Route::put('update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'admin']], function () {

    Route::get('', [RolesController::class, 'index'])->name('roles.index');
    Route::get('create', [RolesController::class, 'create'])->name('roles.create');
    Route::get('delete/{roles}', [RolesController::class, 'delete'])->name('roles.delete');
    Route::get('edit/{roles}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    Route::put('update/{roles}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('destroy/{roles}', [RolesController::class, 'destroy'])->name('roles.destroy');

});

Route::prefix('clinic')->middleware(['auth'])->group(function () {

    Route::get('', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::get('delete/{clinic}', [ClinicController::class, 'delete'])->name('clinics.delete');
    Route::get('edit/{clinic}', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::post('store', [ClinicController::class, 'store'])->name('clinics.store');
    Route::put('update/{clinic}', [ClinicController::class, 'update'])->name('clinics.update');
    Route::delete('destroy/{clinic}', [ClinicController::class, 'destroy'])->name('clinics.destroy');
});

Route::prefix('user-import')->middleware(['auth', 'admin'])->group(function () {
    Route::get('', [UserImportController::class, 'index'])->name('user-import.index');
    Route::post('', [UserImportController::class, 'import'])->name('user-import.import');
});

Route::prefix('files')->middleware(['auth'])->group(function () {

    Route::delete('delete/{id}', [FilesController::class, 'delete'])->name('file.delete');

});
