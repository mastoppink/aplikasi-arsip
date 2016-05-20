<?php
$no_ruangan = $_GET['no_ruangan'];
echo "<h4 class='big-leter'>Ruangan : ".$no_ruangan."</h4>";
echo "<p>Silakan pilih Rak yang akan digunakan</p>";
$q = mysql_query("select distinct(no_rak) as no_rak from tbl_box where no_ruangan='".$no_ruangan."'");
$i = 1;
while($isiTbl = mysql_fetch_array($q)){
	$q2 = mysql_query("select no_box from tbl_box where no_rak = '".$isiTbl['no_rak']."' order by no_rak ASC");
	$jumlah_box = mysql_num_rows($q2);

	echo "<a href='?mod=2&no_ruangan=".$no_ruangan."&no_rak=".$isiTbl['no_rak']."' class='btn btn-primary'>
	<p><strong>Rak ".$isiTbl['no_rak']."</strong></p>
	<br \>
	";//Jumlah Box : ".$jumlah_box."<br \>
	echo "</p>
	</a> &nbsp";
	$i++;
	if($i%7==0){
		echo "<br \><br \>";
	}
}
?>