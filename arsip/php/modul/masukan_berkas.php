<div class='alert alert-info' role='alert'>
  		<span class="fa fa-info-circle"></span> Silakan pilih Rak terlebih dahulu.<a href='' class='alert-link'></a>
</div>
<?php
$q = mysql_query("select id,nama_rak, kolom,baris,jumlah_berkas,keterangan from tbl_rak");
$i = 1;
while ($isiTabel=mysql_fetch_array($q)) {
	$q2 = mysql_query("select count(*) as jumlah_box from tbl_box where rak_id='".$isiTabel['id']."'");
	$q3 = mysql_fetch_array($q2);
	echo "<a href='?mod=11&id=".$isiTabel['id']."' class='btn btn-primary'>
	<p><strong>Rak ".$isiTabel['id']."</strong></p>
	<p>".$isiTabel['nama_rak']."<br \>
	Ukuran PxL : ".$isiTabel['kolom']." x ".$isiTabel['baris']."<br \>
	Jumlah Box : ".$q3['jumlah_box']."<br \>
	Ket: ".$isiTabel['keterangan']."	
	</p>
	</a> &nbsp";
	if($i%7==0){
		echo "<br \><br \>";
	}
	$i++;
}

?>
	