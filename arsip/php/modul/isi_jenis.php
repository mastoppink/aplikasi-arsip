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
<h4>Jenis Berkas Baru</h4>
<form id="formJenis" method="POST" action="php/modul/proses_jenis.php">
<label for='nama_jenis'></label>
<input type="text" id="nama_jenis" name="nama_jenis" class="form-control">
<br \>
<input type="hidden" name="alamat_url" value="" id="alamat_url">
<button type="button" onclick="validasiJenis()" class="btn btn-primary">Tambahkan</button>
</form>
</div>

<div class="col-md-9">
<h4>Jenis Berkas</h4>
<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th width="8%">No</th>
	<th>Jenis Berkas</th>
	<th>Jumlah Berkas Terimpan</th>
	<th>Tindakan</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$q = mysql_query("select id,nama_jenis from tbl_jenis");
		$i = 1;
		while ($isiTbl = mysql_fetch_array($q)) {
			$q2 = mysql_query("select jumlah from v_perjenis where id='".$isiTbl['id']."' limit 1");
			$isiTbl2 = mysql_fetch_array($q2);

			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$isiTbl['nama_jenis']."</td>";
			echo "<td>".number_format($isiTbl2['jumlah'])."</td>";
			echo "<td><button type='button' value='".$isiTbl['id']."' onclick='konfirmasiHapus(this.value)' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button> | <button type='button' value='".$isiTbl['id']."' onclick='gantiNama(this.value)' class='btn btn-primary btn-xs'><span class='fa fa-pencil'></span> Edit</button>
			</td>";
			echo "</tr>";
			$i++;
		}
	?>
	</tbody>
</table>
</div>
<script type="text/javascript">
	$('#tablePagination').dataTable();

	function validasiJenis(){
		if($('#nama_jenis').val() == ''){
			tampilkanModal('Peringatan.','Formulir belum Lengkap','');
		}else{
			$('#alamat_url').attr('value',document.location.pathname);
			$('#formJenis').submit();
		}
	}

	function hapus(id){
		$.ajax({
			type: "POST",
			url: 'php/modul/hapus_jenis.php',
			data: {
				"id":  id
			},
			success: function(data){
				if(data == 'ok'){
				var alamat = document.location.href;
				document.location.href = alamat;
				}else{
					alert(data);
				}
			}
		});

	}

	function konfirmasiHapus(id){
		var tombol_konfirmasi = "<button type='button' class='btn btn-danger' value='"+id+"' onclick='hapus(this.value)' data-dismiss='modal'>Yakin</button>\
		<button type='button' class='btn btn-primary' data-dismiss='modal'>Tidak</button>"
		tampilkanModal('Konfirmasi','Apakah anda yakin akan menghapus user ini?',tombol_konfirmasi);
	}

	function ok(ids){
		var nama_baru =  $('#nama_baru').val();
		$.ajax({
			type: "POST",
			url: "php/modul/edit_jenis.php",
			data: {
				'nama_baru' : nama_baru,
				'id' : ids
			},
			success: function(data){
				if(data == 'ok'){
				var alamat = document.location.href;
				document.location.href = alamat;
				}else{
					alert(data);
				}
			}
		});
	}

	function gantiNama(id){
		
		var inputan = "<input type='text' id='nama_baru' class='form-control' placeholder='Masukan Nama Baru...'>";
		var tombol = "<button class='btn btn-primary' value='"+id+"' onclick='ok(this.value)' data-dismiss='modal'>Simpan</button>";
		tampilkanModal('Ganti Nama Jenis',inputan,tombol);
	}
	if($('#msg').text() != ''){
	$('#msg').show();
	}
	setTimeout(function() {
		$('#msg').hide();
	}, 2000);
</script>