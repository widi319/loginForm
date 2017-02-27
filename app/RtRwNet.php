<?php

namespace App;
use DB;
use Auth;
use App\Dedyeskafunc;
use App\ImageAll;
use Illuminate\Database\Eloquent\Model;


class RtRwNet extends Model
{
  public $kdRtRwNet;
  	public $nama;
  	public $alamat;
  	public $noTelp;
  	public $fanpage;
  	public $website;
  	public $email;
  	public $logo;
  	public $deleted = false;
  	public $suspended = false;

  	private $msTable = 'ms_rtrwnet';
  	private $primary = 'kdRtRwNet';

  	public function RtRwNet(){
  	}

    public function set($kd){
      $result = DB::table($this->msTable)->where($this->primary,'=',$kd)->first();

      $this->kdRtRwNet = $result->kdRtRwNet;
      $this->nama = $result->nama;
      $this->alamat =$result->alamat;
      $this->noTelp = $result->noTelp;
      $this->fanpage = $result->fanpage;
      $this->website = $result->website;
      $this->email = $result->email;
      $this->logo = $result->logo;

      if ($result->deleted == 1 ) {$this->deleted = true;}
      if ($result->suspended == 1 ) {$this->suspended = true;}

    }

    public function listRtRwNet(){
  		$result = DB::table($this->msTable)->select($this->primary,'nama','suspended')->where('deleted','=',0)->get();
  		return $result;
  	}


public function insertAllOnDashboard($nama, $logo){
  $ded = new Dedyeskafunc();
  $kd = $ded->nextCode($this->primary,$this->msTable);
  $insert = array('kdRtRwNet'=> $kd,
          'nama' => $nama,
          'deleted'=> 0,
          'suspended' => 0);

  $rules = array(	'nama' => 'required|min:3|max:30');

  $valid = \Validator::make($insert, $rules);

  if($valid->fails() != true){//kesalahan tidak true = true
    if($logo == null){
      $insert2 = array('kdRtRwNet'=> $kd,
                      'nama' => $nama,
                      'logo'=>'',
                      'deleted'=> 0,
                      'suspended' => 0);
    }else{
      $destinationPath = 'uploadgambar';
      $extension = $logo->getClientOriginalExtension();
      $filename = rand(11111,99999).'.'.$extension;
      $logo->move($destinationPath, $filename);
      $insert2 = array('kdRtRwNet'=> $kd,'nama' => $nama,
              'logo'=>$filename,
              'deleted'=> 0,
              'suspended' => 0);
    $imageupload = new ImageAll();
    $upload = $imageupload->updateFoto($filename,$kd);//save to tabel image

    }

    DB::table($this->msTable)->insert($insert2);
    $this->kdRtRwNet = $kd;
    $this->nama = $nama;
    $this->deleted = false;
    $this->suspended = false;

    $go = $this->addOwner(Auth::user()->id);
  }
  return $valid;

}

  	public function insertAll($nama, $alamat, $noTelp, $fanpage, $website, $email, $logo){
  		$ded = new Dedyeskafunc();
  		$kd = $ded->nextCode($this->primary,$this->msTable);

  		$insert = array('kdRtRwNet'=> $kd,
              'nama' => $nama,
  						'alamat'=>$alamat,
  						'noTelp'=>$noTelp,
  						'fanpage'=>$fanpage,
  						'website'=>$website,
  						'email'=>$email,
  						'logo'=>$logo,
  						'deleted'=> 0,
  						'suspended' => 0);

  		$rules = array(	'nama' => 'required|min:3|max:30',
  						'alamat'=>'required|max:100',
  						'noTelp' => 'required|max:15',
  						'fanpage'=>'max:100',
  						'email' => 'required|email|max:100',
  						'website' => 'max:50'

  						);

  		$valid = \Validator::make($insert, $rules);

  		if($valid->fails() != true){//kesalahan tidak true = true
        if($logo == null){
          $insert2 = array('kdRtRwNet'=> $kd,
            'nama' => $nama,
      						'alamat'=>$alamat,
      						'noTelp'=>$noTelp,
      						'fanpage'=>$fanpage,
      						'website'=>$website,
      						'email'=>$email,
      						'logo'=>'',
      						'deleted'=> 0,
      						'suspended' => 0);
        }else{
          $destinationPath = 'uploadgambar';
          $extension = $logo->getClientOriginalExtension();
          $filename = rand(11111,99999).'.'.$extension;
          $logo->move($destinationPath, $filename);
          $insert2 = array('kdRtRwNet'=> $kd,'nama' => $nama,
      						'alamat'=>$alamat,
      						'noTelp'=>$noTelp,
      						'fanpage'=>$fanpage,
      						'website'=>$website,
      						'email'=>$email,
      						'logo'=>$filename,
      						'deleted'=> 0,
      						'suspended' => 0);
        $imageupload = new ImageAll();
        $upload = $imageupload->updateFoto($filename,$kd);//save to tabel image

        }

  			DB::table($this->msTable)->insert($insert2);
        $this->kdRtRwNet = $kd;
  			$this->nama = $nama;
  			$this->alamat =$alamat;
  			$this->noTelp = $noTelp;
  			$this->fanpage = $fanpage;
  			$this->website = $website;
  			$this->email = $email;
  			$this->logo = $logo;
  			$this->deleted = false;
  			$this->suspended = false;
  		}
  		return $valid;

  	}
  	public function updateAll( $nama, $alamat, $noTelp, $fanpage, $website, $email, $logo){
  		//insert array
  		$update = array(
  						'nama' => $nama,
  						'alamat'=>$alamat,
  						'noTelp'=>$noTelp,
  						'fanpage'=>$fanpage,
  						'website'=>$website,
  						'email'=>$email,
  						'logo'=>$logo,
  						'deleted'=> 0,
  						'suspended' => 0);
  		//rules array
  		$rules = array(	'nama' => 'required|min:3|max:30',
  						'alamat'=>'required|max:100',
  						'noTelp' => 'required|max:15',
  						'fanpage'=>'max:100',
  						'email' => 'required|email|max:100',
  						'website' => 'max:50');

  		$valid = \Validator::make($update, $rules);
  		if($valid->fails() != true){//kesalahan tidak true = true
  			//push
        if($logo == null){
          $update2 = array('nama' => $nama,
      						'alamat'=>$alamat,
      						'noTelp'=>$noTelp,
      						'fanpage'=>$fanpage,
      						'website'=>$website,
      						'email'=>$email);
        }else{
          $destinationPath = 'uploadgambar';
          $extension = $logo->getClientOriginalExtension();
          $filename = rand(11111,99999).'.'.$extension;
          $logo->move($destinationPath, $filename);
          $update2 = array('nama' => $nama,
      						'alamat'=>$alamat,
      						'noTelp'=>$noTelp,
      						'fanpage'=>$fanpage,
      						'website'=>$website,
      						'email'=>$email,
      						'logo'=>$filename);
          $imageupload = new ImageAll();
          $upload = $imageupload->updateFoto($filename,$this->kdRtRwNet);//save to tabel image
        }


  			DB::table($this->msTable)->where($this->primary,'=',$this->kdRtRwNet)->update($update2);

  			$this->nama = $nama;
  			$this->alamat =$alamat;
  			$this->noTelp = $noTelp;
  			$this->fanpage = $fanpage;
  			$this->website = $website;
  			$this->email = $email;
  			$this->logo = $logo;
  		}

  		return $valid;

  	}

  	public function updateLogo($logo){

  	}
  	public function delete(){
  		DB::table($this->msTable)->where($this->primary,'=',$this->kdRtRwNet)->update(array('deleted' => 1));
  		$this->deleted = true;
  	}
  	public function suspend(){
  		DB::table($this->msTable)->where($this->primary,'=',$this->kdRtRwNet)->update(array('suspended' => 1));
  		$this->suspended = true;
  	}
  	public function active(){
  		DB::table($this->msTable)->where($this->primary,'=',$this->kdRtRwNet)->update(array('suspended' => 0));
  		$this->suspended = false;
  	}

    function selectStaffByEmail($email){
      $result = DB::table('users')->where('email','=',$email)->first();
      if($result == NULL){
        $ded = new Dedyeskafunc();
        $kd = $ded->nextCode('id','users');
        $nama= explode('@',$email);
        $insert = array('id'=> $kd,'email'=>$email,'name'=>$nama[0],'password'=>bcrypt('12345678'),'deleted'=>0,'suspended'=>0,'role'=>2);
        DB::table('users')->insert($insert);
        $returnkd = $kd;
      }else{
        $returnkd = $result->id;
      }
      return $returnkd;
    }


    public function deleteStaff($kdUser){
      DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)
                    ->where('kdRtRwNet', '=', $this->kdRtRwNet)->delete();
    }

  	public function addOwner($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 1,
  					'profile' => 1,
  					'komplain' => 1,
  					'transaksi' =>1,
  					'jadwal' =>1,
  					'proyek' => 1,
  					'billing' => 1
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array(
  					'owner' => 1,
  					'profile' => 1,
  					'komplain' => 1,
  					'transaksi' =>1,
  					'jadwal' =>1,
  					'proyek' => 1,
  					'billing' => 1));
  		}
  	}
  	public function addStafProfil($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 1,
  					'komplain' => 0,
  					'transaksi' =>0,
  					'jadwal' =>0,
  					'proyek' => 0,
  					'billing' => 0
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'profile' => 1 ));
  		}
  	}
  	public function addStafKomplain($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 0,
  					'komplain' => 1,
  					'transaksi' =>0,
  					'jadwal' =>0,
  					'proyek' => 0,
  					'billing' => 0
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'komplain' => 1 ));
  		}
  	}
  	public function addStafTransaksi($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 0,
  					'komplain' => 0,
  					'transaksi' =>1,
  					'jadwal' =>0,
  					'proyek' => 0,
  					'billing' => 0
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'transaksi' => 1 ));
  		}
  	}
  	public function addStafJadwal($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 0,
  					'komplain' => 0,
  					'transaksi' =>0,
  					'jadwal' =>1,
  					'proyek' => 0,
  					'billing' => 0
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'jadwal' => 1 ));
  		}
  	}

  	public function addStafProyek($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 0,
  					'komplain' => 0,
  					'transaksi' =>0,
  					'jadwal' =>0,
  					'proyek' => 1,
  					'billing' => 0
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'proyek' => 1 ));
  		}
  	}

  	public function addStafBilling($kdUser){
  		$data = DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->first();
  		if($data == NULL){
  			DB::table('ms_admin_rtrwnet')->insert(array(
  					'kdUser' => $kdUser,
  					'kdRtRwNet' => $this->kdRtRwNet,
  					'owner' => 0,
  					'profile' => 0,
  					'komplain' => 0,
  					'transaksi' =>0,
  					'jadwal' =>0,
  					'proyek' => 0,
  					'billing' => 1
  				));
  		}
  		else{
  			DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'billing' => 1 ));
  		}
  	}

  	private function delMsAdminRtRwnetYangKosong($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)
  									->where('kdRtRwNet', '=', $this->kdRtRwNet)
  									->where('owner', '=',0)
  									->where('profile', '=',0)
  									->where('komplain', '=',0)
  									->where('transaksi', '=',0)
  									->where('jadwal', '=',0)
  									->where('proyek', '=',0)
  									->where('billing', '=',0)->delete();
  	}
  	public function delOwner($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'owner' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function delProfil($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'profile' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function delKomplain($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'komplain' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function delTransaksi($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'transaksi' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function delJadwal($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'jadwal' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function delProyek($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'proyek' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}
    public function delBilling($kdUser){
  		DB::table('ms_admin_rtrwnet')->where('kdUser','=',$kdUser)->where('kdRtRwNet','=',$this->kdRtRwNet)->update(array( 'billing' => 0 ));
  		$this->delMsAdminRtRwnetYangKosong($kdUser);
  	}

  	public function listUserRtRwNet(){
  		return DB::table('ms_admin_rtrwnet')
        ->join('users', 'users.id','=', 'ms_admin_rtrwnet.kdUser')
        ->select(array('users.id','users.name',
        'ms_admin_rtrwnet.owner',
        'ms_admin_rtrwnet.profile',
        'ms_admin_rtrwnet.komplain',
        'ms_admin_rtrwnet.transaksi',
        'ms_admin_rtrwnet.jadwal',
        'ms_admin_rtrwnet.proyek',
        'ms_admin_rtrwnet.billing',
      ))
        ->where('ms_admin_rtrwnet.kdRtRwNet','=',$this->kdRtRwNet)->get();
  	}

  	public function listLog(){
  		return DB::table('rtrwnet_log')
  			->join('users','users.id','=','rtrwnet_log.kdUser')
  			->select('kdLog', 'username', 'log')
  			->where('kdRtRwNet','=',$this->kdRtRwNet);
  	}

	public function listUserName($katakunci){
		$select = array('id',
		'name',
		'password',
		'email',
		'noTelp',
		'foto',
		'deleted',
		'suspended'
		);

			$result = DB::table('users')->select($select)
			->where('users.deleted','=','0')
			->where('users.name','like','%'.$katakunci.'%')
			->orderBy('name')->get();

		return $result;

	}

public function updateStaff($kdUser,$kdRtRwNet){
  $select = array('ms_admin_rtrwnet.kdUser','owner','profile','komplain','transaksi','jadwal','proyek','billing','kdRtRwNet','userName');
  $result = DB::table('ms_admin_rtrwnet')->select($select)
      ->where('ms_admin_rtrwnet.kdUser','=',$kdUser)
      ->where('ms_admin_rtrwnet.kdRtRwNet','=',$kdRtRwNet)
      ->join('users','ms_admin_rtrwnet.kdUser','=','users.id')->first();
  return $result;
}

}
