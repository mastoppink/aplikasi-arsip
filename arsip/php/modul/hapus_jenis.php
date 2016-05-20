<?php
include '../config.php';
$q = mysql_query("select jumlah from v_perjenis where id='".$_POST['id']."'");
$isiTbl = mysql_fetch_array($q);
if($isiTbl['jumlah']==0){
	$q2 = mysql_query("delete from tbl_jenis where id = '".$_POST['id']."'");
	if(!$q2){
		echo "gagal.";
	}else{
		echo "ok";
	}
}else{
	echo "Masih ada berkas tersisa.";
}
?>