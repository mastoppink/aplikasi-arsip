<?php
include "../config.php";
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
$hariIni = date("d-m-Y");
header("Content-Disposition: attachment; filename=DataBerkas-hapusnpwp-".$hariIni.".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
$q = mysql_query("select npwp,no_berkas,nama_wp,no_box,alasan,tanggal,tbl_berkas_dihapus_npwp.jenis_berkas as jenis, tbl_jenis.nama_jenis as jenis_berkas,masa,tahun_berkas,user_id from tbl_berkas_dihapus_npwp, tbl_jenis where tbl_jenis.id = jenis_berkas order by tanggal DESC limit 65000");
echo "<table>";
echo "<tr>
	<th>No Berkas</th>
	<th>NPWP</th>
	<th>Nama WP</th>
	<th>Jenis Berkas</th>
	<th>Nomor Box</th>
	<th>Tahun</th>
	<th>Masa</th>
	<th>Alasan</th>
	<th>Tanggal Hapus</th>
</tr>";
while ($isiTbl = mysql_fetch_array($q)) {
	echo "<tr>";
	echo "
	<td>".$isiTbl['no_berkas']."</td>
	<td>".$isiTbl['npwp']."</td>
	<td>".$isiTbl['nama_wp']."</td>
	<td>".$isiTbl['jenis_berkas']."</td>
	<td>".$isiTbl['no_box']."</td>
	<td>".$isiTbl['tahun_berkas']."</td>
	<td>".$isiTbl['masa']."</td>
	<td>".$isiTbl['alasan']."</td>
	<td>".$isiTbl['tanggal']."</td>
	";
	echo "</tr>";
}

echo "</table>";
?>