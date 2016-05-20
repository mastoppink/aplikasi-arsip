<?php
session_start();
include "../config.php";
if(isset($_POST['no_berkas'])){
	$q = mysql_query("delete from tbl_berkas where no_berkas = '".$_POST['no_berkas']."'");

	if($q === false){
		echo "gagal";
	}else
	{
		echo "ok";
	}
}
?>