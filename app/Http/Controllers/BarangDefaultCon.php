<?php

namespace App\Http\Controllers;

use App\BarangDefault;
use App\Dedyeskafunc;
use Illuminate\Http\Request;
use App\file;
use Auth;
use Illuminate\Support\Facades\Input;

class barangDefaultCon extends Controller
{
    //
    public function index()
    {
      //return Auth::user();
      if (Auth::check()){
      $obj = new BarangDefault();
      $search = "";
      $kdMerk = "";
      $data = $obj->listBarang($search,$kdMerk);
      $merk = $obj->listMerk();
      //$kategoriTabel = $obj->kategoriTabel;


      //$ded = new Dedyeskafunc();
      //$data->harga = $ded->separatorAngka('Rp',$data->harga);
      //return \View::make('BarangDefault/table')->with('data',$data)->with('merk',$merk)->with('kategoriTabel',$kategoriTabel);
      return \View::make('BarangDefault/table')->with('data',$data)->with('merk',$merk);
      }else{
        return \view('/login');
      }
    }


    public function indexWithSearch()
    {
      if (Auth::check()){
      $obj = new BarangDefault();
      $search = request()->get('katakunci');
      $kdMerk = request()->get('kdMerk');
      $data = $obj->listBarang($search,$kdMerk);
      $merk = $obj->listMerk();
      //$kategoriTabel = $obj->kategoriTabel;
      //$ded = new Dedyeskafunc();
      //$data->harga = $ded->separatorAngka('Rp',$data->harga);
      //return \View::make('BarangDefault/table')->with('data',$data)->with('merk',$merk)->with('search',$search)->with('kdMerk',$kdMerk)->with('kategoriTabel',$kategoriTabel);
      return \View::make('BarangDefault/table')->with('data',$data)->with('merk',$merk)->with('search',$search)->with('kdMerk',$kdMerk);
      }else{
        return \view('/login');
      }
    }



    public function baru(){
      //if (Auth::check()){
    if (Auth::check()){
        $obj = new BarangDefault();
        $listmerk = $obj->listMerk();
        return \View::make('BarangDefault/baru')->with('listmerk',$listmerk);
      //} else{ return Redirect::to('/'); }
    }else{
      return \view('/login');
    }
    }

    public function validBaru(){
      if (Auth::check()){
        $obj = new BarangDefault();
        $valid = $obj->insertAll(request()->get('nama'), request()->get('merk'), request()->get('harga'), request()->get('spec'), request()->get('kategori'),request()->file('foto'));

        if($valid->fails()){
          return Redirect()->action('barangDefaultCon@baru')->withErrors($valid)->withInput();
        }
        else{
          return Redirect()->action('barangDefaultCon@index')->with('message','Barang default  ' . $obj->nama . '  berhasil ditambahkan');

        }
      }else{
        return \view('/login');
      }

    }

    public function edit($kd){
      if (Auth::check()){
        $data = new BarangDefault();
        $data->set($kd);
        $listmerk = $data->listMerk();
        $listCategory = $data->listCategory();
        $kategori = "";
        foreach ($listCategory as $sku){
          if($kategori != ""){
            $kategori = $kategori.",";
          }
            $kategori = $kategori.$sku->nama;
        // Code Here
        }
        return \View::make('BarangDefault/baru')->with('data',$data)->with('listmerk',$listmerk)->with('kategori',$kategori);
      }else{
        return \view('/login');
      }
    }


    public function validEdit(){
      if (Auth::check()){
        $obj = new BarangDefault();
        $obj->set(request()->get('kdBarangDefault'));
        $valid = $obj->updateAll(request()->get('nama'), request()->get('merk'), request()->get('harga'), request()->get('spec'), request()->get('kategori'),request()->file('foto'),request()->get('kdBarangDefault'));

        if($valid->fails()){
          return Redirect()->action('barangDefaultCon@baru')->withErrors($valid)->withInput();
        }
        else{
          return Redirect()->action('barangDefaultCon@index')->with('message','Barang default  ' . $obj->nama . '  berhasil diupdate');

        }
      }else{
        return \view('/login');
      }

    }

    public function hide($kd){
      if (Auth::check()){
      $data = new BarangDefault();
      $data->set($kd);
      $data->hide();
      return Redirect()->action('barangDefaultCon@index')->with('message','status user  ' . $data->nama . '  telah diubah menjadi "hide"');
    }else{
      return \view('/login');
    }
    }

    public function show($kd){
        if (Auth::check()){
      $data = new BarangDefault();
      $data->set($kd);
      $data->show();
      return Redirect()->action('barangDefaultCon@index')->with('message','status ' . $data->nama . '  telah diubah menjadi "show"');
    }else{
      return \view('/login');
    }
    }

    public function delete($kd){
        if (Auth::check()){
      $data = new BarangDefault();
      $data->set($kd);
      $data->delete();
      return Redirect()->action('barangDefaultCon@index')->with('message','Barang  ' . $data->nama . '  berhasil dihapus');
    }else{
      return \view('/login');
    }
    }


}
