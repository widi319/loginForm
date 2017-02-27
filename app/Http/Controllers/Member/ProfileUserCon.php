<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use Auth;
class profileUserCon extends Controller
{
  public function edit($kd){
    //if (Auth::check()){
      $data = new Users();
      $data->set($kd);
      //echo $data->kdUser;
      if(Auth::user()->id == $kd){//cek user yg diedit sama dengan user yg login
          return \View::make('users/baru2')->with('data',$data);
      }else{
          return Redirect()->action('DashboardCon@index');
      }

    //} else{ //return Redirect::to('/'); }
  }


  public function validEdit(){
    //if (Auth::check()){
      $obj = new Users();
      $obj->set(request()->get('id'));
      if(request()->get('password') != ""){
        $valid = $obj->updateAll(request()->get('name'), request()->get('password'),request()->get('email'), request()->get('noTelp'), request()->file('foto'),request()->get('password_confirmation'));
      }else{
        $valid = $obj->updateAll2(request()->get('name'),request()->get('email'), request()->get('noTelp'), request()->file('foto'));

      }
      if($valid->fails()){
          return Redirect()->action('usersCon@edit')->withErrors($valid)->withInput();
      }
      else{
          return Redirect()->action('usersCon@index')->with('message','User ' . $obj->userAdmin . ' berhasil diupdate');
      }

    //} else{ return Redirect::to('/'); }
  }
}
