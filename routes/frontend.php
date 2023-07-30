<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegisterController;
use App\Http\Controllers\Frontend as FRONTEND;




Auth::routes();
Route::get('/',  			        [FRONTEND\HomeController::class,'index']);




Route::post('/verify-code', 		    [FRONTEND\HomeController::class,'verify_code']);

Route::get('/resend-code', 		    [FRONTEND\HomeController::class,'resend_code']);




Route::post('/register-user', 		    [FRONTEND\HomeController::class,'create']);

Route::get('/verify', 		    [FRONTEND\HomeController::class,'verify']);







?>