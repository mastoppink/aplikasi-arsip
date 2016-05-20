<?php
include '../config.php';
$q = mysql_query("update tbl_user set password='".md5($_POST['password'])."' where username='".$_POST['username']."'");
if(!$q){
	echo "gagal";
}else{
	echo "ok";
}
?>