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
<h4>Rak Baru</h4>
<form id="formRak" method="POST" action="php/modul/proses_rak.php">
	<label for="no_ruangan">Nomor Ruangan</label>
	<input type="text" id="no_ruangan" name="no_ruangan" class="form-control">
	<label for="no_rak">Nomor Rak</label>
	<input type="text" id="no_rak" name="no_rak" class="form-control">
	<label for="jumlah_kolom">Jumlah Kolom</label>
	<input type="text" id="jumlah_kolom" name="jumlah_kolom" class="form-control">
	<label for="jumlah_baris">Jumlah Baris</label>
	<input type="text" id="jumlah_baris" name="jumlah_baris" class="form-control">
	<label for="jumlah_baris">Jumlah Box Perbaris</label>
	<input type="text" id="jumlah_box_baris" name="jumlah_box_baris" class="form-control">
	<br \>
	<input type="hidden" name="alamat_url" value="" id="alamat_url">
	<button type="button" class="btn btn-primary" onclick="validasiRak()">Simpan</button>
</form>
</div>
<div class="col-md-9">
	<h4>Rak Tersedia</h4>
	<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>Nomor Ruangan</th>
	<th>Nomor Rak</th>
	<th>Jumlah Kolom</th>
	<th>Jumlah Baris</th>
	<th>Jumlah Box</th>
	<th>Tindakan</th>
	</tr>
	</thead>
	<tbody>
		<?php
			$qr = mysql_query("select distinct(no_ruangan) as no_ruangan from tbl_box order by no_ruangan");
			$i =  1;	
			while ( $isiTbl1 = mysql_fetch_array($qr)) {
				# code...
			
				$q = mysql_query("SELECT no_rak as nomor_rak,no_ruangan, max(no_kolom) as jumlah_kolom, max(no_baris) as jumlah_baris, count(no_box) as jumlah_box from tbl_box where no_ruangan='".$isiTbl1['no_ruangan']."' group by no_rak");
				while ($isiTbl = mysql_fetch_array($q)) {
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td>Ruangan ".$isiTbl['no_ruangan']."</td>";
					echo "<td>Rak ".$isiTbl['nomor_rak']."</td>";
					echo "<td>".$isiTbl['jumlah_kolom']."</td>";
					echo "<td>".$isiTbl['jumlah_baris']."</td>";
					echo "<td>".$isiTbl['jumlah_box']."</td>";
					echo "<td><button value='Ra".$isiTbl['no_ruangan']."-R".$isiTbl['nomor_rak']."' onclick='konfirmasiHapus(this.value)' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button>
					</td>";
					echo "</tr>";
					$i++;
				}
			}
		?>
	</tbody>
</table>
</div>
<script type="text/javascript">
	$('#tablePagination').dataTable();
	function validasiRak(){
		if($('#no_ruangan').val() == '' || $('#no_rak').val() == '' || $('#jumlah_kolom').val() == '' || $('#jumlah_baris').val() == '' || $('#jumlah_baris').val() > 8 || $('#jumlah_box_baris').val() > 30 || $('#jumlah_box_baris').val() == '' ){
			tampilkanModal('Peringatan.','Formulir belum Lengkap','');
		}else{
			$('#alamat_url').attr('value',document.location.pathname);
			$('#formRak').submit();
		}
	}

	function hapus(id){
		$.ajax({
			type: "POST",
			url: 'php/modul/hapus_rak.php',
			data: {
				"no_data":  id
			},
			success: function(data){
				alert(data);

				
				var alamat = document.location.href;
				//var test = buangGetParam('msg',alamat);
				//alert(alamat);
				//document.location.href=buangGetParam('msg',alamat);
				document.location.href=alamat;
			}
		});

	}

	function konfirmasiHapus(id){
		var tombol_konfirmasi = "<button type='button' class='btn btn-danger' value='"+id+"' onclick='hapus(this.value)' data-dismiss='modal'>Yakin</button>\
		<button type='button' class='btn btn-primary' data-dismiss='modal'>Tidak</button>"
		tampilkanModal('Konfirmasi','Apakah anda yakin akan menghapus Rak ini?',tombol_konfirmasi);
	}
	if($('#msg').text() != ''){
	$('#msg').show();
	}
	setTimeout(function() {
		$('#msg').hide();
	}, 2000);
</script>