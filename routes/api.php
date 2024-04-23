<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PropertyApiController;
use App\Http\Controllers\API\AdsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
});

Route::get('/category', [PropertyApiController::class,'categoryApi']);

Route::get('/edit/category/{id}', [PropertyApiController::class,'editCategory']);

Route::post('/update/category', [PropertyApiController::class,'updateCategory']);




Route::get('/sub-category', [PropertyApiController::class, 'SubcategoryApi']);

Route::get('/properties', [PropertyApiController::class, 'propertyApi']);

Route::get('/propertyTitle/{id}', [PropertyApiController::class, 'propertyTitleApi']);

Route::get('/regions', [PropertyApiController::class, 'propertyRegionApi']);

Route::post('/add/category', [PropertyApiController::class, 'postCategory']);


Route::get('/delete/category/{id}', [PropertyApiController::class, 'deleteCategory']);

Route::get('/similar/properties/{id}', [PropertyApiController::class, 'similarPropertyApi']);

Route::get('/properties/sub_category', [PropertyApiController::class, 'subCategoryPropertyApi']);

//property district will be here

Route::get('/district/{id}', [PropertyApiController::class, 'propertyDistrictApi']);


//feature
Route::get('/feature', [PropertyApiController::class, 'featureApi']);
//condition
Route::get('/condition', [PropertyApiController::class, 'conditionApi']);


//condition
Route::get('/term', [PropertyApiController::class, 'termApi']);

//NearBy
Route::get('/near-by', [PropertyApiController::class, 'nearByApi']);


//Furnish
Route::get('/furnish', [PropertyApiController::class, 'furnishApi']);

//currency
Route::get('/currency', [PropertyApiController::class, 'currencyApi']);
Route::get('/properties/type/{id}', [PropertyApiController::class, 'propertyTypeApi']);


//Ads Controller 


Route::post('/new/ads', [AdsController::class, 'store']);

   


