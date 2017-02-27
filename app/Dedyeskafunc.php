<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Dedyeskafunc extends Model
{
  public function Dedyeskafunc(){}

	public function cekKdRef($kdRef){
		$jenisPost = '';
		$ada = DB::table('ms_aktiva')->select(array('kdAktiva'))->where('ref','=',$kdRef)->first();
		if(is_null($ada)){
			/**/
			$ada = DB::table('ms_pasiva')->select(array('kdPasiva'))->where('ref','=',$kdRef)->first();
			if(is_null($ada)){
				$ada = DB::table('ms_laba')->select(array('kdLaba'))->where('ref','=',$kdRef)->first();
				if(is_null($ada)){
					$ada = DB::table('ms_rugi')->select(array('kdRugi'))->where('ref','=',$kdRef)->first();
					if(is_null($ada)){
						return true;
						/**/
					}
					else{
						return 'rugi';
					}
				}
				else{
					return 'laba';
				}
			}
			else{
				return 'pasiva';
			}
		}
		else{
			return 'aktiva';
		}
	}

	public function nextCode($primary, $table){
		$result = DB::table($table)->select($primary)->orderBy($primary,'desc')->first();
		$kode = 0;
		if(is_null($result) ){
			$kode = 0;
		}
		else{
			$kode = $result->$primary;

		}
		$kode = $kode+1;
		$kodeString = $kode . "";
		/*while(1){
			if(strlen($kodeString)<5){
				$kodeString = "0".$kodeString;
			}
			else{break;}
		}
		$kodeString = "F".$kodeString;
		*/
		return $kodeString;
	}
	public function nextCodeDetail($primary, $table,$where){
		$rs = mysql_query("select $primary from $table where " . $where ." order by $primary desc limit 0,1");
		$kode = 0;
		if($hasil = mysql_fetch_row($rs)){
			$kode = $hasil[0];
		}
		else{
			$kode = 0;
		}
		$kode = $kode+1;
		$kodeString = $kode . "";
		/*while(1){
			if(strlen($kodeString)<5){
				$kodeString = "0".$kodeString;
			}
			else{break;}
		}
		$kodeString = "F".$kodeString;
		*/
		return $kodeString;
	}


	public function spwkTime($year, $month, $day, $hour, $minute,  $second, $dayOfWeek){
		$yDate = date("Y");
		$nDate = date("n");
		$jDate = date("j");
		if( intval($yDate) == intval($year) && intval($nDate) == intval($month) && intval($jDate) == intval($day) ){
			return substr('0' . $hour , -2  ) . ":" . substr('0' . $minute , -2  ) . ":" . substr('0' . $second , -2  );
		}
		else{
			$namaHari = array( "noWeek","Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu" );
			$namaBulan =  array("noMont","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Ags","Sep","Okt","Nov","Des");
			return $namaHari[$dayOfWeek] . " " . $day . " " . $namaBulan[$month] . " " . substr('0' . $hour , -2  ) . ":" . substr('0' . $minute , -2  ) ;
		}
	}
	public function dateToDB($date){
		$tgl = substr($date,0,strpos($date,"/"));
		$date = substr($date,strpos($date,"/")+1);
		$bln = substr($date,0,strpos($date,"/"));
		$thn = substr($date,strpos($date,"/")+1);
		return  $thn . "-" . $bln . "-" . $tgl;
	}

	public function getIndoDate($date){//formatnya $date awal: 2008-23-01, format return $date : 23 January 2008
		$thn = substr($date,0,strpos($date,"-"));
		$date = substr($date,strpos($date,"-")+1);
		$bln = intval(substr($date,0,strpos($date,"-")));
		if(strpos($date," ")==false){
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}
		else{
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}

		$dedy =  array("Dedy Keren","January","February","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$date = $tgl . " " . $dedy[$bln] . " " . $thn;
		return $date;
	}
	public function getEnglishDate($date){//formatnya $date awal: 2008-23-01, format return $date : 23 January 2008
		$thn = substr($date,0,strpos($date,"-"));
		$date = substr($date,strpos($date,"-")+1);
		$bln = intval(substr($date,0,strpos($date,"-")));
		if(strpos($date," ")==false){
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}
		else{
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}

		$dedy =  array("Dedy Keren","January","February","March","April","May","June","July","August","September","October","November","December");

		$date = $dedy[$bln] . " " . $tgl  . ", " . $thn;
		return $date;
	}
	public function getSlashDate($date){//formatnya $date awal: 2008-23-01, format return $date : 23/01/2008
		$thn = substr($date,0,strpos($date,"-"));
		$date = substr($date,strpos($date,"-")+1);
		$bln = intval(substr($date,0,strpos($date,"-")));
		if(strpos($date," ")==false){
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}
		else{
			$tgl = intval(substr($date,strpos($date,"-")+1));
		}

		$date = $tgl . "/" . $bln . "/" . $thn;
		return $date;
	}
	public function createDateForm($mktime, $className,$idName){
		$namaBulan = array("0","January","February","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$string = "<select id='" . $idName . "_tanggal' name='" . $idName . "_tanggal' class='$className'>";
		for($i=1;$i<32;$i++){
			$string = $string . "<option value='$i' ";
			if( date("j",$mktime) == $i) { $string = $string . " selected" ;}

			$string = $string . "> $i </option>";
		}
		$string = $string . "</select>";

		$string = $string . "<select id='" . $idName . "_bulan' name='" . $idName . "_bulan' class='$className'>";
		for($i=1;$i<13;$i++){
			$string = $string ."<option value='".$i."' ";
            if( date("n",$mktime) == $i) { $string = $string . " selected" ;}
			$string = $string . ">" .$namaBulan[$i] . " </option>";
		}
		$string = $string . "</select>";

		$string = $string . "<select name='" . $idName . "_tahun' class='$className' id='" . $idName . "_tahun'>";

		$year = date("Y");
		for($i=$year-5;$i<=$year;$i++){
			$string = $string . "<option value='$i' ";
			if( date("Y",$mktime) == $i) { $string = $string . " selected" ;}
			$string = $string . "> $i </option>";

		}

		$string = $string . "</select> ";

		return $string;
	}

	public function vertical($input){
		$panjang = strlen($input);
		$jadi = "";
		for($i=0; $i<$panjang; $i++){
			$jadi = $jadi . substr($input,$i,1)."<br>";
		}
		return $jadi;
	}


	public function separatorAngka($mataUang, $angka){
		$string = $angka . "";
		$tempKoma = "";
		if(strpos($string,".")!=false){

			$posKoma = strpos($string,".");
			$tempKoma = substr($string,$posKoma);
			$tempKoma = str_replace(".",",",$tempKoma);
			$tempKoma = substr($tempKoma,0,3);
			$string = substr($string,0,strpos($string,"."));
			/*
			$split = split(".",$string);
			$string = $split[0];
			$tempKoma = "," . $split[1];
			*/
		}
		/**/
		$jumDot = intval(strlen($string)/3);
		if(strlen($string) % 3 == 0){
			$jumDot = $jumDot-1;
		}
		$aha = 0;
		for($i=0; $i<$jumDot;$i++){
			$part[$i] = substr($string,strlen($string)-3);
			$string = substr($string,0,strlen($string)-3);
			$aha++;
		}

		$temp = $string;
		$string = "";
		for($i=0;$i<$jumDot;$i++){
			$string = "." . $part[$i] . $string;
		}
		$string =  $mataUang . " " .$temp . $string;

		if($tempKoma != ""){
			$string =  $string . $tempKoma;
		}

		return $string;
	}

	public function ejaAngka($angkaTanpaSeparator){

		$a = $angkaTanpaSeparator;
		$angka = $a."";
		//validasi klo ad koma d hapus aja.. wkwkwk
		if(strpos($angka,".")!=false){
			$posKoma = strpos($angka,".");
			$tempKoma = substr($angka,$posKoma);
			$tempKoma = str_replace(".",",",$tempKoma);
			$tempKoma = substr($tempKoma,0,3);
			$angka = substr($angka,0,strpos($angka,"."));
		}
		//

		$tempAngka = $angka;
		$namaGrade = array("","ribu ","juta ","milyar ","triliun ");
		$namaAngka = array("","satu ","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
		$strRtn = "";
		$strRtn2 = "";
		if(strlen($angka) >  15){}
		else{

		//
		if(strlen($angka)==4 && substr($angka,0,1) == "1" ){//angka <= seribu
			$strRtn = "seribu ";
			$grade = substr($angka,-3);
			if( substr($grade,0,1)=="1"  ){
				$strRtn = $strRtn . "seratus ";
			}
			else{
				if( substr($grade,0,1) != "0"){
					$strRtn = $strRtn . $namaAngka[intval(substr($grade,0,1))] . "ratus ";
				}
			}

			if(substr($grade,1,1) == "1"){
				if(substr($grade,2,1) == "1"){
					$strRtn = $strRtn . "sebelas ";
				}
				else{
					if( substr($grade,2,1)== "0" ){
						$strRtn = $strRtn  . "sepuluh ";
					}
					else{
						if( substr($grade,2,1) != "0"){
							$strRtn = $strRtn . $namaAngka[intval(substr($grade,2,1))] . "belas ";
						}
					}
				}
			}
			else{
				if( substr($grade,1,1) != "0" ){
					$strRtn = $strRtn . $namaAngka[intval(substr($grade,1,1))] . "puluh ";
				}
				$strRtn = $strRtn . $namaAngka[intval(substr($grade,2,1))];
			}
			$strRtn2 = $strRtn;
		}
		else{//
			$jumGrade = intval(strlen($angka)/3);
			if(strlen($angka)%3!=0)$jumGrade++;

			for($i=0; $i<$jumGrade; $i++){
				$strRtn = "";
				if(strlen($angka) < 3){
					$grade[$i] = $angka;
				}
				else{
					$grade[$i] = substr($angka,-3);
					$angka = substr($angka,0,-3);
				}

				//eja ratusan
				if(strlen($grade[$i])==1){
					$strRtn = $strRtn . $namaAngka[intval($grade[$i])];
				}
				else if(strlen($grade[$i])==2){
					if(substr($grade[$i],0,1) == "1"){
						if(substr($grade[$i],1,1) == "1"){
							$strRtn = $strRtn . "sebelas ";
						}
						else{
							if( substr($grade[$i],1,1)== "0" ){
								$strRtn = $strRtn  . "sepuluh ";
							}
							else{
								$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],1,1))] . "belas ";
							}
						}
					}
					else{
						if( substr($grade[$i],0,1) != "0" ){
							$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],0,1))] . "puluh ";
						}
						$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],1,1))];
					}
				}
				else{
					if( substr($grade[$i],0,1)=="1"  ){
						$strRtn = $strRtn . "seratus ";
					}
					else{
						if( substr($grade[$i],0,1) != "0"){
							$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],0,1))] . "ratus ";
						}
					}

					if(substr($grade[$i],1,1) == "1"){
						if(substr($grade[$i],2,1) == "1"){
							$strRtn = $strRtn . "sebelas ";
						}
						else{
							if( substr($grade[$i],2,1)== "0" ){
								$strRtn = $strRtn  . "sepuluh ";
							}
							else{
								if( substr($grade[$i],2,1) != "0"){
									$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],2,1))] . "belas ";
								}
							}
						}
					}
					else{
						if( substr($grade[$i],1,1) != "0" ){
							$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],1,1))] . "puluh ";
						}
						$strRtn = $strRtn . $namaAngka[intval(substr($grade[$i],2,1))];
					}
				}
				$strRtn = $strRtn.$namaGrade[$i];
				$strRtn2 = $strRtn . $strRtn2;
			}
		}
		//
		}
		return $strRtn2 . "rupiah";
	}  //


}
