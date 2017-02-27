<?php

namespace App\Http\Controllers;

use App\superAdmin;
use Illuminate\Http\Request;
use App\file;
use Illuminate\Support\Facades\Input;

class superAdminCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $obj = new superAdmin();
      $data = $obj->listSuperAdmin();
      return \View::make('superadmin/table')->with('data',$data);
    }


    public function baru(){
      //if (Auth::check()){
        return \View::make('superadmin/baru');
      //} else{ return Redirect::to('/'); }
    }

    public function validBaru(){
  		//if (Auth::check()){
  			$obj = new superAdmin();
  			$valid = $obj->insertAll(request()->get('userName'), request()->get('password'), request()->get('namaLengkap'),request()->file('foto'),request()->get('password_confirmation'));


  			if($valid->fails()){
          return Redirect()->action('superAdminCon@baru')->withErrors($valid)->withInput();
  			}
  			else{
          return Redirect()->action('superAdminCon@index')->with('message','Super Admin' . $obj->userAdmin . 'berhasil ditambahkan');

  			}


  	}


    public function edit($kd){
      //if (Auth::check()){
        $data = new superAdmin();
        $data->set($kd);
        //echo $data->kdUser;
        return \View::make('superadmin/baru')->with('data',$data);
      //} else{ //return Redirect::to('/'); }
    }


    public function validEdit(){
      //if (Auth::check()){

        $obj = new superAdmin();
        $obj->set(request()->get('kdSA'));
        $valid = $obj->updateAll(request()->get('userName'), request()->get('password'), request()->get('namaLengkap'),request()->file('foto'),request()->get('password_confirmation'));

        if($valid->fails()){
            return Redirect()->action('superAdminCon@edit')->withErrors($valid)->withInput();
        }
        else{
            return Redirect()->action('superAdminCon@index')->with('message','Super Admin ' . $obj->userAdmin . ' berhasil diupdate');
        }

      //} else{ return Redirect::to('/'); }
    }

}
