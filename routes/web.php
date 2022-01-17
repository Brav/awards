<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\AwardNominationController;
use App\Http\Controllers\BackgroundController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\NominationCategoryController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\WinnerController;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/thanks', [App\Http\Controllers\HomeController::class, 'thanks'])->name('thanks');

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

    Route::get('export', [ClinicController::class, 'export'])->name('clinics.export');
});

Route::prefix('user-import')->middleware(['auth', 'admin'])->group(function () {
    Route::get('', [UserImportController::class, 'index'])->name('user-import.index');
    Route::post('', [UserImportController::class, 'import'])->name('user-import.import');
});

Route::prefix('files')->middleware(['auth'])->group(function () {

    Route::delete('delete/{id}', [FilesController::class, 'delete'])->name('file.delete');

});

Route::prefix('nominations')->middleware(['auth'])->group(function () {

    Route::get('', [NominationController::class, 'index'])->name('nominations.index');
    Route::get('create', [NominationController::class, 'create'])->name('nominations.create');
    Route::get('delete/{nomination}', [NominationController::class, 'delete'])->name('nominations.delete');
    Route::get('edit/{nomination}', [NominationController::class, 'edit'])->name('nominations.edit');
    Route::post('store', [NominationController::class, 'store'])->name('nominations.store');
    Route::put('update/{nomination}', [NominationController::class, 'update'])->name('nominations.update');
    Route::delete('destroy/{nomination}', [NominationController::class, 'destroy'])->name('nominations.destroy');
});

Route::prefix('nominations-category')->middleware(['auth'])->group(function () {

    Route::get('', [NominationCategoryController::class, 'index'])
        ->name('nominations-category.index');
    Route::get('create', [NominationCategoryController::class, 'create'])
        ->name('nominations-category.create');
    Route::get('delete/{nominationCategory}', [NominationCategoryController::class, 'delete'])
        ->name('nominations-category.delete');
    Route::get('edit/{nominationCategory}', [NominationCategoryController::class, 'edit'])
        ->name('nominations-category.edit');
    Route::post('store', [NominationCategoryController::class, 'store'])
        ->name('nominations-category.store');
    Route::put('update/{nominationCategory}', [NominationCategoryController::class, 'update'])
        ->name('nominations-category.update');
    Route::delete('destroy/{nominationCategory}', [NominationCategoryController::class, 'destroy'])
        ->name('nominations-category.destroy');
});

Route::prefix('awards')->middleware(['auth'])->group(function () {

    Route::get('', [AwardController::class, 'index'])
        ->name('awards.index');
    Route::get('create', [AwardController::class, 'create'])
        ->name('awards.create');
    Route::get('delete/{award}', [AwardController::class, 'delete'])
        ->name('awards.delete');
    Route::get('edit/{award}', [AwardController::class, 'edit'])
        ->name('awards.edit');
    Route::post('store', [AwardController::class, 'store'])
        ->name('awards.store');
    Route::put('update/{award}', [AwardController::class, 'update'])
        ->name('awards.update');
    Route::delete('destroy/{award}', [AwardController::class, 'destroy'])
        ->name('awards.destroy');

    Route::put('background-set/{award}', [AwardController::class, 'setBackground'])
        ->name('award.background-set');
    Route::delete('background-delete/{award}', [AwardController::class, 'deleteBackground'])
        ->name('award.background-delete');
});

Route::prefix('backgrounds')->middleware(['auth'])->group(function () {

    Route::get('', [BackgroundController::class, 'index'])
        ->name('backgrounds.index');
    Route::get('create', [BackgroundController::class, 'create'])
        ->name('backgrounds.create');
    Route::delete('destroy', [BackgroundController::class, 'destroy'])
        ->name('backgrounds.delete');
    Route::get('edit/{award}', [BackgroundController::class, 'edit'])
        ->name('backgrounds.edit');
    Route::post('store', [BackgroundController::class, 'store'])
        ->name('backgrounds.store');
    Route::put('update', [BackgroundController::class, 'update'])
        ->name('backgrounds.update');
});

Route::prefix('departments')->middleware(['auth'])->group(function () {

    Route::get('', [DepartmentController::class, 'index'])
        ->name('departments.index');
    Route::get('create', [DepartmentController::class, 'create'])
        ->name('departments.create');
    Route::get('delete/{department}', [DepartmentController::class, 'delete'])
        ->name('departments.delete');
    Route::get('edit/{department}', [DepartmentController::class, 'edit'])
        ->name('departments.edit');
    Route::post('store', [DepartmentController::class, 'store'])
        ->name('departments.store');
    Route::put('update/{department}', [DepartmentController::class, 'update'])
        ->name('departments.update');
    Route::delete('destroy/{department}', [DepartmentController::class, 'destroy'])
        ->name('departments.destroy');
});

Route::prefix('award-nominations')->middleware(['auth'])->group(function () {

    Route::get('{award?}', [AwardNominationController::class, 'index'])
        ->name('award-nominations.index');
    Route::get('delete/{awardNomination}', [AwardNominationController::class, 'delete'])
        ->name('award-nominations.delete');
    Route::get('edit/{awardNomination}', [AwardNominationController::class, 'edit'])
        ->name('award-nominations.edit');
    Route::put('update/{awardNomination}', [AwardNominationController::class, 'update'])
        ->name('award-nominations.update');
    Route::delete('destroy/{awardNomination}', [AwardNominationController::class, 'destroy'])
        ->name('award-nominations.destroy');

    Route::put('update/{awardNomination}', [AwardNominationController::class, 'changeWinnerStatus'])
        ->name('award-nominations.winner');

    Route::get('export/{award}',  [AwardNominationController::class, 'export'])->name('award-nominations.export');
});

Route::prefix('winners')->middleware(['auth'])->group(function () {

    Route::get('{winner?}', [WinnerController::class, 'index'])
        ->name('winners.index');
    Route::post('store', [WinnerController::class, 'store'])
        ->name('winners.store');
    Route::get('delete/{winner}', [WinnerController::class, 'delete'])
        ->name('winners.delete');
    Route::get('edit/{winner:award_nomination_id}', [WinnerController::class, 'edit'])
        ->name('winners.edit');
    Route::put('update/{winner}', [WinnerController::class, 'update'])
        ->name('winners.update');
    Route::delete('destroy/{winner:award_nomination_id}', [WinnerController::class, 'destroy'])
        ->name('winners.destroy');

});


Route::prefix('nominate')->group(function () {
    Route::get('{award}', [AwardNominationController::class, 'create'])
        ->name('award-nominations.create');
});

Route::post('award-nominations/store', [AwardNominationController::class, 'store'])
        ->name('award-nominations.store');


