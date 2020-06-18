<?php

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
Route::apiResource('/courses','CourseAPIController', [
        'names' => [
            'index' => 'api.courses.index',
            'store' => 'api.courses.store',
            'show' => 'api.courses.show',
        ]
    ]);
Route::group(['prefix'=>'courses'],function(){
	Route::apiResource('/{course}/list-course','CourseDetailAPIController');
});
// Route::get('courses', 'CourseAPIController@index');
// Route::get('/courses/{course}', 'CourseAPIController@show')->name('course-detail');
// Route::get('/courses/{course}/list-course', 'CourseAPIController@indexListCourse')->name('index-list-course');
// Route::get('/courses/{id?}/list-course/{list_id?}', 'CourseAPIController@listCourse')->name('list-course');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
