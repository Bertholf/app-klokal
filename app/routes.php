<?php




/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| The following are publicly available pages
|
*/

// Homepage
Route::get('/', 'GuestController@index');
Route::get('/dashboard', 'MemberController@index');
Route::get('/type/{slug}', 'MemberController@type');