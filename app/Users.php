<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Dedyeskafunc;
use App\ImageAll;

class Users extends Model
{
  public $id;
	public $password;
	public $name;
	public $email;
	public $noTelp;
	public $foto;
	public $deleted = false;
  public $suspended= false;
  public $role;

  //public $massage = array();

  private $msTable = 'users';
  private $primary = 'id';


  public function Users(){

  }
public function set($kd){
  $select = array('id',
          'name',
          'password',
          'email',
          'noTelp',
          'foto',
          'deleted',
          'suspended',
          'role'
          );

  $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kd)->first();
  $this->id = $result->id;
  $this->name = $result->name;
  $this->password = $result->password;
  $this->email = $result->email;
  $this->noTelp = $result->noTelp;
  $this->foto = $result->foto;
  if($result->deleted == 1){$this->deleted = true;}
  if($result->suspended == 1){$this->suspended = true;}
  $this->role = $result->role;
}

public function listusert(){
  $select = array('id',
          'name',
          'password',
          'email',
          'noTelp',
          'foto',
          'deleted',
          'suspended',
          'role'
          );
  $result = DB::table($this->msTable)->select($select)
      ->where('users.deleted','=','0')
      ->orderBy('name')->get();
  return $result;

  }




  public function insertAll($name,$password,$email,$noTelp,$foto,$password_confirmation){

    $ded = new Dedyeskafunc();
    $kd = $ded->nextCode($this->primary,$this->msTable);
    $insert = array('id'=> $kd,'name' => $name,
              'password' => $password,
              'password_confirmation' => $password_confirmation,
              'email' => $email,
              'noTelp' => $noTelp,
              'foto' => $foto,
              'deleted' => 0,
              'suspended' => 0
              );
    //rules array
    $rules = array(
            'name' => 'required|max:255',
            'password'=>'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
            //'email' => 'required|email|max:255|unique:users,email',
            );

    $valid = \Validator::make($insert, $rules);

    if($valid->fails() != true){//kesalahan tidak true = true
      //push
      if($foto == null){
        $insert2 = array('id'=> $kd,'name' => $name,
                  'password' => bcrypt($password),
                  'email' => $email,
                  'noTelp' => $noTelp,
                  'deleted' => 0,
                  'suspended' => 0
                  );
      }else{
        $destinationPath = 'uploadgambar';
        $extension = $foto->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'.$extension;
        $foto->move($destinationPath, $filename);
        $insert2 = array('id'=> $kd,'name' => $name,
                  'password' => bcrypt($password),
                  'email' => $email,
                  'noTelp' => $noTelp,
                  'foto' => $filename,
                  'deleted' => 0,
                  'suspended' => 0
                  );

      $imageupload = new ImageAll();
      $upload = $imageupload->updateFoto($filename,$kd);//save to tabel image
      }

      DB::table($this->msTable)->insert($insert2);

      $this->name = $name;
      $this->password = $password;
      $this->email = $email;
      $this->noTelp = $noTelp;

    }

    //
    return $valid;

  }

  public function updateAll($name,$password,$email,$noTelp,$foto,$password_confirmation){
    $update = array('name' => $name,
              'password' => $password,
              'password_confirmation' => $password_confirmation,
              'email' => $email,
              'noTelp' => $noTelp,
              'foto' => $foto
              );
    //rules array
    $rules = array(
            'name' => 'required|max:255',
            'password'=>'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
            //'email' => 'required|email|max:255|unique:users,email',
            );

    $valid = \Validator::make($update, $rules);

    if($valid->fails() != true){//kesalahan tidak true = true
      //push
      if($foto == null){
        $update2 = array('name' => $name,
                  'password' => bcrypt($password),
                  'email' => $email,
                  'noTelp' => $noTelp
                  );
      }else{
        $destinationPath = 'uploadgambar';
        $extension = $foto->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'.$extension;
        $foto->move($destinationPath, $filename);
        $update2 = array('name' => $name,
                  'password' => bcrypt($password),
                  'email' => $email,
                  'noTelp' => $noTelp,
                  'foto' => $filename
                  );
                  $imageupload = new ImageAll();
                  $upload = $imageupload->updateFoto($filename,$this->id);//save to tabel image
      }


      DB::table($this->msTable)->where($this->primary,'=',$this->id)->update($update2);
      $this->name = $name;
      $this->email = $email;
      $this->noTelp = $noTelp;
      $this->foto = $foto;
    }

    return $valid;

  }


  public function updateAll2($name,$email,$noTelp,$foto){
    $update = array('name' => $name,
              'email' => $email,
              'noTelp' => $noTelp,
              'foto' => $foto,
              'deleted' => 0,
              'suspended' => 0
              );
    //rules array
    $rules = array(
            'name' => 'required|max:255'
            //'email' => 'required|email|max:255|unique:users,email',
            );

    $valid = \Validator::make($update, $rules);

    if($valid->fails() != true){//kesalahan tidak true = true
      //push
      if($foto == null){
        $update2 = array('name' => $name,
                  'email' => $email,
                  'noTelp' => $noTelp
                  );
      }else{
        $destinationPath = 'uploadgambar';
        $extension = $foto->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'.$extension;
        $foto->move($destinationPath, $filename);
        $update2 = array('name' => $name,
                  'email' => $email,
                  'noTelp' => $noTelp,
                  'foto' => $filename
                  );
                  $imageupload = new ImageAll();
                  $upload = $imageupload->updateFoto($filename,$this->id);//save to tabel image
      }


      DB::table($this->msTable)->where($this->primary,'=',$this->id)->update($update2);
      $this->name = $name;
      $this->email = $email;
      $this->noTelp = $noTelp;
      $this->foto = $foto;
    }

    return $valid;

  }


  public function delete(){
    DB::table($this->msTable)->where($this->primary,'=',$this->id)->update(array('deleted' => 1));
    $this->deleted = true;
  }


  public function suspended(){
      DB::table($this->msTable)->where($this->primary,'=',$this->id)->update(array('suspended' => 1));
      $this->suspended = true;

  }

  public function active(){
        DB::table($this->msTable)->where($this->primary,'=',$this->id)->update(array('suspended' => 0));
        $this->suspended = false;
  }

  public function listManag(){
    $select = array('users.id',
            'users.namaLengkap',
            'ms_rtrwnet.nama',
            'ms_admin_rtrwnet.owner',
            'ms_admin_rtrwnet.profile',
            'ms_admin_rtrwnet.komplain',
            'ms_admin_rtrwnet.ms_admin_rtrwnet.transaksi',
            'ms_admin_rtrwnet.jadwal',
            'ms_admin_rtrwnet.billing');
    $result = DB::table($this->msTable)->select($select)->join('ms_admin_rtrwnet','users.id','=','ms_admin_rtrwnet.id')
        ->join('ms_rtrwnet','ms_admin_rtrwnet.kdRtRwNet','=','ms_rtrwnet.kdRtRwNet')
        ->where('users.id','=',$this->id)
        ->orderBy('ms_rtrwnet.nama')->get();
    return $result;
  }

}
