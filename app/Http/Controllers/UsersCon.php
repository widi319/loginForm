<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use App\file;
use Illuminate\Support\Facades\Input;

class usersCon extends Controller
{
  public function index()
  {
    $obj = new Users();
    $data = $obj->listusert();
    return \View::make('users/table2')->with('data',$data);
  }

  public function baru(){
    //if (Auth::check()){
      return \View::make('users/baru2');
    //} else{ return Redirect::to('/'); }
  }


  public function validBaru(){
		//if (Auth::check()){
			$obj = new Users();
			$valid = $obj->insertAll(request()->get('name'), request()->get('password'), request()->get('email'), request()->get('noTelp'), request()->file('foto'),request()->get('password_confirmation'));
			if($valid->fails()){
        return Redirect()->action('usersCon@baru')->withErrors($valid)->withInput();
			}
			else{
        return Redirect()->action('usersCon@index')->with('message','User ' . $obj->userAdmin . ' berhasil ditambahkan');

			}


	}


  public function edit($kd){
    //if (Auth::check()){
      $data = new Users();
      $data->set($kd);
      //echo $data->kdUser;
      return \View::make('users/baru2')->with('data',$data);
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


  public function suspended($kd){
    $data = new Users();
    $data->set($kd);
    $data->suspended();
    return Redirect()->action('usersCon@index')->with('message','status user  ' . $data->nama . '  telah diubah menjadi "suspended"');

  }

  public function active($kd){
    $data = new Users();
    $data->set($kd);
    $data->active();
    return Redirect()->action('usersCon@index')->with('message','status user  ' . $data->nama . '  telah diubah menjadi "aktif"');

  }

  public function delete($kd){
    $data = new Users();
    $data->set($kd);
    $data->delete();
    return Redirect()->action('usersCon@index')->with('message','user  ' . $data->nama . '  berhasil dihapus');

  }


}
