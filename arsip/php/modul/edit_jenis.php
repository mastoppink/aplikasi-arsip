<?php
include '../config.php';
$q = mysql_query("SELECT nama_jenis from tbl_jenis where nama_jenis = '".$_POST['nama_baru']."'");
$row = mysql_num_rows($q);
if($row == 0){
	$q2 = mysql_query("update tbl_jenis SET `nama_jenis` = '".$_POST['nama_baru']."' where id='".$_POST['id']."'");
	if(!$q){
		echo "gagal";
	}else{
		echo "ok";
	}
}else{
	echo "Nama jenis sudah ada.";
}
?>