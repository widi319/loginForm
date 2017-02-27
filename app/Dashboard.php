<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dedyeskafunc;
use DB;

class Dashboard extends Model
{
  public function showRtRwUser($kdUser){
      $select = array('ms_rtrwnet.nama as nama','ms_rtrwnet.kdRtRwNet','owner','profile','komplain','transaksi','jadwal','proyek','billing');
      $result = DB::table('ms_admin_rtrwnet')->select($select)
          ->where('ms_admin_rtrwnet.kdUser','=',$kdUser)
          ->join('ms_rtrwnet','ms_admin_rtrwnet.kdRtRwNet','=','ms_rtrwnet.kdRtRwNet')
          ->orderBy('ms_rtrwnet.nama')->get();
      return  $result;
  }
}
