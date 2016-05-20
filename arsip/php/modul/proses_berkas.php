<?php
session_start();
include "../config.php";
date_default_timezone_get('Asia/Jakarta');
$hariIni = date("Y-m-d");
$tahun_sekarang = date("Y");

if($_POST['tahun_berkas']!= '' || $_POST['tahun_berkas']!= NULL){
	$tahunBerkas = $_POST['tahun_berkas'];
}

if(($tahun_sekarang-10) > $tahunBerkas && $_POST['jenis_berkas'] != '25') {
	$_POST['no_box'] = '425425';
}

$no_berkas = $_POST['npwp']."-".$_POST['jenis_berkas']."-".$_POST['masa'].$tahunBerkas;

$q = mysql_query("select no_berkas from tbl_berkas where no_berkas='".$no_berkas."' limit 1");
$row = mysql_num_rows($q);
if($row == 0){
	$q = mysql_query("insert into tbl_berkas(`no_berkas`,`npwp`,`nama_wp`,`no_box`,`tgl_masuk`,`user_id`,`jenis_berkas`,`tahun_berkas`,`masa`) 
		values('".$no_berkas."', 
		'".$_POST['npwp']."', 
		'".$_POST['nama_wp']."',
		'".$_POST['no_box']."', 
		'".$hariIni."', 
		'".$_SESSION['username']."',
		'".$_POST['jenis_berkas']."',
		'".$tahunBerkas."',
		'".$_POST['masa']."')");
	if(!$q){
		echo "gagal";
		print_r($_POST);
		$q = "insert into tbl_berkas(`no_berkas`,`npwp15`,`nama_wp`,`box_id`,`tgl_masuk`,`user_id`,`jenis_berkas`,`tahun_berkas`,`masa`) 
		values('".$no_berkas."', 
		'".$_POST['npwp']."', 
		'".$_POST['nama_wp']."',
		'".$_POST['no_box']."', 
		'".$hariIni."', 
		'".$_SESSION['username']."',
		'".$_POST['jenis_berkas']."',
		'".$tahunBerkas."',
		'".$_POST['masa']."')";
	echo "<br>".$q;
	}else{
		if(($tahun_sekarang-10) > $tahunBerkas && $_POST['jenis_berkas'] != '25'){
		echo "<script>document.location.href='".$_POST['alamat_url']."&msg=10';</script>";
		}else{
		echo "<script>document.location.href='".$_POST['alamat_url']."&msg=5';</script>";
		}
	}
}else{
	echo "<script>document.location.href='".$_POST['alamat_url']."&msg=4';</script>";
}
?>