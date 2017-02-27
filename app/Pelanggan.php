<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Dedyeskafunc;
use App\ImageAll;

class Pelanggan extends Model
{
    public $kdPelanggan;
    public $kdRtRwNet;
    public $namaPanggilan;
    public $namaLengkap;
    public $foto;
    public $alamat;
    public $lokasiMap;
    public $latmap;
    public $longmap;
    public $noTelp;
    public $email;
    public $deleted = false;
    public $suspended = false;

    private $msTable = 'ms_pelanggan';
    private $primary = 'kdPelanggan';

  	public function Pelanggan(){}

    public function listPelanggan($search,$kd){
          $like = '%'.$search.'%';
          $result = DB::table('ms_pelanggan')
              ->where('namaLengkap','like',$like)
              ->where('kdRtRwNet','=',$kd)
              ->where('deleted','=',0)
              ->where('suspended','=',0)
              ->orderBy('namaLengkap')->paginate(20);
              return $result;
      }


      public function set($kdPelanggan){
        $select = array('kdPelanggan',
                    'kdRtRwNet',
                    'namaPanggilan',
                    'namaLengkap',
                    'foto',
                    'alamat',
                    'lokasiMap',
                    'lat',
                    'long',
                    'noTelp',
                    'email',
                    'deleted',
                    'suspended');

        $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kdPelanggan)->first();
        $this->kdPelanggan = $result->kdPelanggan;
        $this->kdRtRwNet = $result->kdRtRwNet;
        $this->namaPanggilan = $result->namaPanggilan;
        $this->namaLengkap = $result->namaLengkap;
        $this->foto = $result->foto;
        $this->alamat = $result->alamat;
        $this->lokasiMap = $result->lokasiMap;
        $this->latmap = $result->lat;
        $this->longmap = $result->long;
        $this->noTelp = $result->noTelp;
        $this->email = $result->email;
        if($result->deleted == 1){$this->deleted = true;}
        if($result->suspended == 1){$this->suspended = true;}
      }

      public function insertAll($kdRtRwNet, $namaPanggilan, $namaLengkap, $foto, $alamat, $latmap,$longmap, $noTelp, $email){
    		$ded = new Dedyeskafunc();
    		$kd = $ded->nextCode($this->primary,$this->msTable);

    		$insert = array('kdPelanggan'=> $kd,
                'kdRtRwNet'=> $kdRtRwNet,
                'namaPanggilan' => $namaPanggilan,
    						'namaLengkap'=>$namaLengkap,
    						'foto'=>$foto,
    						'alamat'=>$alamat,
    						'lat'=>$latmap,
                'long'=>$longmap,
    						'noTelp'=>$noTelp,
    						'email'=>$email,
    						'deleted'=> 0,
    						'suspended' => 0);

    		$rules = array(	'namaPanggilan' => 'required|min:3|max:30',
    						'alamat'=>'required|max:100',
    						'noTelp' => 'required|max:15',
    						'email' => 'required|email|max:100'
    						);

    		$valid = \Validator::make($insert, $rules);

    		if($valid->fails() != true){//kesalahan tidak true = true
          if($foto == null){
            $insert2 = array('kdPelanggan'=> $kd,
                    'kdRtRwNet'=> $kdRtRwNet,
                    'namaPanggilan' => $namaPanggilan,
        						'namaLengkap'=>$namaLengkap,
        						'alamat'=>$alamat,
                    'lat'=>$latmap,
                    'long'=>$longmap,
        						'noTelp'=>$noTelp,
        						'email'=>$email,
        						'deleted'=> 0,
        						'suspended' => 0);
          }else{
            $destinationPath = 'uploadgambar';
            $extension = $foto->getClientOriginalExtension();
            $filename = rand(11111,99999).'.'.$extension;
            $foto->move($destinationPath, $filename);
            $insert2 = array('kdPelanggan'=> $kd,
                    'kdRtRwNet'=> $kdRtRwNet,
                    'namaPanggilan' => $namaPanggilan,
        						'namaLengkap'=>$namaLengkap,
        						'foto'=>$filename,
        						'alamat'=>$alamat,
                    'lat'=>$latmap,
                    'long'=>$longmap,
        						'noTelp'=>$noTelp,
        						'email'=>$email,
        						'deleted'=> 0,
        						'suspended' => 0);
          $imageupload = new ImageAll();
          $upload = $imageupload->updateFoto($filename,$kd);//save to tabel image

          }

    			DB::table($this->msTable)->insert($insert2);

          $this->kdPelanggan = $kd;
          $this->kdRtRwNet = $kdRtRwNet;
    			$this->namaPanggilan = $namaPanggilan;
    			$this->namaLengkap =$namaLengkap;
    			$this->alamat = $alamat;
          $this->latmap = $latmap;
    			$this->noTelp = $noTelp;
    			$this->email = $email;
    			$this->deleted = false;
    			$this->suspended = false;
    		}
    		return $valid;

    	}


      public function updateAll($kdRtRwNet, $namaPanggilan, $namaLengkap, $foto, $alamat, $lokasiMap, $noTelp, $email){

        $update = array('kdRtRwNet'=> $kdRtRwNet,
                'namaPanggilan' => $namaPanggilan,
    						'namaLengkap'=>$namaLengkap,
    						'foto'=>$foto,
    						'alamat'=>$alamat,
    						'lokasiMap'=>$lokasiMap,
    						'noTelp'=>$noTelp,
    						'email'=>$email,
    						'deleted'=> 0,
    						'suspended' => 0);

    		$rules = array(	'namaPanggilan' => 'required|min:3|max:30',
    						'alamat'=>'required|max:100',
    						'noTelp' => 'required|max:15',
    						'email' => 'required|email|max:100');

    		$valid = \Validator::make($update, $rules);
    		if($valid->fails() != true){//kesalahan tidak true = true
    			//push
          if($foto == null){
            $update2 = array('kdRtRwNet'=> $kdRtRwNet,
                    'namaPanggilan' => $namaPanggilan,
        						'namaLengkap'=>$namaLengkap,
        						'alamat'=>$alamat,
        						'lokasiMap'=>$lokasiMap,
        						'noTelp'=>$noTelp,
        						'email'=>$email);
          }else{
            $destinationPath = 'uploadgambar';
            $extension = $foto->getClientOriginalExtension();
            $filename = rand(11111,99999).'.'.$extension;
            $foto->move($destinationPath, $filename);
            $update2 = array('namaPanggilan' => $namaPanggilan,
        						'namaLengkap'=>$namaLengkap,
        						'foto'=>$filename,
        						'alamat'=>$alamat,
        						'lokasiMap'=>$lokasiMap,
        						'noTelp'=>$noTelp,
        						'email'=>$email);
            $imageupload = new ImageAll();
            $upload = $imageupload->updateFoto($filename,$this->kdPelanggan);//save to tabel image
          }


    			DB::table($this->msTable)->where($this->primary,'=',$this->kdPelanggan)->update($update2);

          $this->kdPelanggan = $kdPelanggan;
          $this->kdRtRwNet = $kdRtRwNet;
    			$this->namaPanggilan = $namaPanggilan;
    			$this->namaLengkap =$namaLengkap;
    			$this->alamat = $alamat;
    			$this->lokasiMap = $lokasiMap;
    			$this->noTelp = $noTelp;
    			$this->email = $email;

    		}

    		return $valid;

    	}

      public function delete(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPelanggan)->update(array('deleted' => 1));
        $this->deleted = true;
      }
      public function suspend(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPelanggan)->update(array('suspended' => 1));
        $this->suspended = true;
      }
      public function active(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPelanggan)->update(array('suspended' => 0));
        $this->suspended = false;
      }

}
