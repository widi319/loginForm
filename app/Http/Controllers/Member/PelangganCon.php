<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pelanggan;
use Auth;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
class PelangganCon extends Controller
{
  public function index($kd)
  {
    $obj = new Pelanggan();
    $search = "";
    $data = $obj->listPelanggan($search,$kd);
    return \View::make('Pelanggan/table')->with('data',$data)->with('kdRtRwNet',$kd);

  }

  public function indexWithSearch($kd)
  {
    $obj = new Pelanggan();
    $search = "";
    $data = $obj->listPelanggan($search,$kd);
    return \View::make('Pelanggan/table')->with('data',$data)->with('kdRtRwNet',$kd);

  }

  public function baru($kd){
      $obj = new Pelanggan();
      Mapper::map(-8.409518, 115.188919);
      return \View::make('Pelanggan/baru')->with('kdRtRwNet',$kd);
  }

  public function validBaru(){
    $obj = new Pelanggan();
    $lokasimap=
    $valid = $obj->insertAll(request()->get('kdRtRwNet'), request()->get('namaPanggilan'), request()->get('namaLengkap'),request()->file('foto'), request()->get('alamat'), request()->get('latmap'), request()->get('lonmap'), request()->get('noTelp'), request()->get('email'));
    if($valid->fails()){
      return Redirect()->action('Member\PelangganCon@baru', ['kd' => request()->get('kdRtRwNet')])->withErrors($valid)->withInput();
    }
    else{
      return Redirect()->action('Member\PelangganCon@index', ['kd' => request()->get('kdRtRwNet')])->with('message','Barang default  ' . $obj->namaPanggilan . '  berhasil ditambahkan');

    }

      }

    public function edit($kd,$kdPelanggan){
        $data = new Pelanggan();
        $data->set($kdPelanggan);
        Mapper::map($data->lat, $data->long);
        return \View::make('rtrwnet/'.$kd.'/billing/tambahPelanggan')->with('data',$data);

    }


}
