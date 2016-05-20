<?php
include "../config.php";
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
$hariIni = date("d-m-Y");
header("Content-Disposition: attachment; filename=DataBerkas-".$_POST['no_box']."-".$hariIni.".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
$q = mysql_query("select * from v_arsip where no_box='".$_POST['no_box']."' limit 65000");
echo "<table>";
echo "<tr>
	<th>No Berkas</th>
	<th>NPWP</th>
	<th>Nama WP</th>
	<th>Jenis Berkas</th>
	<th>Tanggal Masuk</th>
	<th>Nomor Box</th>
	<th>Tahun Terbit</th>
	<th>Penginput</th>
	<th>diedit</th>
	<th>tanggal edit</th>
</tr>";
while ($isiTbl = mysql_fetch_array($q)) {
	echo "<tr>";
	echo "
	<td>".$isiTbl['no_berkas']."</td>
	<td>".$isiTbl['npwp']."</td>
	<td>".$isiTbl['nama_wp']."</td>
	<td>".$isiTbl['nama_jenis']."</td>
	<td>".$isiTbl['tgl_masuk']."</td>
	<td>".$isiTbl['no_box']."</td>
	<td>".$isiTbl['tahun_berkas']."</td>
	<td>".$isiTbl['user_id']."</td>
	<td>".$isiTbl['user_edit']."</td>
	<td>".$isiTbl['tgl_edit']."</td>
	";
	echo "</tr>";
}

echo "</table>";
?>