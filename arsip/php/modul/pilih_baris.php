<?php
$no_rak = $_GET['no_rak'];
$no_kolom = $_GET['no_kolom'];
$no_ruangan = $_GET['no_ruangan'];

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

echo "<h4 class='big-leter'>Ruangan: ".$no_ruangan." - Rak : ".$no_rak." - Kolom ".$array_nomor[$no_kolom]."</h4>";
echo "<p>Silahkan Pilih Baris</p>";

$q = mysql_query("select distinct(no_baris) as no_baris from tbl_box where no_ruangan='".$no_ruangan."' and no_rak='".$no_rak."' and no_kolom = '".$no_kolom."' order by no_baris ASC");
$i = 1;
while($isiTbl = mysql_fetch_array($q)){
	$q2 = mysql_query("select no_box from tbl_box where no_rak = '".$no_rak."' and no_kolom='".$no_kolom."' and no_baris = '".$isiTbl['no_baris']."'");
	$jumlah_box = mysql_num_rows($q2);

	echo "<a href='?mod=4&no_ruangan=".$no_ruangan."&no_rak=".$no_rak."&no_kolom=".$no_kolom."&no_baris=".$isiTbl['no_baris']."' class='btn btn-primary'>
	<p><strong>Baris ".$isiTbl['no_baris']."</strong></p>
	<br \>
	</p>
	</a> &nbsp";
	$i++;
	if($i%7==0){
		echo "<br \><br \>";
	}
}
?>