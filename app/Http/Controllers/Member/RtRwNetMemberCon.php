<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RtRwNet;
class RtRwNetMemberCon extends Controller
{
  public function profileRtRwNet($kd){
    //$kd = $request->get('kdRtRwNet','');
    $data = new RtRwNet();
    $data->set($kd);
    $list = $data->listUserRtRwNet();
    //echo $data2->userName;
    //echo $data->kdUser;
    return \View::make('rtrwnet/baru2')->with('data',$data)->with('list',$list);
  }

  public function validEdit(){
    //if (Auth::check()){

      $obj = new RtRwNet();
      $obj->set(request()->get('kdRtRwNet'));
      $valid = $obj->updateAll(request()->get('nama'), request()->get('alamat'), request()->get('noTelp'), request()->get('fanpage'), request()->get('noTelp'),request()->get('email'), request()->file('logo'));

      if($valid->fails()){
          return Redirect()->action('Member\RtRwNetMemberCon@edit')->withErrors($valid)->withInput();
      }
      else{
          return Redirect()->action('DashboardCon@index')->with('message','Data RT RW NET  ' . $obj->nama . '  berhasil diupdate');
      }

    //} else{ return Redirect::to('/'); }
  }

  public function tambahPengelola($kd){
    $obj = new RtRwNet();
    $obj->set($kd);
    return \View::make('rtrwnet/tambahPengelola')->with('data',$obj);
  }


  public function searchTable(Request $request){

  $katakuncisend = $request->get('katakunci','');

    $obj = new RtRwNet();
    $data = $obj->listUserName($katakuncisend);
    return \View::make('rtrwnet/tabelCari')->with('data',$data);
  }

  public function addStaff($kdRtRwNet){
    $obj = new RtRwNet();
    $obj->set($kdRtRwNet);

    $kdUser = $obj->selectStaffByEmail(request()->get('email'));
    $obj->deleteStaff($kdUser);

    if(request()->get('owner') == 'on'){
        $obj->addOwner($kdUser);
    }else{
      $obj->delOwner($kdUser);
        if(request()->get('profile') == 'on'){

            $obj->addStafProfil($kdUser);
        }else{
              $obj->delProfil($kdUser);
        }
        if(request()->get('komplain') == 'on'){

          $obj->addStafKomplain($kdUser);
        }else{
          $obj->delKomplain($kdUser);
        }
        if(request()->get('transaksi') == 'on'){

            $obj->addStafTransaksi($kdUser);
        }else{
          $obj->delTransaksi($kdUser);
        }
        if(request()->get('jadwal') == 'on'){

            $obj->addStafJadwal($kdUser);
        }else{
          $obj->delJadwal($kdUser);
        }
        if(request()->get('proyek') == 'on'){

            $obj->addStafProyek($kdUser);
        }else{
          $obj->delProyek($kdUser);
        }
        if(request()->get('billing') == 'on'){

            $obj->addStafBilling($kdUser);
        }else{
          $obj->delBilling($kdUser);
        }
      }
      return Redirect()->action('rtRwNetCon@index');
  }

  public function editPengelola($kd,Request $request){
  $kdUser2 = $request->get('kdUser','');
  $data = new RtRwNet();
  //$data->set($kd);
  $data2 = $data->updateStaff($kdUser2,$kd);

  return \View::make('rtrwnet/tambahPengelola')->with('data',$data2);
  }


  public function delete($kd){
  $data = new RtRwNet();
  $data->set($kd);
  $data->delete();
  return Redirect()->action('rtRwNetCon@index')->with('message','RT RW NET  ' . $data->nama . '  berhasil dihapus');

  }
}
