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

Route::get('/', 'NewsController@allNews')->name('welcome');

Auth::routes();
// LK
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/pay', 'HomeController@payPage')->name('home/pay');
Route::post('/home/pay/request', 'PayController@payRequest')->name('home/pay/request');
Route::get('/home/pay/check', 'PayController@payChecker')->name('home/pay/check');

Route::get('/banlist', 'banlistController@banlist');
Route::get('/news/{tech_name}', 'NewsController@show');

Route::get('/moder', 'moderRequestsController@mRequest');

Route::get('/shop', 'ShopController@serversShops');
Route::get('/shop/{id}', 'ShopController@allNewsByServerId');

Route::get('/page/{tech_name}', 'PageController@show');

// LAUNCHER
Route::get('/launcher/login', 'LauncherController@login');

// ADMIN
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/servers', 'AdminController@servers')->name('admin/servers');
Route::get('/admin/news', 'AdminController@news')->name('admin/news');
Route::get('/admin/news/{tech_name}', 'AdminController@newsEditor')->name('admin/news/editor');
Route::post('/admin/servers', 'AdminController@create')->name('admin/servers/create');
Route::post('/admin/servers/delete', 'AdminController@delete')->name('admin/servers/delete');
Route::post('/admin/news/create', 'AdminController@createNews')->name('admin/news/create');
Route::post('/admin/news/delete', 'AdminController@deleteNews')->name('admin/news/delete');
Route::post('/admin/news/edit', 'AdminController@newsEdit')->name('admin/news/edit');
Route::get('/admin/page', 'AdminController@pageIndex')->name('admin/page');
Route::get('/admin/page/{tech_name}', 'AdminController@pageEditor')->name('admin/page/editor');
Route::post('/admin/page/delete', 'AdminController@deletePage')->name('admin/page/delete');
Route::post('/admin/page/create', 'AdminController@createPage')->name('admin/page/create');
Route::post('/admin/page/edit', 'AdminController@pageEdit')->name('admin/page/edit');
Route::get('/admin/settings', 'AdminController@settings')->name('admin/settings');
Route::post('/admin/settings/update', 'AdminController@settingsUpdate')->name('admin/settings/update');
Route::get('/admin/donate', 'AdminController@donates')->name('admin/donate');
Route::post('/admin/donate/delete', 'AdminController@donateDelete')->name('admin/donate/delete');
Route::post('/admin/donate/create', 'AdminController@donateCreate')->name('admin/donate/create');
Route::get('/admin/donate/{tech_name}', 'AdminController@donateEditor')->name('admin/donate/editor');

// FORUM
Route::get('/forum', 'ForumController@forumIndex')->name('forum');
Route::get('/forum/category/{section_id}', 'ForumController@showSection')->name('forum/category');
