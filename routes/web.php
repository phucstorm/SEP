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


Route::get('/', ['middleware' =>'guest', function(){
    return view('index');
  }]);
Auth::routes();

// User Function
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

//Search Event Room : /room for guest , /admin/event for host
Route::get('/admin/event' , 'EventController@search');
Route::get('/room' , 'GuestController@search');

// Route::get('qr/{event_code}','SearchController@getQR');
Route::post('/room', 'GuestController@postQuestion');

Route::get('/room/question/accept/{id}' , 'QuestionController@accept');
Route::get('/room/question/denied/{id}' , 'QuestionController@denied');
 
Route::get('/room/poll/{event_code}' , 'PollAnswerController@index');


Route::post('/room/reply', 'QuestionController@reply_question');
Route::get('/room/like/{question_id}','QuestionController@like_question');
Route::get('/room/unlike/{question_id}','QuestionController@unlike_question');

Route::get('/admin/event/poll/{event_id}', 'PollQuestionController@index');

//Poll 
Route::post('/admin/event/poll/create' , 'PollQuestionController@create');
Route::post('/admin/event/poll/delete', 'PollQuestionController@delete_poll_question');
Route::post('/admin/event/poll/edit', 'PollQuestionController@update_poll');
Route::get('/room/poll/{event_code}', 'GuestController@poll_question');