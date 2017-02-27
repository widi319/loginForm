<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    //
    public $kdSA;
    public $userName;
    public $password;
    public $namaLengkap;
    public $foto;

    private $msTable = 'super_admin';
  
    private $primary = 'kdSA';

    public function set($kd){
      $select = array('kdSA',
              'userName',
              'password',
              'namaLengkap',
              'foto'
              );

      $result = DB::table($this->msTable)->select($select)->where($this->primary,'=',$kd)->first();
      $this->kdSA = $result->kdSA;
      $this->userName = $result->userName;
      $this->password = $result->password;
      $this->namaLengkap = $result->namaLengkap;
      $this->foto = $result->foto;
    }

    public function listSuperAdmin(){
      $select = array('kdSA',
              'userName',
              'password',
              'namaLengkap',
              'foto'
              );

      $result = DB::table($this->msTable)->select($select)
          ->orderBy('namaLengkap')->get();
      return $result;

      }



      public function insertAll($userName,$password,$namaLengkap,$foto,$password_confirmation){

      $ded = new Dedyeskafunc();
      $kd = $ded->nextCode($this->primary,$this->msTable);

        //insert array

        $insert = array('kdSA'=>$kd,'userName' => $userName,
                  'password' => $password,
                  'password_confirmation' => $password_confirmation,
                  'namaLengkap' => $namaLengkap,
                  'foto' => $foto
                  );
        //rules array
        $rules = array(
                'userName' => 'required|min:8|max:20',
                'password' => 'required|max:10',
                'namaLengkap' => 'required',
                'email' => 'email',
                'password'=>'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
                );

        $valid = \Validator::make($insert, $rules);

        if($valid->fails() != true){//kesalahan tidak true = true
          //push
          if($foto == null){
            $insert2 = array('kdSA'=>$kd,'userName' => $userName,
                      'password' => \Hash::make($password),
                      'namaLengkap' => $namaLengkap
                      );
          }else{
            $destinationPath = 'uploadgambar';
            $extension = $foto->getClientOriginalExtension();
            $filename = rand(11111,99999).'.'.$extension;
            $foto->move($destinationPath, $filename);
            $insert2 = array('kdSA'=>$kd,'userName' => $userName,
                      'password' => \Hash::make($password),
                      'namaLengkap' => $namaLengkap,
                      'foto' => $filename
                      );
          }

          DB::table($this->msTable)->insert($insert2);

          $this->userName = $userName;
          $this->password = $password;
          $this->namaLengkap = $namaLengkap;
          //$this->foto = $foto;


        }

        //
        return $valid;

      }


      public function updateAll($userName,$password,$namaLengkap,$foto,$password_confirmation){
        $update = array('userName' => $userName,
                  'password' => $password,
                  'password_confirmation' => $password_confirmation,
                  'namaLengkap' => $namaLengkap,
                  'foto' => $foto
                  );
        //rules array
        $rules = array(
                'userName' => 'required|min:8|max:20',
                'password' => 'required|max:10',
                'namaLengkap' => 'required',
                'email' => 'email',
                'password'=>'min:8|confirmed',
                'password_confirmation' => 'min:8'
                );

        $valid = \Validator::make($update, $rules);

        if($valid->fails() != true){//kesalahan tidak true = true
          //push
          if($foto == null){
            if($password != ""){
              $update2 = array('userName' => $userName,
                        'password' => bcrypt($password),
                        'namaLengkap' => $namaLengkap
                        );
            }else{
              $update2 = array('userName' => $userName,
                        'namaLengkap' => $namaLengkap
                        );

            }

          }else{
            $destinationPath = 'uploadgambar';
            $extension = $foto->getClientOriginalExtension();
            $filename = rand(11111,99999).'.'.$extension;
            $foto->move($destinationPath, $filename);
            if($password != ""){
            $update2 = array('userName' => $userName,
                      'password' => $password,
                      'namaLengkap' => $namaLengkap,
                      'foto' => $filename
                      );
              }else{
                $update2 = array('userName' => $userName,
                          'namaLengkap' => $namaLengkap,
                          'foto' => $filename
                          );
              }
          }


          DB::table($this->msTable)->where($this->primary,'=',$this->kdSA)->update($update2);
          $this->userName = $userName;
          $this->password = $password;
          $this->namaLengkap = $namaLengkap;
          $this->foto = $foto;
        }

        return $valid;

      }


}
