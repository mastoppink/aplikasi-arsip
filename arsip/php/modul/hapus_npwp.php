<?php 
if(isset($_GET['msg'])){
	$q = mysql_query("select isi from tbl_msg where id='".$_GET['msg']."' limit 1");
	$isiTbl = mysql_fetch_array($q);
	echo "<div class='alert alert-danger' id='msg'>";
	echo $isiTbl['isi'];
	echo "</div>";
}
?>
<div class="col-md-3">
<h4>Form</h4>
<form id="form_hapus_npwp" method="POST" action="php/modul/proses_hapus_npwp.php">
	<label for="npwp">NPWP</label>
	<input type="text" id="npwp" name="npwp" class="form-control">
	<label for="alasan">Alasan</label>
	<input type="text" id="alasan" name="alasan" class="form-control">
	<br \>
	<input type="hidden" name="alamat_url" value="" id="alamat_url">
	<button type="button" class="btn btn-primary" onclick="validasiRak()">Proses</button>
</form>
</div>
<div class="col-md-9">
	<h4>Berkas sudah dihapus</h4>
	<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>NPWP</th>
	<th>Nama WP</th>
	<th>Jenis Berkas</th>
	<th>Tahun</th>
	<th>Alasan</th>
	<th>Nomor Box</th>
	<th>Tanggal hapus</th>
	</tr>
	</thead>
	<tbody>
		<?php
			$tahun = date("Y");
			$q = mysql_query("select distinct(npwp) as npwp,no_berkas,nama_wp,no_box,alasan,tanggal,tbl_berkas_dihapus_npwp.jenis_berkas as jenis, tbl_jenis.nama_jenis as jenis_berkas,masa,tahun_berkas,user_id from tbl_berkas_dihapus_npwp, tbl_jenis where tbl_jenis.id = jenis_berkas order by tanggal DESC");
			$i = 1;
			while ($isiTbl = mysql_fetch_array($q)) {
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$isiTbl['npwp']."</td>";
				echo "<td>".$isiTbl['nama_wp']."</td>";
				echo "<td>".$isiTbl['jenis_berkas']."</td>";
				echo "<td>".$isiTbl['tahun_berkas']."-".$isiTbl['masa']."</td>";
				echo "<td>".$isiTbl['alasan']."</td>";
				echo "<td>".$isiTbl['no_box']."</td>";
				echo "<td>".$isiTbl['tanggal']."</td>";
				echo "</tr>";
				$i++;
			}
		?>
	</tbody>
</table>
<form method="POST" action="php/modul/export_hapus_npwp.php">
<button type="submit">Export Excell</button>
</form>
</div>
<script type="text/javascript">
	$('#tablePagination').dataTable();
	function validasiRak(){
		if($('#npwp').val() == '' || $('#alasan').val() == ''){
			tampilkanModal('Peringatan.','Formulir belum Lengkap','');
		}else{
			$('#alamat_url').attr('value',document.location.pathname);
			$('#form_hapus_npwp').submit();
		}
	}
	if($('#msg').text() != ''){
	$('#msg').show();
	}
	setTimeout(function() {
		$('#msg').hide();
	}, 2000);
</script>