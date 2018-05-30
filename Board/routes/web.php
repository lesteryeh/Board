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
    // factory(App\User::class, 10)->create();
    return view('welcome');
});

Auth::routes();

// Route::get('/test', 'HomeController@index')->name('home');
Route::get('/home', 'MessageController@getIndex');
Route::get('/test', 'MessageController@getIndex');
Route::post('/test', 'MessageController@addpost');
Route::get('/test/add', 'MessageController@add'); //留言添加界面展示
Route::post('/test/edit', 'MessageController@edit')->name('test'); //編輯
Route::get('/test/edit', 'MessageController@getIndex');
Route::post('/test/add', 'MessageController@addpost'); //處理留言添加
Route::post('/test/del', 'MessageController@del');


// Route::get('/test', 'HomeController@index')->name('home');
Route::get('/home2', 'RefactoringController@getIndex');
Route::get('/test2', 'RefactoringController@getIndex');
Route::post('/test2', 'RefactoringController@addpost');
Route::get('/test2/add', 'RefactoringController@add'); //留言添加界面展示
Route::post('/test2/edit', 'RefactoringController@edit')->name('test'); //編輯
Route::get('/test2/edit', 'RefactoringController@getIndex');
Route::post('/test2/add', 'RefactoringController@addpost'); //處理留言添加
Route::post('/test2/del', 'RefactoringController@del');
