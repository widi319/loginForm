<?php

namespace App\Http\Controllers;

use Session;
use App\Dashboard;
use App\RtRwNet;
use Illuminate\Http\Request;
use App\file;
use Auth;
use Illuminate\Support\Facades\Input;

class dashboardCon extends Controller
{
    public function index(){
      if (Auth::check()){//jika login
        if(Auth::user()->role == 1){//jika admin
            return \View::make('dashboard');
        }else{
          $new =new Dashboard();
          $data = $new->showRtRwUser(Auth::user()->id);
          $contx = count($data);
          Session::forget('RtRwNetList');
          Session::push('RtRwNetList', $data);
          //dd(Session::get('RtRwNetList'));
          return \View::make('dashboard')->with('data',$data)->with('contx',$contx);
        }
      }else{
        return \view('/');
      }
    }

    Public function validBaruDashboard(){
      $obj = new RtRwNet();
      $valid = $obj->insertAllOnDashboard(request()->get('nama'),request()->file('logo'));
      if($valid->fails()){
        return Redirect()->action('DashboardCon@index')->withErrors($valid)->withInput();
      }
      else{
        return Redirect()->action('DashboardCon@index')->with('message','RT RW NET  ' . $obj->nama . '  berhasil ditambahkan');

      }
    }

    public function profileRtRwNet(){

    }


}
