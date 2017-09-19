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


Route::get('/', 'PagesController@index');
Route::get('/test', 'PagesController@test');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/edit','TicketsController@edit');


Route::post('/ticket/{slug?}/edit','TicketsController@update');
Route::post('/ticket/{slug?}/delete','TicketsController@destroy');

// Laravel predefined Routes 
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');

Route::get('users/logout', 'Auth\LoginController@logout');


//Route::get('users/login', 'Auth\LoginController@showLoginForm');
// ->name('login') Why? Because if you try to access the admin routes when you're not authenticated, you will be redirected automatically to the login route.
// the named Route redirected to /users/login
//In Laravel 5, we can use the named route feature to generate URLs or redirects for specific routes. Simply put, we can name a route by just using the name method:
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('users/login', 'Auth\LoginController@login');


// Route::get('yourRoute', 'yourController@yourAction')->name('yourCustomNamedRoute');


// Group routes for Admin panel /admin/users , we use auth middleware for this route group

// Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'), function () {
//     Route::get('users', 'UsersController@index');
// });



// now we use our personally middleware Manager to authorized the routes see in kernel.php and middleware/manager
// @prefix URI-NAME for Route Group 
// @namespace  defined a namespace 
// @middleware defined a middleware filter name (Since Laravel 5 HTTP Middleware is like a filter. Basically, we use it to filter our applications' HTTP requests)
//     'middleware'=> 'auth' is the standard auth middleware, only logged users can access /admin/.. routes
//     'middleware'=> 'manager' our own middleware manager with specific roles
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {

    Route::get('/', 'PagesController@home'); 
    
    Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    //Route::get('users', 'UsersController@index');
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');

    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit','UsersController@update');

});



// One of the best new features of Laravel 5 is Middleware (aka HTTP Middleware). Imagine that you have a layer between all requests and responses. 
// That layer will help to handle all requests and return 
// proper responses, even before the requests/responses are processed. We call the layer: "Middleware".