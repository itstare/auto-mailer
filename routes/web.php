<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\ErrorController;

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

Route::get('/', [MailerController::class, 'index'])->name('home');
Route::post('/send', [MailerController::class, 'send'])->name('send');

//Email routes
Route::get('/email/import', [EmailController::class, 'import'])->name('email.import');
Route::post('/email/import/upload', [EmailController::class, 'upload'])->name('email.upload');
Route::get('/email/create', [EmailController::class, 'create'])->name('email.create');
Route::post('/email/insert', [EmailController::class, 'insert'])->name('email.insert');
Route::get('/email', [EmailController::class, 'index'])->name('email.index');
Route::get('/email/edit/{id}', [EmailController::class, 'edit'])->name('email.edit');
Route::post('/email/update/{id}', [EmailController::class, 'update'])->name('email.update');
Route::get('/email/delete/{id}', [EmailController::class, 'delete'])->name('email.delete');
Route::get('/email/reset/{id}', [EmailController::class, 'reset'])->name('email.reset');
Route::get('/email/reset-all', [EmailController::class, 'resetAll'])->name('email.reset-all');
Route::get('/email/delete-all', [EmailController::class, 'deleteAll'])->name('email.delete-all');
Route::get('/email/search', [EmailController::class, 'search'])->name('email.search');

//Template routes
Route::get('/template/create', [TemplateController::class, 'create'])->name('template.create');
Route::post('/template/insert', [TemplateController::class, 'insert'])->name('template.insert');
Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
Route::get('/template/view/{id}', [TemplateController::class, 'view'])->name('template.view');
Route::get('/template/edit/{id}', [TemplateController::class, 'edit'])->name('template.edit');
Route::post('/template/update/{id}', [TemplateController::class, 'update'])->name('template.update');
Route::get('/template/delete/{id}', [TemplateController::class, 'delete'])->name('template.delete');
Route::get('/template/search', [TemplateController::class, 'search'])->name('template.search');
Route::get('/template/delete-all', [TemplateController::class, 'deleteAll'])->name('template.delete-all');

//List routes
Route::get('/list/import', [ListController::class, 'import'])->name('list.import');
Route::post('/list/import/upload', [ListController::class, 'upload'])->name('list.upload');
Route::get('/list', [ListController::class, 'index'])->name('list.index');
Route::get('/list/delete-all', [ListController::class, 'deleteAll'])->name('list.delete-all');
Route::get('/list/search', [ListController::class, 'search'])->name('list.search');
Route::get('/list/{id}', [ListController::class, 'view'])->name('list.view');
Route::get('/list/edit/{id}', [ListController::class, 'edit'])->name('list.edit');
Route::post('/list/update/{id}', [ListController::class, 'update'])->name('list.update');
Route::get('/list/delete/{id}', [ListController::class, 'delete'])->name('list.delete');

//Customer routes
Route::get('/customer/search/{id}', [CustomerController::class, 'search'])->name('customer.search');
Route::get('/customer/reset-all/{id}', [CustomerController::class, 'resetAll'])->name('customer.resetAll');
Route::get('/customer/delete/{listId}/{id}', [CustomerController::class, 'delete'])->name('customer.delete');

//Error routes
Route::get('/error-logs', [ErrorController::class, 'index'])->name('error.index');
Route::get('/error-logs/delete/{id}', [ErrorController::class, 'delete'])->name('error.delete');
Route::get('/error-logs/delete-all', [ErrorController::class, 'deleteAll'])->name('error.delete-all');
Route::get('/error-logs/view/{id}', [ErrorController::class, 'view'])->name('error.view');
Route::get('/error-logs/delete-all-errors/{id}', [ErrorController::class, 'deleteAllErrors'])->name('error.delete-all-errors');
Route::get('/error-logs/delete-error/{id}/{sessionId}', [ErrorController::class, 'deleteError'])->name('error.delete-error');

//File manager routes
 Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });