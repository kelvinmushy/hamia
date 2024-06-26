<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes();
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
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

//email verification link

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/agent/dashboard');

})->middleware(['auth', 'signed'])->name('verification.verify');



 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::resource('/sub/categories','App\Http\Controllers\Admin\SubCategoryController'::class);
 

// Route::get('/', function () {
//     return redirect('login');  
// });


Route::get('/', [App\Http\Controllers\FrontpageController::class,'index'])->name('home');

Route::get('/singleSubCategory/{id}',[App\Http\Controllers\FrontpageController::class,'indexMobile']);

Route::get('/slider', 'FrontpageController@slider')->name('slider.index');

Route::get('/search', 'FrontpageController@search')->name('search');

Route::post('/cd',[App\Http\Controllers\FrontpageController::class,'cd']);

Route::get('/property', [App\Http\Controllers\PagesController::class,'properties'])->name('property');

Route::get('/{agent}/{category}/{title}/{id}', [App\Http\Controllers\PagesController::class,'propertieshow'])->name('property.show');

Route::get('/client/request', [App\Http\Controllers\PagesController::class,'clientRequest']);
Route::post('/client/request/store', [App\Http\Controllers\PagesController::class,'clientRequestStore']);

Route::post('/property/message', [App\Http\Controllers\PagesController::class,'messageAgent'])->name('property.message');
Route::post('/property/comment/{id}', [App\Http\Controllers\PagesController::class,'propertyComments'])->name('property.comment');
Route::post('/property/rating', [App\Http\Controllers\PagesController::class,'propertyRating'])->name('property.rating');
Route::get('/property/city/{cityslug}', [App\Http\Controllers\PagesController::class,'propertyCities'])->name('property.city');

Route::get('/agents', [App\Http\Controllers\PagesController::class,'agents'])->name('agents');
Route::get('/agents/{id}', [App\Http\Controllers\PagesController::class,'agentshow'])->name('agents.show');

Route::get('/gallery', [App\Http\Controllers\PagesController::class,'gallery'])->name('gallery');
//Location will be here
Route::get('/get_district/{id}', [App\Http\Controllers\PagesController::class,'getDistrict']);
Route::get('/region/district',[ App\Http\Controllers\PagesController::class,'getDistrictByRegion']);

Route::get('/blog', [App\Http\Controllers\PagesController::class,'blog'])->name('blog');

Route::get('/blog/{id}', [App\Http\Controllers\PagesController::class,'blogshow'])->name('blog.show');
Route::post('/blog/comment/{id}', [App\Http\Controllers\PagesController::class,'blogComments'])->name('blog.comment');

Route::get('/blog/categories/{slug}', [App\Http\Controllers\PagesController::class,'blogCategories'])->name('blog.categories');
Route::get('/blog/tags/{slug}', [App\Http\Controllers\PagesController::class,'blogTags'])->name('blog.tags');
Route::get('/blog/author/{username}', [App\Http\Controllers\PagesController::class,'blogAuthor'])->name('blog.author');

Route::get('/contact', [App\Http\Controllers\PagesController::class,'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\PagesController::class,'messageContact'])->name('contact.message');

Route::get('/{slug}', [App\Http\Controllers\FrontpageController::class,'propertyCategory'])->name('property-category');
//admin controller will be here
//route::resource('/universal/evaluationResult','Universals\EvaluationFormResult'::class)->middleware('auth');

//Ajax Post all will be here

Route::post('/regionApi', [App\Http\Controllers\API\AjaxUniversal::class,'regionApi']);

Route::post('/purposeApi', [App\Http\Controllers\API\AjaxUniversal::class,'purposeApi']);
Route::post('/propertyTypeApi', [App\Http\Controllers\API\AjaxUniversal::class,'propertyTypeApi']);
Route::post('/districtApi', [App\Http\Controllers\API\AjaxUniversal::class,'districtApi']);

Route::post('/propertyCategoryTypeApi', [App\Http\Controllers\API\AjaxUniversal::class,'propertyCategoryTypeApi']);



Route::group(['middleware'=>['auth']], function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tags','App\Http\Controllers\Admin\TagController'::class);
    Route::resource('categories','App\Http\Controllers\Admin\CategoryController'::class);
  
    Route::resource('posts','App\Http\Controllers\Admin\PostController'::class);
    Route::resource('features','App\Http\Controllers\Admin\FeatureController'::class);
    Route::resource('/properties','App\Http\Controllers\Admin\PropertyController'::class);
    Route::post('properties/gallery/delete',[App\Http\Controllers\Admin\PropertyController::class,'galleryImageDelete'])->name('gallery-delete');

    Route::resource('sliders','App\Http\Controllers\Admin\SliderController'::class);
    Route::resource('services','App\Http\Controllers\Admin\ServiceController'::class);
    Route::resource('testimonials','App\Http\Controllers\Admin\TestimonialController'::class);

    Route::get('galleries/album', [App\Http\Controllers\Admin\GalleryController::class,'album'])->name('album');
    Route::post('galleries/album/store', [App\Http\Controllers\Admin\GalleryController::class,'albumStore'])->name('album.store');
    Route::get('galleries/{id}/gallery', [App\Http\Controllers\Admin\GalleryController::class,'albumGallery'])->name('album.gallery');
    Route::post('galleries', [App\Http\Controllers\Admin\GalleryController::class,'Gallerystore'])->name('galleries.store');

    Route::get('settings', [App\Http\Controllers\Admin\DashboardController::class,'settings'])->name('settings');
    Route::post('settings', [App\Http\Controllers\Admin\DashboardController::class,'settingStore'])->name('settings.store');

    Route::get('profile',[App\Http\Controllers\Admin\DashboardController::class,'profile'])->name('profile');
    Route::post('profile',[App\Http\Controllers\Admin\DashboardController::class,'profileUpdate'])->name('profile.update');

    Route::get('message',[App\Http\Controllers\Admin\DashboardController::class,'message'])->name('message');
    Route::get('message/read/{id}',[App\Http\Controllers\Admin\DashboardController::class,'messageRead'])->name('message.read');
    Route::get('message/replay/{id}',[App\Http\Controllers\Admin\DashboardController::class,'messageReplay'])->name('message.replay');
    Route::post('message/replay',[App\Http\Controllers\Admin\DashboardController::class,'messageSend'])->name('message.send');
    Route::post('message/readunread',[App\Http\Controllers\Admin\DashboardController::class,'messageReadUnread'])->name('message.readunread');
    Route::delete('message/delete/{id}',[App\Http\Controllers\Admin\DashboardController::class,'messageDelete'])->name('messages.destroy');
    Route::post('message/mail', [App\Http\Controllers\Admin\DashboardController::class,'contactMail'])->name('message.mail');

    Route::get('changepassword',[App\Http\Controllers\Admin\DashboardController::class,'changePassword'])->name('changepassword');
    Route::post('changepassword',[App\Http\Controllers\Admin\DashboardController::class,'changePasswordUpdate'])->name('changepassword.update');

    //edit features check box
  
    Route::get('/feature/checkbox/edit/{id}',[App\Http\Controllers\Admin\FeatureController::class,'editFeatureCheckBox']);
});


Route::group(['prefix'=>'agent','middleware'=>['auth','verified'],'as'=>'agent.'], function(){

    Route::get('dashboard',[App\Http\Controllers\Agent\DashboardController::class,'index'])->name('dashboard');
    Route::get('profile',[ App\Http\Controllers\Agent\DashboardController::class,'profile'])->name('profile');
    Route::get('social',[ App\Http\Controllers\Agent\DashboardController::class,'social'])->name('social');

    Route::post('/social/store',[ App\Http\Controllers\Agent\DashboardController::class,'social_store'])->name('social.store');
     Route::get('/social/delete/{id}',[ App\Http\Controllers\Agent\DashboardController::class,'social_delete'])->name('social.delete');

    Route::post('profile',[ App\Http\Controllers\Agent\DashboardController::class,'profileUpdate'])->name('profile.update');
    Route::get('changepassword',[ App\Http\Controllers\Agent\DashboardController::class,'changePassword'])->name('changepassword');
    Route::post('changepassword',[ App\Http\Controllers\Agent\DashboardController::class,'changePasswordUpdate'])->name('changepassword.update');

    Route::resource('properties','App\Http\Controllers\Agent\PropertyController');
    //store multiple Images
    Route::post('/update/properties','App\Http\Controllers\Agent\PropertyController@update');

    Route::post('/multiple/image/properties','App\Http\Controllers\Agent\PropertyController@imageStore');
    
    Route::post('/multiple/update/image/properties','App\Http\Controllers\Agent\PropertyController@imageUpdateStore');

   
    Route::get('/preview/propery/{id}','App\Http\Controllers\Agent\PropertyController@previewProperty')->name('preview.property');
    Route::get('/property/change_status/{id}','App\Http\Controllers\Agent\PropertyController@propertyStatus');
    
    Route::post('properties/gallery/delete','PropertyController@galleryImageDelete')->name('gallery-delete');

     Route::get('/subcategory/propertyType',[ App\Http\Controllers\AjaxFormContentController::class,'propertyType']);
      Route::get('/region/district',[ App\Http\Controllers\AjaxFormContentController::class,'getDistrict']);


    Route::post('properties/gallery/delete','PropertyController@galleryImageDelete')->name('gallery-delete');

    Route::get('message',[ App\Http\Controllers\Agent\DashboardController::class,'message'])->name('message');
    Route::get('message/read/{id}',[ App\Http\Controllers\Agent\DashboardController::class,'messageRead'])->name('message.read');
    Route::get('message/replay/{id}',[ App\Http\Controllers\Agent\DashboardController::class,'messageReplay'])->name('message.replay');
    Route::post('message/replay',[ App\Http\Controllers\Agent\DashboardController::class,'messageSend'])->name('message.send');
    Route::post('message/readunread',[ App\Http\Controllers\Agent\DashboardController::class,'messageReadUnread'])->name('message.readunread');
    Route::delete('message/delete/{id}',[ App\Http\Controllers\Agent\DashboardController::class,'messageDelete'])->name('messages.destroy');
    Route::post('message/mail', [ App\Http\Controllers\Agent\DashboardController::class,'contactMail'])->name('message.mail');

});





// <?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//try dropzone
Route::post('projects/media', [App\Http\Controllers\Admin\GalleryController::class, 'storeMedia'])->name('projects.storeMedia');
Route::post('projects/store', [App\Http\Controllers\Admin\GalleryController::class, 'storee'])->name('projects.store');

require __DIR__.'/auth.php';
Auth::routes();

