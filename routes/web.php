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

Route::group(['middleware' => 'web'], function (){
  Route:auth();
});//memeriksa session CSRF(udah login atau belum)




//dashboard


//route yang dapat diakse semua user
Route::get('/', function () {
    return view('/login');
});
Auth::routes();
//sosial login
Route::get('social/redirect/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('social/redirect/{provider}/callback', 'Auth\SocialController@handleProviderCallback');


Route::group(['middleware'=>['web','auth']],function(){
Route::get('dashboard','DashboardCon@index');
Route::get('home','DashboardCon@index');
});


Route::group(['middleware'=>['web','auth']],function(){
//RtRwNet
Route::post('rtrwnet/validBaruDashboard','DashboardCon@validBaruDashboard');
Route::get('rtrwnet/{kd}/profileRtRwNet','Member\RtRwNetMemberCon@profileRtRwNet');
Route::post('rtrwnet/validEdit','Member\RtRwNetMemberCon@validEdit');
Route::get('rtrwnet/{kd}/tambahPengelola','Member\RtRwNetMemberCon@tambahPengelola');
Route::get('rtrwnet/editPengelola/{kd}','Member\RtRwNetMemberCon@editPengelola');
Route::get('rtrwnet/searchTable','Member\RtRwNetMemberCon@searchTable');
Route::post('rtrwnet/addStaff/{kdRtRwNet}','Member\RtRwNetMemberCon@addStaff');
Route::get('rtrwnet/delete/{kd}','Member\RtRwNetMemberCon@delete');
//users
Route::get('profile/edit/{kd}','Member\ProfileUserCon@edit');
Route::post('profile/validEdit','usersCon@validEdit');
Route::get('rtrwnet/{kd}/listPelanggan','Member\Pelanggan@');
//Pelanggan RtRwNet
Route::get('rtrwnet/{kd}/billing/listPelanggan','Member\PelangganCon@index');
Route::post('rtrwnet/{kd}/billing/listPelangganWithSearch','Member\PelangganCon@indexWithSearch');
Route::get('rtrwnet/{kd}/billing/tambahPelanggan','Member\PelangganCon@baru');
Route::post('rtrwnet/{kd}/billing/validBaru','Member\PelangganCon@validBaru');
Route::get('rtrwnet/{kd}/billing/editPelanggan/{kdPelanggan}','Member\PelangganCon@edit');
Route::post('rtrwnet/{kd}/billing/validEdit','Member\PelangganCon@validEdit');


//Map
Route::get('map/showEditMap','MapController@showEditMap');
});


//route yang hanya dapat di akses admin
Route::group(['middleware' => ['web','auth','admin']], function (){
  //user
Route::get('master/user/list','usersCon@index');
Route::get('master/user/edit/{kd}','usersCon@edit');
Route::get('master/user/baru','usersCon@baru');
Route::post('master/user/validBaru','usersCon@validBaru');
Route::get('master/user/suspended/{kd}','usersCon@suspended');
Route::get('master/user/active/{kd}','usersCon@active');
Route::get('master/user/delete/{kd}','usersCon@delete');
//RtRwNet
Route::get('master/rtrwnet/list','rtRwNetCon@index');
Route::get('master/rtrwnet/baru','rtRwNetCon@baru');
Route::post('master/rtrwnet/validBaru','rtRwNetCon@validBaru');
Route::get('master/rtrwnet/edit/{kd}','rtRwNetCon@edit');
Route::get('master/rtrwnet/tambahPengelola/{kd}','rtRwNetCon@tambahPengelola');
Route::get('master/rtrwnet/editPengelola/{kd}','rtRwNetCon@editPengelola');
Route::get('master/rtrwnet/searchTable','rtRwNetCon@searchTable');
Route::post('master/rtrwnet/addStaff/{kdRtRwNet}','rtRwNetCon@addStaff');
Route::get('master/rtrwnet/suspended/{kd}','rtRwNetCon@suspended');
Route::get('master/rtrwnet/active/{kd}','rtRwNetCon@active');
Route::get('master/rtrwnet/delete/{kd}','rtRwNetCon@delete');
//barang default
Route::get('master/barangDefault/list','barangDefaultCon@index');
Route::post('master/barangDefault/listWithSearch','barangDefaultCon@indexWithSearch');
Route::get('master/barangDefault/baru','barangDefaultCon@baru');
Route::post('master/barangDefault/validBaru','barangDefaultCon@validBaru');
Route::get('master/barangDefault/edit/{kd}','barangDefaultCon@edit');
Route::post('master/barangDefault/validEdit','barangDefaultCon@validEdit');
Route::get('master/barangDefault/hide/{kd}','barangDefaultCon@hide');
Route::get('master/barangDefault/show/{kd}','barangDefaultCon@show');
Route::get('master/barangDefault/delete/{kd}','barangDefaultCon@delete');
//jasa default
Route::get('master/jasaDefault/list','jasaDefaultCon@index');
Route::post('master/jasaDefault/listWithSearch','jasaDefaultCon@indexWithSearch');
Route::get('master/jasaDefault/baru','jasaDefaultCon@baru');
Route::post('master/jasaDefault/validBaru','jasaDefaultCon@validBaru');
Route::get('master/jasaDefault/edit/{kd}','jasaDefaultCon@edit');
Route::post('master/jasaDefault/validEdit','jasaDefaultCon@validEdit');
Route::get('master/jasaDefault/hide/{kd}','jasaDefaultCon@hide');
Route::get('master/jasaDefault/show/{kd}','jasaDefaultCon@show');
Route::get('master/jasaDefault/delete/{kd}','jasaDefaultCon@delete');
//paket default
Route::get('master/paketDefault/list','PaketDefaultCon@index');
Route::post('master/paketDefault/listWithSearch','PaketDefaultCon@indexWithSearch');
Route::get('master/paketDefault/baru','PaketDefaultCon@baru');
Route::post('master/paketDefault/validBaru','PaketDefaultCon@validBaru');
Route::get('master/paketDefault/edit/{kd}','PaketDefaultCon@edit');
Route::post('master/paketDefault/validEdit','PaketDefaultCon@validEdit');
Route::get('master/paketDefault/hide/{kd}','PaketDefaultCon@hide');
Route::get('master/paketDefault/show/{kd}','PaketDefaultCon@show');
Route::get('master/paketDefault/delete/{kd}','PaketDefaultCon@delete');
});
//route yang hanya dapat di akses admin
