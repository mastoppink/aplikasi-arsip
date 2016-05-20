<?php
include '../config.php';
$hariIni = date("Y-m-d");
$row = mysql_num_rows(mysql_query("select * from tbl_user where username='".$_POST['username']."'"));
if($row == 0){
	$q = mysql_query("insert into tbl_user(`username`,`password`,`nama_lengkap`,`admin`,`tgl_daftar`) values(
		'".$_POST['username']."',
		'".md5($_POST['password'])."',
		'".$_POST['nama_lengkap']."',
		'".$_POST['admin']."',
		'".$hariIni."')");
	if(!$q){
		echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=13';</script>";
	}else{
		echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=13';</script>";
	}

}else{

	echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=13&msg=7';</script>";
}
?>