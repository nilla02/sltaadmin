<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\EDCardController;
use App\Http\Controllers\ExportAccommodationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SageController;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');

    Route::get('/EDCard-connect', [EDCardController::class, 'connect'])->name('admin.edcard.connect');
    Route::put('/EDCard-connect', [EDCardController::class, 'update'])->name('admin.edcard.connect.update');
    Route::get('/EDCard-accommodation', [EDCardController::class, 'accommodation'])->name('admin.edcard.accommodation');
    Route::post('/EDCard-accommodation', [EDCardController::class, 'accommodation'])->name('admin.edcard.accommodation');


    Route::get('/pending-property', [PropertyController::class, 'penProperty'])->name('admin.penProperty');
    Route::get('/{property}/pending-property', [PropertyController::class, 'onePenProperty'])->name('admin.onePenProperty');
    Route::post('/{property}/pending-property', [PropertyController::class, 'oneAcceptingProperty'])->name('admin.oneAcceptingProperty');
    Route::put('/{property}/pending-property/change', [PropertyController::class, 'formChange'])->name('admin.formChange');

    Route::get('/approved-property', [PropertyController::class, 'appProperty'])->name('admin.appProperty');
    Route::get('/{property}/approved-property', [PropertyController::class, 'oneAppProperty'])->name('admin.oneAppProperty');

    Route::get('/sage-connect', [SageController::class, 'connect'])->name('admin.payment.connect');
    Route::put('/sage-connect', [SageController::class, 'update'])->name('admin.payment.connect.update');
    Route::get('/payment', [PaymentController::class, 'payment'])->name('admin.payment');
    Route::get('/paymentHistory', [PaymentController::class, 'paymentHistory'])->name('admin.paymentHistory');
    Route::get('/batch', [PaymentController::class, 'batch'])->name('admin.batch');
    Route::get('/batch-range', [PaymentController::class, 'batchRange'])->name('admin.batchRange');
    Route::get('/recepits', [PaymentController::class, 'recepits'])->name('admin.recepits');
    Route::get('/{recepit}/recepit', [PaymentController::class, 'recepit'])->name('admin.recepit');
    Route::get('/invoices', [PaymentController::class, 'invoices'])->name('admin.invoices');
    Route::get('/{invoice}/invoice', [PaymentController::class, 'invoice'])->name('admin.invoice');

    Route::get('admin/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::delete('admin/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/admin/report/EDCard-accommodation', [ReportController::class, 'index'])->name('admin.report.edcard.accommodation');
    Route::post('/admin/report/EDCard-accommodation', [ReportController::class, 'index'])->name('admin.report.edcard.accommodation');
    Route::get('/admin/report/EDCard-accommodation-range', [ReportController::class, 'indexrange'])->name('admin.report.edcard.accommodation.range');
    Route::post('/admin/report/EDCard-accommodation-range', [ReportController::class, 'indexrange'])->name('admin.report.edcard.accommodation.range');
    Route::get('/admin/report/levy-accommodation-range', [ReportController::class, 'levyrange'])->name('admin.report.levy.accommodation.range');
    Route::post('/admin/report/levy-accommodation-range', [ReportController::class, 'levyrange'])->name('admin.report.levy.accommodation.range');

    Route::get('/admin/report/export', [ExportAccommodationController::class, 'export'])->name('admin.report.edcard.accommodation.export');
});


Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/sync', [SageController::class, 'sync'])->name('admin.sync');

Auth::routes();
