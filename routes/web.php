<?php

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth');

Route::get('/profile', 'UserController@profile')->name('users.profile')->middleware('auth');
Route::put('/profile/{userId}', 'UserController@update')->name('users.update')->middleware('auth');
Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/{userId}', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::get('/users/download/{userId}', 'UserController@downloadKtm')->name('users.download');
Route::delete('/users/{userId}/destroy', 'UserController@destroy')->name('users.destroy');

Route::get('/admin', 'AdminController@index')->name('admin.index')->middleware('auth');
Route::get('/admin/download/{proposalId}', 'AdminController@download')->name('admin.download')->middleware('auth');
Route::put('/admin/approve/{proposalId}', 'AdminController@approve')->name('admin.approve')->middleware('auth');
Route::put('/admin/reject/{proposalId}', 'AdminController@reject')->name('admin.reject')->middleware('auth');

Route::put('/teams/approve/{teamId}', 'TeamController@approve')->name('teams.approve')->middleware('auth');
Route::put('/teams/reject/{teamId}', 'TeamController@reject')->name('teams.reject')->middleware('auth');
Route::resource('teams','TeamController')->middleware('auth');

Route::group(['prefix' => '/teams/{teamId}', 'middleware' => 'auth'], function() {
    Route::get('/proposals/download/{proposalId}', 'ProposalController@download')->name('proposals.download')->middleware('auth');
    Route::resource('proposals', 'ProposalController')->middleware('auth');
});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');