<?php
session_start();
require_once("../config.php");
if($_POST['username'] == '' || $_POST['password'] == ''){
	header ('location: ../../login.php?m=1');
	//echo $_POST['username'];
}else{
	$q = mysql_query("select username,password,nama_lengkap,seksi,admin from tbl_user where username = '".$_POST['username']."' limit 1");
	$r = mysql_num_rows($q);
	if ($r==0 || $r == '') {
		header ('location: ../../login.php?m=2');
	}else{
		$isitabel = mysql_fetch_array($q);
		if($isitabel['password'] != md5($_POST['password'])){
			header ('location: ../../login.php?m=3');
		}else{
			$_SESSION['username'] = $isitabel['username'];
			$_SESSION['seksi'] = $isitabel['seksi'];
			$_SESSION['nama_lengkap'] = $isitabel['nama_lengkap'];
			$_SESSION['admin'] = $isitabel['admin'];
			header ('location: ../../main.php');
		}
	}
}

?>