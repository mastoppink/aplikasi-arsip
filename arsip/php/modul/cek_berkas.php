<?php
include "../konfigurasi/config.php";
if(isset($_POST)){
	$q = mysql_query("select id,box_id from tbl_berkas where no_berkas = '".$_POST['noBerkas']."'");
	$row = mysql_num_rows($q);
	$isiTbl = mysql_fetch_array($q);
	if($row == '1'){
		$q2 = mysql_query("SELECT id from tbl_peminjam where berkas = '".$_POST['noBerkas']."'");
		$row2 = mysql_num_rows($q2);
		if($row2 == "1"){
			echo "Berkas sudah dipinjam.";
		}else{
			echo "Berkas tersedia di Box ".$isiTbl['box_id'];
		}
	}else{
		echo "Berkas Tidak Tersedia, Periksa Nomor Berkas.";
	}
}else{
	echo "Ada kesalahan dengan sistem.";
}

?>