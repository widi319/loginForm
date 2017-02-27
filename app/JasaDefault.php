<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Dedyeskafunc;
class JasaDefault extends Model
{
  public $kdJasaDefault;
  public $nama;
  public $harga;
  public $deleted = false;
  public $hided = false;

  private $msTable = 'ms_jasa_default';
  private $primary = 'kdJasaDefault';

  public function JasaDefault(){}


    public function listjasa($search){
        $select = array('kdJasaDefault','nama','harga','deleted','hided');
        $like = '%'.$search.'%';
          $result = DB::table($this->msTable)->select($select)
              ->where('nama','like',$like)
              ->where('deleted','=',0)
              ->orderBy('nama')->paginate(20);
              return $result;
      }


      public function set($kdJasaDefault){
        $select = array('kdJasaDefault',
                        'nama',
                        'harga',
                        'deleted',
                        'hided');

        $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kdJasaDefault)->first();
        $this->kdJasaDefault = $result->kdJasaDefault;
        $this->nama = $result->nama;
        $this->harga = $result->harga;
        $this->deleted = $result->deleted;
        $this->hided = $result->hided;
    	}

      public function insertAll($nama,$harga){

        $ded = new Dedyeskafunc();
    		$kd = $ded->nextCode($this->primary,$this->msTable);
    		$insert = array('kdJasaDefault'=> $kd,
                'nama' => $nama,
    						'harga'=>$harga,
    						'deleted'=> 0,
    						'hided' => 0);

    		$rules = array(	'nama' => 'required|min:3|max:30',
    						'harga' => 'required');

    		$valid = \Validator::make($insert, $rules);

    		if($valid->fails() != true){//kesalahan tidak true = true
    			DB::table($this->msTable)->insert($insert);
          $this->kdJasaDefault = $kd;
    			$this->nama = $nama;
    			$this->harga = $harga;
    			$this->deleted = false;
    			$this->hided = false;

    		}
    		return $valid;
    	}

      public function updateAll($nama,$harga,$kdJasaDefault){
        $update = array('nama' => $nama,
                        'harga'=>$harga);
        //rules array
        $rules = array(	'nama' => 'required|min:3|max:30',
    						'harga' => 'required');

        $valid = \Validator::make($update, $rules);

        if($valid->fails() != true){//kesalahan tidak true = true

          DB::table($this->msTable)->where($this->primary,'=',$kdJasaDefault)->update($update);
          $this->kdJasaDefault = $kdJasaDefault;
          $this->nama = $nama;
          $this->harga = $harga;

        }

        return $valid;
    	}


      public function delete(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdJasaDefault)->update(array('deleted' => 1));
        $this->deleted = true;
    	}
    	public function hide(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdJasaDefault)->update(array('hided' => 1));
        $this->hided = true;
    	}
    	public function show(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdJasaDefault)->update(array('hided' => 0));
        $this->hided = false;
    	}

}
