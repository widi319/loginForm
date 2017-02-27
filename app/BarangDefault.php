<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Dedyeskafunc;
use App\ImageAll;
class BarangDefault extends Model
{

  	public $kdBarangDefault;
  	public $nama;
  	public $spec;
  	public $harga;
  	public $merk;
  	public $foto;
  	public $deleted = false;
  	public $hided = false;
  	public $kategoriItem = array();
    public $kategoriTabel = array();
  	public $kdRtRwNet;

    private $msTable = 'ms_barang_default';
    private $primary = 'kdBarangDefault';

  	public function BarangDefault(){}


    public function listBarang($search,$merk){
        $select = array('kdBarangDefault','ms_barang_default.nama','spec','harga','ms_merk.nama as merk','foto','deleted','hided');
        $like = '%'.$search.'%';
        if($merk == ""){
          $result = DB::table('ms_barang_default')->select($select)
              ->where('ms_barang_default.nama','like',$like)
              ->where('ms_barang_default.deleted','=',0)
              ->join('ms_merk','ms_barang_default.merk','=','ms_merk.nama')
              ->orderBy('ms_barang_default.nama')->paginate(20);
        }else{
          $result = DB::table('ms_barang_default')->select($select)
              ->where('ms_barang_default.merk','=',$merk)
              ->where('ms_barang_default.deleted','=',0)
              ->where('ms_barang_default.nama','like',$like)
              ->join('ms_merk','ms_barang_default.merk','=','ms_merk.nama')
              ->orderBy('ms_barang_default.nama')->paginate(20);

        }
            $a =0;
            foreach ($result as $resultx){
                    $result2 = DB::table('ms_kategori')->select(array('ms_kategori.nama as nama'))
                    ->join('ms_kategori_barang','ms_kategori.kdKategori','=','ms_kategori_barang.kdKategori')
                    ->where('ms_kategori_barang.kdBarangDefault','=',$resultx->kdBarangDefault)->get();
                    $ktgry = "";
                    foreach ($result2 as $result2x){
                        if($ktgry !=""){
                          $ktgry = $ktgry.",";
                        }
                        $ktgry = $ktgry.$result2x->nama;
                    }

            $kategoriTabel[$a]= $ktgry;
            $a++;
            }

              return $result;
    	}

    public function insertKategoribarang($kategoriItem,$kdBarangDefault){
        DB::table('ms_kategori_barang')->where('kdBarangDefault','=',$kdBarangDefault)->delete();
        for($a=0;$a<count($kategoriItem);$a++){
            DB::table('ms_kategori_barang')->insert(array('kdKategori'=> $kategoriItem[$a],'kdBarangDefault' => $kdBarangDefault));
        }

    }

    public function set($kdBarangDefault){
      $select = array('kdBarangDefault',
                      'nama',
                      'spec',
                      'harga',
                      'merk',
                      'foto',
                      'deleted',
                      'hided');

      $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kdBarangDefault)->first();
      $this->kdBarangDefault = $result->kdBarangDefault;
      $this->nama = $result->nama;
      $this->spec = $result->spec;
      $this->harga = $result->harga;
      $this->merk = $result->merk;
      $this->foto = $result->foto;
      if($result->deleted == 1){$this->deleted = true;}
      if($result->suspended == 1){$this->suspended = true;}
  	}


    public function updateFoto($image,$id){
      DB::table('images')->where('id','=',$id)->where('tabelUses','=','Users')->update(array('tabelUses' => '','id'=> 0));
      $ded = new Dedyeskafunc();
      $kd = $ded->nextCode('images','images');
      $insert = array('images'=> $kd,'id'=> $id,'waktu' => date('Y-m-d'),'name'=>$image,'tabelUses'=>'Users');
      DB::table('images')->insert($insert);
    }


  	public function insertAll($nama,$merk,$harga, $spec, $kategoriItemArr,$foto){

      $ded = new Dedyeskafunc();
  		$kd = $ded->nextCode($this->primary,$this->msTable);
  		$insert = array('kdBarangDefault'=> $kd,
              'nama' => $nama,
  						'spec'=>$spec,
  						'harga'=>$harga,
  						'merk'=>$merk,
  						'foto'=>$foto,
  						'deleted'=> 0,
  						'hided' => 0);

  		$rules = array(	'nama' => 'required|min:3|max:30',
  						'spec'=>'required',
  						'harga' => 'required',
  						'merk'=>'required');

  		$valid = \Validator::make($insert, $rules);

  		if($valid->fails() != true){//kesalahan tidak true = true
        if($foto == null){
          $insert2 = array('kdBarangDefault'=> $kd,
                  'nama' => $nama,
      						'spec'=>$spec,
      						'harga'=>$harga,
      						'merk'=>$merk,
      						'deleted'=> 0,
      						'hided' => 0);
        }else{
          $destinationPath = 'uploadgambar';
          $extension = $foto->getClientOriginalExtension();
          $filename = rand(11111,99999).'.'.$extension;
          $foto->move($destinationPath, $filename);
          $insert2 = array('kdBarangDefault'=> $kd,
                  'nama' => $nama,
      						'spec'=>$spec,
      						'harga'=>$harga,
      						'merk'=>$merk,
      						'foto'=>$filename,
      						'deleted'=> 0,
      						'hided' => 0);
          $imageupload = new ImageAll();
          $upload = $imageupload->updateFoto($filename,$kd);//save to tabel image
        }

  			DB::table($this->msTable)->insert($insert2);
        $this->kdBarangDefault = $kd;
  			$this->nama = $nama;
  			$this->spec =$spec;
  			$this->harga = $harga;
  			$this->merk = $merk;
  			$this->foto = $foto;
  			$this->deleted = false;
  			$this->hided = false;
        if(count($kategoriItemArr) != 0){
        $kategoriItem = $this->updKategoriItem($kategoriItemArr);//insert dan update kategori
        $this->insertKategoribarang($kategoriItem,$kd);//insert kategori barang default
        $this->updateMerk($merk);
      }
  		}
  		return $valid;
  	}



  	public function updateAll($nama,$merk,$harga, $spec, $kategoriItemArr,$foto,$kdBarangDefault){
      $update = array('nama' => $nama,
                      'spec'=>$spec,
                      'harga'=>$harga,
                      'merk'=>$merk,
                      'foto'=>$foto);
      //rules array
      $rules = array(	'nama' => 'required|min:3|max:30',
  						'spec'=>'required',
  						'harga' => 'required',
  						'merk'=>'required');

      $valid = \Validator::make($update, $rules);

      if($valid->fails() != true){//kesalahan tidak true = true

        if($foto == null){
          $update2 = array('nama' => $nama,
                  'spec'=>$spec,
                  'harga'=>$harga,
                  'merk'=>$merk);
        }else{
          $destinationPath = 'uploadgambar';
          $extension = $foto->getClientOriginalExtension();
          $filename = rand(11111,99999).'.'.$extension;
          $foto->move($destinationPath, $filename);
          $update2 = array(
                  'nama' => $nama,
                  'spec'=>$spec,
                  'harga'=>$harga,
                  'merk'=>$merk,
                  'foto'=>$filename);
                  $imageupload = new ImageAll();
                  $upload = $imageupload->updateFoto($filename,$kdBarangDefault);//save to tabel image
        }

        DB::table($this->msTable)->where($this->primary,'=',$kdBarangDefault)->update($update2);
        $this->kdBarangDefault = $kdBarangDefault;
        $this->nama = $nama;
        $this->spec = $spec;
        $this->harga = $harga;
        $this->merk = $merk;
        $this->foto = $foto;
        if(count($kategoriItemArr) != 0){
        $kategoriItem = $this->updKategoriItem($kategoriItemArr);//insert dan update kategori
        $this->insertKategoribarang($kategoriItem,$kdBarangDefault);//insert kategori barang default
        $this->updateMerk($merk);
        }

      }

      return $valid;
  	}

  	public function updKategoriItem($namaKategoriArr2){
  		$kdKategoriArr = array();
      $namaKategoriArr= explode(',',$namaKategoriArr2);
  		for($i=0; $i<count($namaKategoriArr); $i++){
  			$data = DB::table('ms_kategori')->where('nama','=',$namaKategoriArr[$i])->first();
  			if($data == NULL){
  				$ded = new Dedyeskafunc();
  				$kd = $ded->nextCode('kdKategori','ms_kategori');
  				DB::table('ms_kategori')->insert(array('kdKategori'=>$kd,'nama' => $namaKategoriArr[$i]));
  				$kdKategoriArr[$i] = $kd;
  			}
  			else{
  				$kdKategoriArr[$i] = $data->kdKategori;
  			}
  		}

  		return $kdKategoriArr;

  	}

    public function updateMerk($merk){
      $result = DB::table('ms_merk')->where('nama','=',$merk)->select('nama')->first();
      if($result->nama != $merk){
        $ded = new Dedyeskafunc();
        $kd = $ded->nextCode('kdMerk','ms_merk');
        $insert = array('kdMerk'=> $kd,'nama'=>$merk);
        DB::table('ms_merk')->insert($insert);
      }
    }

    public function listMerk(){
      $select = array('kdMerk','nama');
        $result = DB::table('ms_merk')->select($select)->orderBy('nama')->get();
        return $result;
    }

    public function listCategory(){
        $select = array('ms_kategori.nama as nama');
          $result = DB::table('ms_kategori')->select($select)
          ->join('ms_kategori_barang','ms_kategori.kdKategori','=','ms_kategori_barang.kdKategori')
          ->where('ms_kategori_barang.kdBarangDefault','=',$this->kdBarangDefault)->get();
          return $result;

    }

  	public function delete(){
      DB::table($this->msTable)->where($this->primary,'=',$this->kdBarangDefault)->update(array('deleted' => 1));
      $this->deleted = true;
  	}
  	public function hide(){
      DB::table($this->msTable)->where($this->primary,'=',$this->kdBarangDefault)->update(array('hided' => 1));
      $this->hided = true;
  	}
  	public function show(){
      DB::table($this->msTable)->where($this->primary,'=',$this->kdBarangDefault)->update(array('hided' => 0));
      $this->hided = false;
  	}


}
