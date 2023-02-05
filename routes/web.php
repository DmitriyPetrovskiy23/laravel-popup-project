<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopupAdminController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/',[PopupAdminController::class,'index'])->name('popup_admin');
Route::match(['get','post'],'/popupadmin',[PopupAdminController::class,'index'])->name('popup_admin');

//! Страница создания попапа
Route::match(['get','post'],'/popupadmin/create',[PopupAdminController::class,'popup_admin_create'])->name('popup_admin_create');
    //? Создать попап
    Route::match(['get','post'],'/popupadmin/create/submit',[PopupAdminController::class,'popup_admin_create_submit'])->name('popup_admin_create_submit');

//! Страница редактирования попапа
Route::match(['get','post'],'/popupadmin/edit/{id}',[PopupAdminController::class,'popup_admin_edit'])->name('popup_admin_edit');
    //? Редактировать попап
    Route::match(['get','post'],'/popupadmin/edit/submit/{id}',[PopupAdminController::class,'popup_admin_edit_submit'])->name('popup_admin_edit_submit');

//! Удалить попап
Route::match(['get','post'],'/popupadmin/delete/{id}',[PopupAdminController::class,'popup_admin_delete'])->name('popup_admin_delete');

//! Страница просмотра попапа
Route::match(['get','post'],'/popupadmin/view/{id}',[PopupAdminController::class,'popup_admin_view'])->name('popup_admin_view');

//! JSON страница с параметром change
Route::match(['get','post'],'/popupadmin/change/{id}',[PopupAdminController::class,'popup_admin_change'])->name('popup_admin_change');

//! Для отправки просмотра
Route::match(['get','post'],'/popupadmin/view_add/{id}',[PopupAdminController::class,'popup_admin_view_add'])->name('popup_admin_view_add');
