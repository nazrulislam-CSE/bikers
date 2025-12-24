<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\StaffController;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\SupplierController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ReceiveController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('logout', [DashboardController::class, 'logout'])->name('user.logout');

    // Staff routes
    // Route::prefix('staffs')->as('staff.')->group(function () {
    //     Route::resource('/', StaffController::class);
    // });

    // Client routes
    // Route::prefix('client')->as('client.')->group(function () {
    //     Route::resource('/', ClientController::class);
    // });

    // // Supplier routes
    // Route::prefix('supplier')->as('supplier.')->group(function () {
    //     Route::resource('/', SupplierController::class);
    // });

    // // Account routes
    // Route::prefix('account')->as('account.')->group(function () {
    //     Route::resource('/', AccountController::class);
    // });

    // // Account routes
    // Route::prefix('receive')->as('receive.')->group(function () {
    //     Route::resource('/', ReceiveController::class);
    // });

    //  // Account routes
    //  Route::prefix('expense')->as('expense.')->group(function () {
    //     Route::resource('/', ExpenseController::class);
    // });

    //  // Account routes

    /* ============> Manage Applicant   <=========== */
    Route::prefix('applicants')->group(function () {
        Route::get('/index', [ApplicantController::class, 'index'])->name('applicant.index');
        Route::get('/create', [ApplicantController::class, 'create'])->name('applicant.create');
        Route::post('/store', [ApplicantController::class, 'store'])->name('applicant.store');
        Route::get('/edit/{id}', [ApplicantController::class, 'edit'])->name('applicant.edit');
        Route::post('/update/{id}', [ApplicantController::class, 'update'])->name('applicant.update');
        Route::get('/delete/{id}', [ApplicantController::class, 'destroy'])->name('applicant.delete');
        Route::get('/show/{id}', [ApplicantController::class,'show'])->name('applicant.show');

    });

    /* ============> Configuration <=========== */
    Route::group(['prefix'=>'settings'], function(){      
        Route::get('/profile/view', [SettingController::class, 'profileView'])->name('profile.view');     
        Route::post('/profile/update', [SettingController::class, 'profileUpdate'])->name('profile.update');     
        Route::get('/password/change', [SettingController::class, 'passwordChange'])->name('password.change');   
        Route::post('/password/update', [SettingController::class, 'passwordUpdate'])->name('password.update');   
    });

    /* ============> Manage Supplier   <=========== */
    Route::prefix('supplier')->group(function () {
        Route::get('/index', [AgentSupplierController::class, 'index'])->name('supplier.index');
        Route::get('/create', [AgentSupplierController::class, 'create'])->name('supplier.create');
        Route::post('/store', [AgentSupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [AgentSupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}', [AgentSupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{id}', [AgentSupplierController::class, 'destroy'])->name('supplier.delete');
        Route::get('/show/{id}', [AgentSupplierController::class,'show'])->name('supplier.show');
        Route::get('/get-supplier-phone/{id}', [AgentSupplierController::class, 'getPhone']);

    });

    /* ============> Manage Supplier Invoice   <=========== */
    Route::prefix('supplier/invoice')->group(function () {
        Route::get('/index', [AgentSupplierInvoiceController::class, 'index'])->name('supplier.invoice.index');
        Route::get('/create', [AgentSupplierInvoiceController::class, 'create'])->name('supplier.invoice.create');
        Route::post('/store', [AgentSupplierInvoiceController::class, 'store'])->name('supplier.invoice.store');
        Route::get('/edit/{id}', [AgentSupplierInvoiceController::class, 'edit'])->name('supplier.invoice.edit');
        Route::post('/update/{id}', [AgentSupplierInvoiceController::class, 'update'])->name('supplier.invoice.update');
        Route::get('/delete/{id}', [AgentSupplierInvoiceController::class, 'destroy'])->name('supplier.invoice.delete');
        Route::get('/show/{id}', [AgentSupplierInvoiceController::class,'show'])->name('supplier.invoice.show');

    });
});
