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
Route::post('/lists/addList', 'ListsController@addList');

Route::get('/lists/{slug}', 'MemberController@lists');
Route::get('/user/{twitter_handle}/{slug}', 'MemberController@customlists');
Route::get('/user/{twitter_handle}', 'MemberController@user');
Route::get('/sign_in_with_twitter', 'MemberController@twitterSignIn');
Route::get('/twitter_callback', 'MemberController@twitterCallback');
Route::get('/logout', 'MemberController@logout');
Route::get('/users', 'MemberController@userList');
Route::post('/change/location', 'MemberController@userChangeLocation');

Route::get('/tag', 'TagController@index');
Route::get('/tag/{slug}', 'TagController@displayTag');
Route::post('/tag/add', 'TagController@addTag');
Route::get('/getTags', 'TagController@getTags');
Route::get('/tag/updatebytitle/{twitter_handle}/{user_id}/{tag_title}', 'TagController@updateTagByTagTitle');
Route::get('/tag/update/{twitter_handle}/{user_id}/{tag_id}', 'TagController@updateTagByUserId');
//cron
Route::get('/cron/updateTags', 'CronController@updateTopics');
Route::get('/cron/updateUserKloutId', 'CronController@updateUserKloutId');
Route::get('/cron/refreshKlout', 'CronController@refreshKlout');
//admin
Route::get('/admin/users-list', 'AdminController@userList');
Route::get('/admin/users-new', 'AdminController@userAddview');
Route::post('/admin/users-add', 'AdminController@userAdd');
Route::get('/admin/users-delete/{id}', 'AdminController@userDelete');
Route::post('/admin/users-search', 'AdminController@userSearch');

Route::get('/admin/location-list', 'AdminController@locationList');
Route::get('/admin/location-new', 'AdminController@locationAddView');
Route::post('/admin/location-add', 'AdminController@locationAdd');
Route::get('/admin/location-delete/{id}', 'AdminController@locationDelete');


Route::get('/admin/categories-list', 'AdminController@CategoriesList');
Route::get('/admin/categories-new', 'AdminController@categoriesAddView');
Route::post('/admin/categories-add', 'AdminController@categoriesAdd');
Route::get('/admin/categories-delete/{id}', 'AdminController@categoriesDelete');

Route::get('/admin/tag-list', 'AdminController@TagList');
Route::get('/admin/tag-new', 'AdminController@TagAddView');
Route::post('/admin/tag-add', 'AdminController@TagAdd');
Route::get('/admin/tag-delete/{id}', 'AdminController@TagDelete');
Route::group(array('before' => 'auth'), function()
{
	Route::get('/dashboard', 'MemberController@index');
});
