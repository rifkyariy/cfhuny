<?php

Route::get('/', function(){
    $berita = \DB::table('news')
                ->get();
    return view('index',['berita' => $berita]);
})->name('landingpage');

Route::get('/detailBerita/{id}', function($id){
    $detailBerita = \DB::table('news')
                ->where('id',$id)
                ->get();
    return view('detailBerita',['detail' => $detailBerita]);
});

Route::get('/bidangPendidikan', function () {
    return view('bidangPendidikan');
});
Route::get('/bidangKwu', function () {
    return view('bidangKwu');
});
Route::get('/bidangSeni', function () {
    return view('bidangSeni');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth');

Route::get('/profile', 'UserController@profile')->name('users.profile');
Route::put('/profile/{userId}', 'UserController@update')->name('users.update')->middleware('auth');
Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/{userId}', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::get('/users/download/{userId}', 'UserController@downloadKtm')->name('users.download');
Route::delete('/users/{userId}/destroy', 'UserController@destroy')->name('users.destroy');

Route::get('/admin', 'AdminController@index')->name('admin.index')->middleware('auth');
Route::get('/admin/download/{proposalId}', 'AdminController@download')->name('admin.download')->middleware('auth');
Route::put('/admin/approve/{proposalId}', 'AdminController@approve')->name('admin.approve')->middleware('auth');
Route::put('/admin/reject/{proposalId}', 'AdminController@reject')->name('admin.reject')->middleware('auth');

Route::resource('/teams','TeamsController')->middleware('auth');
Route::get('/teams/{teamId}/{memberId}/remove', 'TeamsController@removeMember')->name('teams.removemember')->middleware('auth');
Route::put('/teams/approve/{teamId}', 'TeamsController@approve')->name('teams.approve')->middleware('auth');
Route::put('/teams/reject/{teamId}', 'TeamsController@reject')->name('teams.reject')->middleware('auth');

Route::group(['prefix' => '/teams/{teamId}', 'middleware' => 'auth'], function() {
    Route::get('/proposals/download/{proposalId}', 'ProposalController@download')->name('proposals.download')->middleware('auth');
    Route::resource('proposals', 'ProposalController')->middleware('auth');

    Route::resource('submissions', 'SubmissionController')->middleware('auth');
});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});