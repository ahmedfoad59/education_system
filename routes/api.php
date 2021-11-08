<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategorisController;
use App\Http\Controllers\api\ItemsController;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//the routs of categoris controller (categoris table)
//start
route::post('stor_cats',[CategorisController::class,'store']);
route::get('show_cats',[CategorisController::class,'show']);
route::get('edit_cats/{id}',[CategorisController::class,'edit']);
route::post('update_cats/{id}',[CategorisController::class,'update']);
route::post('destroy_cats/{id}',[CategorisController::class,'destroy']);
//end

//the routs of items controller (items table)
//start
 route::post('stor_items',[ItemsController::class,'store']);
route::get('show_items',[ItemsController::class,'show']);
route::post('edit_items/{id}',[ItemsController::class,'edit']);
route::post('update_items/{id}',[ItemsController::class,'update']);
route::post('destroy_items/{id}',[ItemsController::class,'destroy']);
//end