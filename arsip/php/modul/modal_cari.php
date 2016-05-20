<?php
include "../config.php";

if(isset($_POST)){
	$q = mysql_query("select no_berkas, npwp, tbl_jenis.nama_jenis from tbl_berkas,tbl_jenis where tbl_jenis.id = tbl_berkas.jenis_berkas and (tbl_berkas.npwp LIKE '%".$_POST['cariVal']."%' or tbl_berkas.no_berkas LIKE '%".$_POST['cariVal']."%') and no_berkas not in (select no_berkas from tbl_peminjam) limit 10");
	
	while ($isiTbl = mysql_fetch_array($q)) {
		echo "<tr>";
		echo "<td>".$isiTbl['no_berkas']."</td>";
		echo "<td>".$isiTbl['npwp']."</td>";
		echo "<td>".$isiTbl['nama_jenis']."</td>";
		echo "<td><button type='button' onclick='pilihCari(this.value)' value= '".$isiTbl['no_berkas']."' class='btn btn-primary btn-xs' data-dismiss='modal'>Pilih</button></td>";
		echo "</tr>";
	}

}
?>