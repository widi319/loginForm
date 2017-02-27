<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class imageAll extends Model
{
    //

    public function updateFoto($image,$id){
      DB::table('images')->where('id','=',$id)->where('tabelUses','=','Users')->update(array('tabelUses' => '','id'=> 0));
      $ded = new Dedyeskafunc();
      $kd = $ded->nextCode('images','images');
      $insert = array('images'=> $kd,'id'=> $id,'waktu' => date('Y-m-d'),'name'=>$image,'tabelUses'=>'Users');
      DB::table('images')->insert($insert);
    }

    public function uploadFoto($foto){
      $destinationPath = 'tmp';
      $name = $foto->getClientOriginalName();
      $foto->move($destinationPath, $name);
    }

}
