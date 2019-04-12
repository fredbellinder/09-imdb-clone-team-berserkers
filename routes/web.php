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






Route::get('/', 'IndexController@index');
Route::get('/popular-this-year', 'IndexController@showMostPopularOfTheYear');
Route::get('/top-horror-movies', 'IndexController@showTopHorrorMovies');
Route::get('/search', 'SearchController@search');
Route::get('/advanced-search', 'SearchController@advancedSearch');
Route::get('/advanced-search-view', 'SearchController@view');
Route::resource('movies', 'MovieController');
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('watchlists', 'WatchlistController');
Route::resource('reviews', 'ReviewController');
Route::group(
['prefix' => 'admin'],
function () {
Voyager::routes();
}
);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/comments', 'CommentController@store')->name('comments.store');
Route::delete(
'/comments/{comment}',
'CommentController@destroy'
);

Route::get('/chat', 'ChatController@index')->middleware('auth')->name('chat.index');
Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');
Route::post('/chat/getChat{id}', 'ChatController@getChat')->middleware('auth');
Route::post('/chat/sendChat', 'ChatController@sendChat')->middleware('auth');

Route::get('/friend', 'FriendController@index')->middleware('auth')->name('chat.friend');
Route::post('/friend', 'FriendController@addFriend')->middleware('auth');
Route::delete('/friend', 'FriendController@removeFriend')->middleware('auth');
