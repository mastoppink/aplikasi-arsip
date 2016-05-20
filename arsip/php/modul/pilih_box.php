<?php
$no_ruangan = $_GET['no_ruangan'];
$no_rak = $_GET['no_rak'];
$no_kolom = $_GET['no_kolom'];
$no_baris = $_GET['no_baris'];

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

echo "<h4 class='big-leter'> Ruangan : ".$no_ruangan." - Rak : ".$no_rak." - Kolom ".$array_nomor[$no_kolom]." - Baris ".$no_baris."</h4>";
echo "<p>Silahkan Pilih Box</p>";

$q = mysql_query("select no_box,no_id from tbl_box where no_ruangan='".$no_ruangan."' and no_rak='".$no_rak."' and no_kolom = '".$no_kolom."' and no_baris = '".$no_baris."' order by no_id ASC");
$i = 1;
while($isiTbl = mysql_fetch_array($q)){
	$q2 = mysql_query("select no_berkas from tbl_berkas where no_box = '".$isiTbl['no_box']."'");
	$jumlah_berkas = mysql_num_rows($q2);
	if($jumlah_berkas > 20){
		$btn = "danger";
	}if ($jumlah_berkas > 5) {
		$btn = "warning";
	} else {
		$btn = "default";
	}
	
	echo "<a href='?mod=5&no_ruangan=".$no_ruangan."&no_rak=".$no_rak."&no_kolom=".$no_kolom."&no_baris=".$no_baris."&no_box=".$isiTbl['no_box']."' class='btn btn-".$btn."'>
	<p><strong>".$isiTbl['no_id']."</strong></p>
	Jumlah Berkas : ".$jumlah_berkas."<br \>
	</p>
	</a> &nbsp";
	if($i%7==0){
		echo "<br \><br \>";
	}
	$i++;
}
?>