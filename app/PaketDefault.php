<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Dedyeskafunc;
class PaketDefault extends Model
{
  public $kdPaketDefault;
  public $nama;
  public $harga;
  public $deleted = false;
  public $hided = false;

  private $msTable = 'ms_paket_default';
  private $primary = 'kdPaketDefault';


  public function PaketDefault(){}

    public function listPaket($search){
        $select = array('kdPaketDefault','nama','harga','deleted','hided');
        $like = '%'.$search.'%';
          $result = DB::table($this->msTable)->select($select)
              ->where('nama','like',$like)
              ->where('deleted','=',0)
              ->orderBy('nama')->paginate(20);
              return $result;
      }


      public function set($kdPaketDefault){
        $select = array('kdPaketDefault',
                        'nama',
                        'harga',
                        'deleted',
                        'hided');

        $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kdPaketDefault)->first();
        $this->kdPaketDefault = $result->kdPaketDefault;
        $this->nama = $result->nama;
        $this->harga = $result->harga;
        $this->deleted = $result->deleted;
        $this->hided = $result->hided;
      }

      public function insertAll($nama,$harga){

        $ded = new Dedyeskafunc();
    		$kd = $ded->nextCode($this->primary,$this->msTable);
    		$insert = array('kdPaketDefault'=> $kd,
                'nama' => $nama,
    						'harga'=>$harga,
    						'deleted'=> 0,
    						'hided' => 0);

    		$rules = array(	'nama' => 'required|min:3|max:30',
    						'harga' => 'required');

    		$valid = \Validator::make($insert, $rules);

    		if($valid->fails() != true){//kesalahan tidak true = true
    			DB::table($this->msTable)->insert($insert);
          $this->kdPaketDefault = $kd;
    			$this->nama = $nama;
    			$this->harga = $harga;
    			$this->deleted = false;
    			$this->hided = false;

    		}
    		return $valid;
    	}

      public function updateAll($nama,$harga,$kdPaketDefault){
        $update = array('nama' => $nama,
                        'harga'=>$harga);
        //rules array
        $rules = array(	'nama' => 'required|min:3|max:30',
    						'harga' => 'required');

        $valid = \Validator::make($update, $rules);

        if($valid->fails() != true){//kesalahan tidak true = true

          DB::table($this->msTable)->where($this->primary,'=',$kdPaketDefault)->update($update);
          $this->kdPaketDefault = $kdPaketDefault;
          $this->nama = $nama;
          $this->harga = $harga;

        }

        return $valid;
    	}

      public function delete(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPaketDefault)->update(array('deleted' => 1));
        $this->deleted = true;
    	}
    	public function hide(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPaketDefault)->update(array('hided' => 1));
        $this->hided = true;
    	}
    	public function show(){
        DB::table($this->msTable)->where($this->primary,'=',$this->kdPaketDefault)->update(array('hided' => 0));
        $this->hided = false;
    	}

}
