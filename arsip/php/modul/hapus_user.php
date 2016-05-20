<?php
include '../config.php';
$q = mysql_query("delete from tbl_user where username='".$_POST['username']."'");
if(!$q){
	echo "Gagal";
}else{
	echo "ok";
}
?>