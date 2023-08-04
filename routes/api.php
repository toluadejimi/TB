<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('v1/webhook/', 'App\Http\Controllers\ProductController@webhook');



Route::get('fetch-sms', 'App\Http\Controllers\ProductController@get_sms');

Route::post('process', 'App\Http\Controllers\ProductController@process');

Route::post('ban', 'App\Http\Controllers\ProductController@ban');

Route::post('ban-server2-number', 'App\Http\Controllers\ProductController@ban_server2');










Route::post('fetch-code', 'App\Http\Controllers\ProductController@areacode');

Route::get('fetch-service', 'App\Http\Controllers\ProductController@service');







Route::post('fetch-amount', [ProductController::class, 'amount']);


Route::get('/getareacode','App\Http\Controllers\ProductController@areacode');


Route::group(['middleware' => ['throttle:api']], function (){

    Route::post('create-message','App\Http\Controllers\Api\BulkController@submitRequest')->name('api.create.message');
    Route::post('/set-device-status/{device_id}/{status}','App\Http\Controllers\Api\BulkController@setStatus');
    Route::post('/send-webhook/{device_id}','App\Http\Controllers\Api\BulkController@webHook');
    

});