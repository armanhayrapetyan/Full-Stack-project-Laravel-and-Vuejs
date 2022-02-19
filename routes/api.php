<?php

use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\TagController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});

    Route::get('profile', [ProfileController::class,'profile']);
    Route::put('profile', [ProfileController::class,'updateProfile']);
    Route::post('change-password', [ProfileController::class,'changePassword']);
    Route::get('tag/list', [TagController::class,'list']);
    Route::get('category/list', [CategoryController::class,'list']);
    Route::post('product/upload', [ProductController::class,'upload']);

    Route::apiResources([
        'user' => UserController::class ,
        'product' => ProductController::class,
        'category' => CategoryController::class,
        'tag' => TagController::class,
    ]);
