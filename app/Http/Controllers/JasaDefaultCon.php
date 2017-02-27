<?php

namespace App\Http\Controllers;

use App\JasaDefault;
use App\Dedyeskafunc;
use Illuminate\Http\Request;
use App\file;
use Illuminate\Support\Facades\Input;

class JasaDefaultCon extends Controller
{
  public function index()
  {
    $obj = new JasaDefault();
    $search = "";
    $data = $obj->listJasa($search);
    return \View::make('JasaDefault/table')->with('data',$data);
  }

  public function indexWithSearch()
  {
    $obj = new JasaDefault();
    $search = request()->get('katakunci');
    $data = $obj->listJasa($search);
    return \View::make('JasaDefault/table')->with('data',$data)->with('search',$search);

  }

  public function baru(){
    //if (Auth::check()){
      $obj = new JasaDefault();
      return \View::make('JasaDefault/baru');
    //} else{ return Redirect::to('/'); }
  }


  public function validBaru(){
    //if (Auth::check()){
      $obj = new JasaDefault();
      $valid = $obj->insertAll(request()->get('nama'),request()->get('harga'));

      if($valid->fails()){
        return Redirect()->action('jasaDefaultCon@baru')->withErrors($valid)->withInput();
      }
      else{
        return Redirect()->action('jasaDefaultCon@index')->with('message','Jasa default  ' . $obj->nama . '  berhasil ditambahkan');

      }

  }

  public function edit($kd){
    //if (Auth::check()){
      $data = new JasaDefault();
      $data->set($kd);
      return \View::make('JasaDefault/baru')->with('data',$data);
    //} else{ //return Redirect::to('/'); }
  }


  public function validEdit(){
    //if (Auth::check()){
      $obj = new JasaDefault();
      $obj->set(request()->get('kdJasaDefault'));
      $valid = $obj->updateAll(request()->get('nama'),request()->get('harga'),request()->get('kdJasaDefault'));

      if($valid->fails()){
        return Redirect()->action('jasaDefaultCon@baru')->withErrors($valid)->withInput();
      }
      else{
        return Redirect()->action('jasaDefaultCon@index')->with('message','Jasa default  ' . $obj->nama . '  berhasil diupdate');

      }


  }

  public function hide($kd){
    $data = new JasaDefault();
    $data->set($kd);
    $data->hide();
    return Redirect()->action('jasaDefaultCon@index')->with('message','status user  ' . $data->nama . '  telah diubah menjadi "hide"');

  }

  public function show($kd){
    $data = new JasaDefault();
    $data->set($kd);
    $data->show();
    return Redirect()->action('jasaDefaultCon@index')->with('message','status ' . $data->nama . '  telah diubah menjadi "show"');

  }

  public function delete($kd){
    $data = new JasaDefault();
    $data->set($kd);
    $data->delete();
    return Redirect()->action('jasaDefaultCon@index')->with('message','Jasa  ' . $data->nama . '  berhasil dihapus');

  }

}
