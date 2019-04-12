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

<<<<<<< HEAD
// Index controller routes
Route::get('cache', 'IndexController@flushCache'); // Delete this when we're in production
Route::get('/', 'IndexController@index')->name('home.index');
Route::get('/popular-this-year', 'IndexController@showMostPopularOfTheYear')->name('home.mostpopular');
Route::get('/top-horror-movies', 'IndexController@showTopHorrorMovies')->name('home.tophorror');

// Search controller routes
Route::get('/search', 'SearchController@search')->name('search.search');
Route::get('/advanced-search', 'SearchController@advancedSearch')->name('search.advanced');
Route::get('/advanced-search-view', 'SearchController@view')->name('search.advnacedview');

// Resource routes
=======
// Delete this route when we go live
Route::get('cache', 'IndexController@flushCache');

Route::get('/', 'IndexController@index');

Route::get('/popular-this-year', 'IndexController@showMostPopularOfTheYear');
Route::get('/top-horror-movies', 'IndexController@showTopHorrorMovies');

Route::get('/search', 'SearchController@search');
Route::get('/advanced-search', 'SearchController@advancedSearch');
Route::get('/advanced-search-view', 'SearchController@view');

Route::resource('movies', 'MovieController');
>>>>>>> Added comments to make sure we delete the cache clearing route.
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('movies', 'MovieController')->except([
    'create', 'store', 'edit', 'update', 'destroy'
]);
Route::resource('watchlists', 'WatchlistController')->except([
    'index', 'edit'
]);
Route::resource('comments', 'CommentController')->except([
    'index', 'create', 'show', 'edit'
]);
Route::resource('reviews', 'ReviewController')->except([
    'create', 'edit'
]);

// Admin, auth and additional voyager routes
Route::group(
    ['prefix' => 'admin'],
    function () {
        Voyager::routes();
    }
);

Auth::routes();

// Voyager home route redirect
Route::get('/home', function () {
    return redirect('/');
});

// Wildcard route
Route::get('/{any}', function () {
    return redirect('/');
})->name('wildcard');
