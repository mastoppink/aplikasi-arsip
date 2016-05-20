<?php
include "../config.php";
$q = mysql_query("SELECT nama_jenis from tbl_jenis where nama_jenis='".$_POST['nama_jenis']."'");
$row = mysql_num_rows($q);
if($row == 0){
	$q2 = mysql_query("insert into tbl_jenis(`nama_jenis`) values('".$_POST['nama_jenis']."')");
	if(!$q2){
		echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=15&msg=6';</script>";
	}else{
		echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=15&msg=5';</script>";
	}
}else{
	echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=15&msg=9';</script>";
}
?>