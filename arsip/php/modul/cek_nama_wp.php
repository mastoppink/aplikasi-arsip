<?php
require_once "../config.php";
$q = mysql_query("SELECT nama_wp from tbl_wp where npwp='".$_POST['npwp']."'");
$isiTbl = mysql_fetch_array($q);
$nama_wp = $isiTbl['nama_wp'];
echo $nama_wp;
?>