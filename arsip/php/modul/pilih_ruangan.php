<p>Silakan pilih Ruangan yang akan digunakan</p>
<?php
$q = mysql_query("select distinct(no_ruangan) as no_ruangan from tbl_box");
$i = 1;
while($isiTbl = mysql_fetch_array($q)){
	$q2 = mysql_query("select no_box from tbl_box where no_ruangan = '".$isiTbl['no_ruangan']."' order by no_ruangan ASC");
	$jumlah_box = mysql_num_rows($q2);

	echo "<a href='?mod=1&no_ruangan=".$isiTbl['no_ruangan']."' class='btn btn-primary'>
	<p><strong>Ruangan ".$isiTbl['no_ruangan']."</strong></p>
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