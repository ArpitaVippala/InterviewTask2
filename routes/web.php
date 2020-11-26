<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('signUp', 'user\UserController@signUp')->name('SignUp');

Route::get('login', 'Auth\LoginController@login')->name('Login');
Route::post('loginUser', 'Auth\LoginController@loginUser');
Route::post('createUser', 'Auth\RegisterController@create');

Route::group(['middleware'=>['admin']], function(){
Route::get('AdminDashboard', 'admin\AdminController@AdminDashboard')->name('AdminDashboard');

Route::get('createNew', 'admin\AdminController@createNew')->name('User');
Route::post('createUserAjax', 'admin\AdminController@createUserAjax');
Route::get('salary', 'admin\AdminController@salary')->name('Salary');
Route::post('salaryCal', 'admin\AdminController@salaryCal');
Route::get('addUser', 'admin\AdminController@addUser')->name('Users');
Route::post('saveUser', 'admin\AdminController@saveUser');
Route::post('getUser', 'admin\AdminController@getUser');
Route::post('updateUser', 'admin\AdminController@updateUser');
Route::get('adminPosts', 'admin\AdminController@adminPosts')->name('AdminPosts');
Route::post('getPost', 'admin\AdminController@getPost');
Route::post('saveBannedPost', 'admin\AdminController@saveBannedPost');
});

Route::group(['middleware'=>['user']], function(){

Route::get('dashboard', 'user\UserController@dashboard')->name('Dashboard');
Route::get('posts', 'user\UserController@posts')->name('Posts');
Route::post('savePost', 'user\UserController@savePost');
Route::post('saveComment', 'user\UserController@saveComment');
Route::post('deletePost', 'user\UserController@deletePost');
});
Route::get('post/{postId}', 'user\UserController@post')->name('Post');

Route::post('deleteComment', 'user\UserController@deleteComment');


Route::get('logout/{role}', 'admin\AdminController@logout');
