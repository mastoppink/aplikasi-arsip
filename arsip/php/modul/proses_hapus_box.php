<?php
session_start();
include "../config.php";
date_default_timezone_get('Asia/Jakarta');
$hariIni = date("Y-m-d");

$q = mysql_query("select no_berkas,npwp,nama_wp,no_box,tgl_masuk,user_id,jenis_berkas,tahun_berkas,masa from tbl_berkas where no_box = '".$_POST['no_box']."'");
while ($tbl = mysql_fetch_array($q)) {
	$q2 = mysql_query("insert into tbl_berkas_dihapus_daluarsa(`no_berkas`,`npwp`,`nama_wp`,`no_box`,`tgl_masuk`,`user_id`,`jenis_berkas`,`tahun_berkas`,`masa`,`alasan`,`tanggal`) 
		values('".$tbl['no_berkas']."', 
		'".$tbl['npwp']."', 
		'".$tbl['nama_wp']."',
		'".$tbl['no_box']."', 
		'".$tbl['tgl_masuk']."', 
		'".$tbl['user_id']."',
		'".$tbl['jenis_berkas']."',
		'".$tbl['tahun_berkas']."',
		'".$tbl['masa']."',
		'".$_POST['alasan']."',
		'".$hariIni."')");
	if(!$q2){
		$qd = mysql_query("delete from tbl_berkas where no_berkas = '".$tbl['no_berkas']."'");
		if(!$qd){
			echo "<script>document.location.href='../../main.php?mod=16&sm=20&msg=6';</script>";
		}else{
			echo "<script>document.location.href='../../main.php?mod=16&sm=20&msg=4';</script>";
		}
	}else{
		echo "<script>document.location.href='../../main.php?mod=16&sm=20&msg=6';</script>";
	}
}
echo "<script>document.location.href='../../main.php?mod=16&sm=20&msg=6';</script>";
?>