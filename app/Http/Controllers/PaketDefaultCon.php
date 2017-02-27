<?php

namespace App\Http\Controllers;

use App\PaketDefault;
use App\Dedyeskafunc;
use Illuminate\Http\Request;
use App\file;
use Illuminate\Support\Facades\Input;

class PaketDefaultCon extends Controller
{
  public function index()
  {
    $obj = new PaketDefault();
    $search = "";
    $data = $obj->listPaket($search);
    return \View::make('PaketDefault/table')->with('data',$data);
  }

  public function indexWithSearch()
  {
    $obj = new PaketDefault();
    $search = request()->get('katakunci');
    $data = $obj->listPaket($search);
    return \View::make('PaketDefault/table')->with('data',$data)->with('search',$search);

  }

  public function baru(){
    //if (Auth::check()){
      $obj = new PaketDefault();
      return \View::make('PaketDefault/baru');
    //} else{ return Redirect::to('/'); }
  }


  public function validBaru(){
    //if (Auth::check()){
      $obj = new PaketDefault();
      $valid = $obj->insertAll(request()->get('nama'),request()->get('harga'));

      if($valid->fails()){
        return Redirect()->action('PaketDefaultCon@baru')->withErrors($valid)->withInput();
      }
      else{
        return Redirect()->action('PaketDefaultCon@index')->with('message','Paket default  ' . $obj->nama . '  berhasil ditambahkan');

      }

  }

  public function edit($kd){
    //if (Auth::check()){
      $data = new PaketDefault();
      $data->set($kd);
      return \View::make('PaketDefault/baru')->with('data',$data);
    //} else{ //return Redirect::to('/'); }
  }


  public function validEdit(){
    //if (Auth::check()){
      $obj = new PaketDefault();
      $obj->set(request()->get('kdPaketDefault'));
      $valid = $obj->updateAll(request()->get('nama'),request()->get('harga'),request()->get('kdPaketDefault'));

      if($valid->fails()){
        return Redirect()->action('PaketDefaultCon@baru')->withErrors($valid)->withInput();
      }
      else{
        return Redirect()->action('PaketDefaultCon@index')->with('message','Paket default  ' . $obj->nama . '  berhasil diupdate');

      }


  }

  public function hide($kd){
    $data = new PaketDefault();
    $data->set($kd);
    $data->hide();
    return Redirect()->action('PaketDefaultCon@index')->with('message','status user  ' . $data->nama . '  telah diubah menjadi "hide"');

  }

  public function show($kd){
    $data = new PaketDefault();
    $data->set($kd);
    $data->show();
    return Redirect()->action('PaketDefaultCon@index')->with('message','status ' . $data->nama . '  telah diubah menjadi "show"');

  }

  public function delete($kd){
    $data = new PaketDefault();
    $data->set($kd);
    $data->delete();
    return Redirect()->action('PaketDefaultCon@index')->with('message','Paket  ' . $data->nama . '  berhasil dihapus');

  }
}
