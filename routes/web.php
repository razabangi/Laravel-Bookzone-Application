<?php

use Illuminate\Support\Facades\Route;
// use App\HTTP\Controllers\Frontend\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Fronted Group
Route::group(['prefix'=>'frontend','namespace'=>'Frontend'],function(){
	Route::get('/','FrontendController@index');
});


//Admin Group
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	Route::resource('category','CategoryController');
	Route::put('category/{category}/status','CategoryController@status');

	Route::resource('author','AuthorController');
	Route::put('author/{author}/status','AuthorController@status');
	Route::get('author/{author}/duplicate','AuthorController@duplicate');
	Route::post('author/duplicate/store','AuthorController@duplicate_store');	


	Route::resource('book','BookController');
	Route::put('book/{book}/status','BookController@status');
	Route::get('book/{book}/duplicate','BookController@duplicate');
	// Route::post('book/duplicate/store','BookController@duplicate_store')->name('admin.duplicate.store');

	Route::resource('media','MediaController');
	Route::put('media/{media}/status','MediaController@status');

	Route::resource('team','TeamController');
	Route::put('team/{team}/status','TeamController@status');
		
});
