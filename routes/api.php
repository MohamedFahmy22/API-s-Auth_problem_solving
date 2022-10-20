<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProblemSolvingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
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

Route::middleware(['jwt.verify'])->group(function (){

    Route::get('users',[\App\Http\Controllers\Api\UserController::class,'index']);
    Route::get('user/{id}',[\App\Http\Controllers\Api\UserController::class,'show']);
    Route::post('user/store',[\App\Http\Controllers\Api\UserController::class,'store']);
    Route::post('user/update/{id}',[\App\Http\Controllers\Api\UserController::class,'update']);
    Route::post('user/delete/{id}',[\App\Http\Controllers\Api\UserController::class,'delete']);

});


Route::get('/sendTwoExceptNum/{start}/{end}',[ProblemSolvingController::class,'sendTwoVar']);
Route::get('/sequanceAlphpet/{start}/{end}',[ProblemSolvingController::class,'getcolumnrange']);
Route::get('/numToZero/{nums}/{x}',[ProblemSolvingController::class,'minOperations']);
