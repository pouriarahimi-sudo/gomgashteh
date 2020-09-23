<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

    Route::post('verifyCode' , [ApiController::class,'verifyCode']);
    Route::post('validateCode' , [ApiController::class,'validateCode']);
    Route::get('getAnnouncement' , [ApiController::class,'getAnnouncement']);
    Route::post('getOneAnnouncement' , [ApiController::class,'getOneAnnouncement']);
    Route::post('saveTicket' , [ApiController::class,'saveTicket']);
    Route::post('answerTicket' , [ApiController::class,'answerTicket']);
    Route::post('oneTicket' , [ApiController::class,'OneTicket']);

