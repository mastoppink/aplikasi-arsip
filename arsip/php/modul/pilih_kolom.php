<?php
$no_ruangan = $_GET['no_ruangan'];
$no_rak = $_GET['no_rak'];

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

echo "<h4 class='big-leter'>Ruangan: ".$no_ruangan." - Rak : ".$no_rak."</h4>";
echo "<p>Silahkan Pilih Kolom</p>";

$q = mysql_query("select distinct(no_kolom) as no_kolom from tbl_box where no_ruangan='".$no_ruangan."' and no_rak='".$no_rak."' order by no_kolom ASC");
$i = 1;
while($isiTbl = mysql_fetch_array($q)){
	$q2 = mysql_query("select no_box from tbl_box where no_rak = '".$no_rak."' and no_kolom='".$isiTbl['no_kolom']."'");
	$jumlah_box = mysql_num_rows($q2);

	echo "<a href='?mod=3&no_ruangan=".$no_ruangan."&no_rak=".$no_rak."&no_kolom=".$isiTbl['no_kolom']."' class='btn btn-primary'>
	<p><strong>Kolom ".$array_nomor[$isiTbl['no_kolom']]."</strong></p>
	<br \>
	</p>
	</a> &nbsp";
	$i++;
	if($i%7==0){
		echo "<br \><br \>";
	}
}
?>