<?php
include "../config.php";
$q = mysql_query("delete from tbl_peminjam where no_berkas='".$_POST['no_berkas']."'");
if(!$q){
	echo "gagal";
}else{
	echo "ok";
}
?>