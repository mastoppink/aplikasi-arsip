<div class="col-md-12">
<h4>Arsip Berkas</h4>
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
	$q = mysql_query("SELECT * from v_arsip order by tahun_berkas ASC");
	$i = 1;
	while($isiTbl = mysql_fetch_array($q)){
		echo "<tr>
		<td>".$i."</td>
		<td>".$isiTbl['npwp']."</td>
		<td>".$isiTbl['nama_wp']."</td>
		<td>".$isiTbl['nama_jenis']."</td>
		<td>".$isiTbl['tgl_masuk']."</td>
		<td>".$isiTbl['tahun_berkas']."-".$isiTbl['masa']."</td>
		<td><a href='?mod=5&no_box=".$isiTbl['no_box']."'>".$isiTbl['no_box']."</a></td>
		</tr>";
		$i++;
	}
	?>
	</tbody>
</table>
<br \>
<form method="POST" action="php/modul/arsip_download.php">
<label for='tahun_berkas'>Tahun Berkas </label>
<select id="tahun_berkas" name="tahun_berkas">
	<?php
		for($i = 1990; $i <= 2020; $i++){
			echo "<option value='".$i."'>".$i."</option>";
		}
	?>
</select>
<button type="submit">Export Excell</button>
</form>
</div>
<script type="text/javascript">
	$('#tablePagination').dataTable();
</script>