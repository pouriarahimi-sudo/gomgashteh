<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', [HomeController::class, 'index'])->name('index');

/********************************************
------------------ USERS ------------------
 *******************************************/
Route::get('/sign-out',[UserController::class, 'sign_out'])->name('sign-out');

Route::post('/authentication-login',[UserController::class, 'authentication_login'])->name('authentication-login');
Route::put('/user-validation',[UserController::class, 'user_validation'])->name('user-validation');
Route::put('/user-compare-code',[UserController::class, 'user_compare_code'])->name('user-compare-code');
Route::get('/user',[UserController::class, 'user'])->name('user');

Route::get('/add-announcement',[UserController::class, 'add_announcement'])->name('add-announce');
Route::post('/complete-info',[UserController::class, 'complete_info'])->name('complete-info');
Route::post('/insert-announcement',[UserController::class, 'insert_announcement'])->name('insert-announce');
Route::post('/details',[UserController::class, 'details_announcement'])->name('details-announcement');

Route::any('/is-auth',[UserController::class, 'is_auth'])->name('is-auth');
Route::get('/specify-type-ticket',[TicketController::class, 'specify_type_ticket'])->name('specify-type-ticket');

Route::get('/send-new-ticket',[TicketController::class, 'send_new_ticket'])->name('send-new-ticket');
Route::post('/insert-new-ticket',[TicketController::class, 'insert_new_ticket'])->name('insert-new-ticket');

Route::any('/send-ticket',[TicketController::class, 'send_ticket'])->name('send-ticket');
Route::post('/insert-ticket',[TicketController::class, 'insert_ticket'])->name('insert-ticket');

Route::get('/my-tickets',[TicketController::class, 'my_tickets'])->name('my-tickets');
Route::get('/show-ticket',[TicketController::class, 'show_ticket'])->name('show-ticket');

Route::post('/insert-ticket-answer',[TicketController::class, 'insert_ticket_answer'])->name('insert-ticket-answer');
Route::post('/confirmation',[TicketController::class, 'confirmation'])->name('confirmation');

Route::get('/my-announce',[AnnouncementController::class, 'my_announce'])->name('my-announce');
Route::get('/edit-my-announce',[AnnouncementController::class, 'edit_my_announce'])->name('edit-my-announce');
Route::post('/update-announce',[AnnouncementController::class, 'update_announce'])->name('update-announce');
Route::post('/delete-announce',[AnnouncementController::class, 'delete_announce'])->name('delete-announce');
Route::post('/record-the-result',[AnnouncementController::class, 'record_the_result'])->name('record-the-result');

Route::get('/dropdown/cities/{id}',[UserController::class, 'getCitiesList']);
Route::get('/dropdown/collections/{id}',[UserController::class, 'getCollectionsList']);



/********************************************
------------------ ADMIN ------------------
 *******************************************/
Route::get('/admin', function () {
    if(Session::has('sessId')){
        return view('admin/admin-dashboard');
    }else{
        return view('admin/admin-validation');
    }
});
Route::Post('/admin_validation',[AdminController::class, 'admin_validation']);
Route::Post('/compare-code',[AdminController::class, 'compare_code']);

Route::Get('/admin-sign-out',[AdminController::class, 'admin_sign_out'])->name('admin-sign-out');

Route::get('/user-management',[AdminController::class, 'user_management'])->name('user-management');
Route::post('/edit-personnel',[AdminController::class, 'edit_personnel'])->name('edit-personnel');
Route::post('/update-personnel',[AdminController::class, 'update_personnel'])->name('update-personnel');
Route::post('/delete-personnel',[AdminController::class, 'delete_personnel'])->name('delete-personnel');

Route::post('/add-user',[AdminController::class, 'add_user']);
Route::post('/add-lost',[AdminController::class, 'add_lost']);
Route::get('/user-announce',[AdminController::class, 'user_announce'])->name('user-announce');
Route::any('/show-announce',[AdminController::class,'show_announce'])->name('show-announce');
Route::put('/status-change',[AdminController::class, 'status_change'])->name('status-change');

