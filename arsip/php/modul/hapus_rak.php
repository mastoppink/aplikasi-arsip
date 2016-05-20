<?php
include '../config.php';
if(strlen($_POST['no_data'])==7){
	$q = mysql_query("select no_berkas from tbl_berkas where LEFT(no_box,7) = '".$_POST['no_data']."'");
}else{
	$q = mysql_query("select no_berkas from tbl_berkas where LEFT(no_box,6) = '".$_POST['no_data']."'");
}

$no = explode("-", $_POST['no_data']);
$no_ruangan = str_replace("Ra", "", $no[0]);
$no_rak = str_replace("R", "", $no[1]);

$row = mysql_num_rows($q);
if($row == 0){
	$q2 = mysql_query("delete from tbl_box where no_ruangan='".$no_ruangan."' and no_rak='".$no_rak."'");
	if(!$q){
		echo "Internal Error.";
	}else{
		echo "Berhasil.";
	}
}else{
	echo "Berkas masih ada yang tersimpan di rak.";
}

?>