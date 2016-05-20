<div class="col-md-12">
<h4>Berkas Kemungkinan Daluarsa</h4>
<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>NPWP</th>
	<th>Nama WP</th>
	<th>Jenis Berkas</th>
	<th>Tanggal Masuk</th>
	<th>Tahun Berkas</th>
	<th>Nomor Box</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$tahun = date("Y");
	$q = mysql_query("SELECT * from v_arsip where tahun_berkas < '".($tahun-10)."' order by no_box ASC");
	$i = 1;
	while($isiTbl = mysql_fetch_array($q)){
		echo "<tr>
		<td>".$i."</td>
		<td>".$isiTbl['npwp']."</td>
		<td>".$isiTbl['nama_wp']."</td>
		<td>".$isiTbl['nama_jenis']."</td>
		<td>".$isiTbl['tgl_masuk']."</td>
		<td>".$isiTbl['tahun_berkas']."</td>
		<td><a href='?mod=5&no_box=".$isiTbl['no_box']."'>".$isiTbl['no_box']."</a></td>
		</tr>";
		$i++;
	}
	?>
	</tbody>
</table>
<form method="POST" action="php/modul/export_daluarsa.php">
<button type="submit">Export Excell</button>
</form>
</div>
<script type="text/javascript">
	$('#tablePagination').dataTable();
</script>