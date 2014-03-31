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
Route::get('/user/{twitter_handle}', 'MemberController@user');
Route::get('/sign_in_with_twitter', 'MemberController@twitterSignIn');
Route::get('/twitter_callback', 'MemberController@twitterCallback');
Route::get('/tag', 'TagController@index');
Route::get('/tag/{slug}', 'TagController@tag');
Route::post('/tag/add', 'TagController@addTag');
Route::get('/tag/update/{user_id}/{tag_id}', 'TagController@updateTagByUserId');