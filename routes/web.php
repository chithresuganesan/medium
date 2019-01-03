<?php

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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Medium')->group(function(){
  Route::name('post.')->group(function() {

    // Homepage
    Route::get('/', 'ViewController@index')->name('home');
    Route::get('/category/{category?}', 'ViewController@postview')->name('postview');
    Route::get('/viewcategory/{testview}', 'ViewController@viewcategory')->name('testview');
    Route::get('/viewpost/{post}', 'ViewController@viewpost')->name('viewpost');
    Route::post('/viewpost/{post}', 'ViewController@viewcomment')->name('viewcomment');
    Route::post('/bookmark', 'ViewController@bookmark')->name('bookmark');
    Route::post('/like', 'ViewController@like')->name('like');
    Route::post('/follow', 'ViewController@follows')->name('follow');

    Route::post('/ajax', 'ViewController@searchajax')->name('searchajax');

    // Admin
    Route::get('dashboard', 'PostController@index')->name('index');
    Route::post('dashboard', 'PostController@addcategory')->name('addcategory');
    Route::get('create', 'PostController@create')->name('create');
    Route::post('store', 'PostController@store')->name('store');
    Route::get('show', 'PostController@showtable')->name('show');
    Route::get('edit/{post}', 'PostController@edit')->name('edit');
    Route::post('update/{post}', 'PostController@update')->name('update');
    Route::get('delete/{post}', 'PostController@destroy')->name('destroy');
    // show
    Route::get('pending', 'PostController@pending')->name('pending');
    Route::get('published', 'PostController@published')->name('published');
    Route::get('draft', 'PostController@draft')->name('draft');
    Route::get('mypost', 'PostController@mypost')->name('mypost');
    Route::get('bookmark', 'PostController@mybookmark')->name('mybookmark');
    Route::get('follows', 'PostController@myfollow')->name('myfollows');
    Route::get('draftfollow/{follow}', 'PostController@draftfollow')->name('draftfollow');
    Route::get('draftbookmark/{bookmark}', 'PostController@draftbookmark')->name('draftbookmark');

    // Active,pending,draf
    Route::get('published/{post}', 'PostController@activePublish')->name('activePublish');
    Route::get('draft/{post}', 'PostController@draftPublish')->name('draftPublish');
    Route::get('pending/{post}', 'PostController@pendingPublish')->name('pendingPublish');

    // view posts
    Route::get('pending/{post}', 'PostController@pendingPublish')->name('pendingPublish');

    Route::get('allcount', 'PostController@allcount')->name('allcount');
  });
});

Route::get('/changepassword', 'Auth\ResetPasswordController@changePassword')->name('changepassword');
Route::post('/updatepassword', 'Auth\ResetPasswordController@updatePassword')->name('updatepassword');

Auth::routes();
