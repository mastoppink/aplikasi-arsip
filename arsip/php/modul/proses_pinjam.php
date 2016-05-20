<?php
include "../config.php";
date_default_timezone_set("Asia/Jakarta");
if(isset($_POST)){
	$hariIni = date("Y-m-d");
	$q = mysql_query("INSERT into tbl_peminjam(`peminjam`,`no_berkas`,`tgl_pinjam`) value(
		'".$_POST['peminjam']."',
		'".$_POST['no_berkas']."',
		'".$hariIni."')");
	if(!$q){
		echo "<script>document.location.href='".$_POST['alamat_url']."&msg=6';</script>";
	}else{
		echo "<script>document.location.href='".$_POST['alamat_url']."';</script>";
	}
}

?>