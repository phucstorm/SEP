<?php
use App\Events\FormSubmitted;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/user', 'UserController@index');
Route::post('/user/edit/info', 'UserController@edit_user_info');
Route::post('/user/edit/password', 'UserController@edit_user_password');

Route::get('admin/home', 'HomeController@index')->name('home');
// CRUD for Event Function
Route::get('admin/event', 'EventController@index');
Route::post('admin/event/create', 'EventController@create');
Route::post('/admin/event/delete', 'EventController@delete');
Route::post('admin/event/edit', 'EventController@edit');
Route::get('admin/event/{event_code}', 'EventController@show');

//Search Event Room : /room for guest , /search for host
Route::get('/room' , 'SearchController@search');
Route::get('/search' , 'EventController@search');

// Generate QR code for Event Room depend on event_code
Route::get('qr/{event_code}','SearchController@getQR');
Route::post('/room', 'QuestionController@postQuestion');

Route::get('/room/question/accept/{id}' , 'QuestionController@accept');
Route::get('/room/question/denied/{id}' , 'QuestionController@denied');
