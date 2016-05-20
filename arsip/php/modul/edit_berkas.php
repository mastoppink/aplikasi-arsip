<?php
session_start();
include "../config.php";
$hariIni = date('Y-m-d');
if(isset($_POST)){
	$q = mysql_query("update tbl_berkas SET `no_berkas` = '".$_POST['no_berkas']."', 
		`npwp` = '".$_POST['npwp']."', 
		`nama_wp` = '".$_POST['nama_wp']."',
		`tahun_berkas` = '".$_POST['tahun_berkas']."',
		`jenis_berkas` = '".$_POST['jenis_berkas']."',
		`tgl_edit` = '".$hariIni."',
		`user_edit` = '".$_SESSION['username']."' where no_berkas = '".$_POST['no_lama']."'");
	if($q===true){
		echo "<script>document.location.href='".$_POST['alamat_url']."&msg=5';</script>";
	}else{
		echo "<script>document.location.href='".$_POST['alamat_url']."&msg=6';</script>";
	}
}else{
	echo "tidak ada data";
}

?>