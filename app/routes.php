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
Route::get('/lists', 'ListsController@index');
Route::post('/lists/addListForUser', 'ListsController@addListForUser');
Route::get('/lists/select', 'ListsController@select');
Route::get('/lists/selectuser', 'ListsController@selectUser');
Route::get('/lists/{slug}', 'MemberController@lists');
Route::get('/user/{twitter_handle}/{slug}', 'MemberController@customlists');
Route::post('/lists/addList', 'ListsController@addList');
Route::get('/user/{twitter_handle}', 'MemberController@user');
Route::get('/sign_in_with_twitter', 'MemberController@twitterSignIn');
Route::get('/twitter_callback', 'MemberController@twitterCallback');
Route::get('/tag', 'TagController@index');
Route::get('/tag/{slug}', 'TagController@displayTag');
Route::post('/tag/add', 'TagController@addTag');
Route::get('/getTags', 'TagController@getTags');
Route::get('/tag/updatebytitle/{twitter_handle}/{user_id}/{tag_title}', 'TagController@updateTagByTagTitle');
Route::get('/tag/update/{twitter_handle}/{user_id}/{tag_id}', 'TagController@updateTagByUserId');
Route::get('/logout', 'MemberController@logout');
Route::get('/users', 'MemberController@userList');
//cron
Route::get('/cron/updateTags', 'CronController@updateTopics');
Route::get('/cron/updateUserKloutId', 'CronController@updateUserKloutId');
Route::get('/cron/refreshKlout', 'CronController@refreshKlout');
//admin
Route::get('/admin/users-new', 'AdminController@userAdd');
Route::get('/admin/users-list', 'AdminController@userList');
Route::get('/admin/location-list', 'AdminController@locationList');
Route::get('/admin/categories-list', 'AdminController@CategoriesList');
Route::get('/admin/tag-list', 'AdminController@TagList');
Route::group(array('before' => 'auth'), function()
{
	Route::get('/dashboard', 'MemberController@index');
});
