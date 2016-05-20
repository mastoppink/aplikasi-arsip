<?php
include '../config.php';
$array_nomor = array();
$array_nomor[1] = "A";
$array_nomor[2] = "B";
$array_nomor[3] = "C";
$array_nomor[4] = "D";
$array_nomor[5] = "E";
$array_nomor[6] = "F";
$array_nomor[7] = "G";
$array_nomor[8] = "H";
$array_nomor[9] = "I";
$array_nomor[10] = "J";

$q = mysql_query("select no_rak from tbl_box where no_ruangan='".$_POST['no_ruangan']."' and no_rak='".$_POST['no_rak']."'");
$row = mysql_num_rows($q);
if($row == 0){
	$no_ruangan = $_POST['no_ruangan'];
	$no_rak = $_POST['no_rak'];
	$kolom = $_POST['jumlah_kolom'];
	$baris = $_POST['jumlah_baris'];
	$box_baris = $_POST['jumlah_box_baris'];
	$no = 10;
	//$total = $kolom * $baris * $no;

	for ($k=1; $k <= $kolom ; $k++) {
		for($b=1;$b <= $baris; $b++){
			for($n=1;$n<=$box_baris;$n++){
			$no_box = "Ra".$no_ruangan."-R".$no_rak."-K".$array_nomor[$k]."-B".$b."-".$n;
			
			$q2 = mysql_query("insert into tbl_box(`no_box`,`no_rak`,`no_kolom`,`no_baris`,`no_id`,`no_ruangan`) values('".$no_box."','".$no_rak."','".$k."','".$b."','".$n."','".$no_ruangan."')");
			if(!$q2){
				echo "<script>alert('Gagal menambahkan rak.')</script>";
				//echo $no_rak."<br>";
			}
			}
		}
	}
	echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=14&msg=5';</script>"; 
}else{
	echo $_POST['no_ruangan'];
	echo "<script>document.location.href='".$_POST['alamat_url']."?mod=16&sm=14&msg=8';</script>";
}
?>