
<div class="col-md-3">
<h4>Data Peminjam</h4>
<form id="formBerkas" method="POST" action="php/modul/proses_pinjam.php">
	<label>Peminjam *</label>
	<input type="text" id="peminjam" name="peminjam" class="form-control">
	<label>Berkas</label> 
	<input type="text" id="noBerkas" name="noBerkas" class="form-control" onblur="cek_ketersediaan_berkas(this.value)" value="" disabled="true">
	<a id="cariBerkas" type="button" style="cursor: pointer" onclick="formCariBerkas()"><i class="fa fa-search"></i>Pilih Berkas</a>
	<input type="hidden" name="no_berkas" id="no_berkas">
	<input type="hidden" name="alamat_url" id="alamat_url">
	<span class="help-inline" id="helpBerkas">Berkas tidak ditemukan.</span>
	<br \>
	<br \>
	<button type="button" class="btn btn-primary" id="proses" onclick="proses_pinjam()">Proses</button>
</form>
</div>
<div class="col-md-9">
<h4>Berkas Sedang Dipinjam</h4>
<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>No. Berkas</th>
	<th>Peminjam</th>
	<th>Tanggal Pinjam</th>
	<th>Tindakan</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$q = mysql_query("select no_berkas,peminjam,tgl_pinjam from tbl_peminjam order by tgl_pinjam DESC");
		$i = 1;

		while ($isiTbl = mysql_fetch_array($q)) {
			echo "
			<tr>
			<td>".$i."</td>
			<td>".$isiTbl['no_berkas']."</td>
			<td>".$isiTbl['peminjam']."</td>
			<td>".$isiTbl['tgl_pinjam']."</td>
			<td><button class='btn btn-primary btn-xs' onclick='kembalikanBerkas(this.value)' value='".$isiTbl['no_berkas']."'>Kembalikan</button></td>
			</tr>";
			$i++;
			//nitip nilai id di row user
		}
		
	?>
	</tbody>
</table>
</div>
<script type="text/javascript">
	$('#tablePagination').DataTable();
	function cek_ketersediaan_berkas(id){
		$.ajax({
			type: "POST",
			url: "php/modul/cek_berkas.php",
			data: {
				'noBerkas': id
			},
			success: function(data){
			$('#helpBerkas').html(data);
			$('#helpBerkas').show();		
			}
		});
		
	}

	function pilihCari(id){
		$('#noBerkas').removeAttr('value');
		$('#noBerkas').attr('value',id);
		$('#no_berkas').attr('value',id);

	}

	function cariBerkas(id){
		$.ajax({
			type: "POST",
			url: 'php/modul/modal_cari.php',
			data: {'cariVal': id},
			success: function(data){
				$('#hasilCariP').html(data);
			}
		});
	}

	function formCariBerkas(){
	
	var inputNama = "<input type='text' class='form-control' onkeyup='cariBerkas(this.value)' placeholder='Masukan NPWP atau No. Surat...'><br>";
	var content = "<div>\
	<table class='table table-bordered'>\
	<thead><tr><th>No Berkas</th><th>NPWP</th><th>Jenis Berkas</th><th>Opsi</th></tr></thead><tbody id='hasilCariP'></tbody></table></div>";
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalLabel').html("Cari Berkas");
	$('#myModalBody').html(inputNama+content);
	$('#myModalFooter').html("");
	$('#myModal').modal();
	
	}

	function proses_pinjam(){
		if ($('#peminjam').val() == '' || $('#no_berkas').val() == ''){
			tampilkanModal('Peringatan','Maaf anda belum melengkapi formulir','');
		}else{
			var alamat = document.location.href;
			$('#alamat_url').attr('value',alamat);
			$('#formBerkas').submit();
		}
	}

	function kembalikanBerkas(id){
		$.ajax({
			type: "POST",
			url: "php/modul/kembalikan_berkas.php",
			data: {
				'no_berkas': id
			},
			success: function(data){
				if(data=='ok'){
					var alamat = document.location.href;
					document.location.href=alamat;
				}else{
					alert('Gagal Memroses.');
				}
							
			}
		});
	}
	
</script>