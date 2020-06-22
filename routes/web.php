<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/redis' , function(){
//     Redis::set('framework' , 'laravel');
// });
// Route::get('/' , function (){
//     Redis::set('framework' , 'laravel');
//     dd(Redis::get('framework'));
//     Redis::lpush('frameworks' , 'vue.js' , 'angular' , 'larvel');
//     dd(Redis::lrange('frameworks' , 0 , -1));
//     Redis::sadd('frontend-frameworks' , ['vue.js' , 'angular' , 'laravel']);
//     dd(Redis::smembers('frontend-frameworks'));
// });

Route::get('/', 'FrontEndController@showSeries')->name('homePage');
Route::get('/search', 'FrontEndController@search')->name('search');

Route::get('/checkout' , 'CheckoutController@index')->name('checkout');
Route::post('/checkout' , 'CheckoutController@subscribePlan');
Route::get('/profile' , 'UsersProfileController@index')->name('view.profile');
Route::get('/change-plan' , 'UsersProfileController@changePlanPage')->name('change.plan');
Route::post('/change-plan' , 'UsersProfileController@updatePlan')->name('update.plan');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/series/{series:slug}' , 'WatchSeriesController@index')->name('series.show');
Route::get('/series/{series:slug}/lessons/{id}' , 'WatchSeriesController@watchLessons')->name('series.lessons');
//admin routes
Route::group(['prefix' => 'admin' , 'as' => 'admin.','middleware' => ['admin']], function () {
    Route::resource('series', 'SeriesController')->except(['show']);
    Route::resource('series.lessons', 'LessonsController');
    Route::get('/series/{series:slug}' , 'SeriesController@show')->name('series.show');
});

