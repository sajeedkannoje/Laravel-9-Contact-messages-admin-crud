<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ContactFormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('contact-from', [ContactFormController::class, 'store'])->name('contact.store');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //admin login routes 
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', function () {  return view('admin.home');})->name('adminDashboard');
        Route::get('/users', [AdminAuthController::class, 'getUsers'])->name('admin.users');
        Route::get('/user/{user}/edit', [AdminAuthController::class, 'getUser'])->name('admin.user.edit');
        Route::post('/user/{user}/update', [AdminAuthController::class, 'updateUser'])->name('admin.user.update');
        // contact information 
        Route::get('/contact-info',  [AdminAuthController::class, 'getContactFormInfo'])->name('admin.contacts.info');
        Route::get('/contact/{contact}/view', [AdminAuthController::class, 'getContact'])->name('admin.contact.view');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
