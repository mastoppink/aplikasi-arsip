<div class="alert alert-info"><b class="big-leter"> 
<?php
$array_nomor = array();
$array_nomor[1] = "A";
$array_nomor[2] = "B";
$array_nomor[3] = "C";
$array_nomor[4] = "D";
$array_nomor[5] = "E";
$array_nomor[6] = "F";
$array_nomor[7] = "G";
$array_nomor[8] = "H";
$array_nomor[9] = "I";
$array_nomor[10] = "J";

if(isset($_GET['no_rak']) && isset($_GET['no_rak']) && isset($_GET['no_kolom']) && isset($_GET['no_baris'])){
echo "Ruangan ".$_GET['no_rak']." - Rak ".$_GET['no_rak']." - Kolom ".$array_nomor[$_GET['no_kolom']]." - Baris ".$_GET['no_baris']." - Box ".$_GET['no_box']; 
}else{
	echo "Box ".$_GET['no_box'];
}
?>
</b></div>
<?php 
if(isset($_GET['msg'])){
	$q = mysql_query("select isi from tbl_msg where id='".$_GET['msg']."' limit 1");
	$isiTbl = mysql_fetch_array($q);
	echo "<div class=\"alert alert-danger\" id=\"msg\">";
	echo $isiTbl['isi'];
	echo "</div>";
}
?>

<div class="col-md-3">
<h4>Data Berkas</h4>
<form id="formBerkas" method="POST" action="php/modul/proses_berkas.php">
	<input type="hidden" name="no_box" value="<?php echo $_GET['no_box']?>">
	<label for='jenis_berkas'>Jenis Berkas</label>
	<select id="jenis_berkas" name="jenis_berkas" class="form-control">
		<option value="">Pilih Jenis Berkas</option>
		<?php
		$q = mysql_query("SELECT id, nama_jenis from tbl_jenis");
		while($isiTbl = mysql_fetch_array($q)) {
			echo "<option value='".$isiTbl['id']."'>".$isiTbl['nama_jenis']."</option>";
		}
		?>
	</select>
	<label for='npwp'>NPWP</label>
	<input type="text" id="npwp" value='' name="npwp" onkeyup="cekNamaWp(this.value)" class="form-control">
	<label for='nama_wp'>Nama WP</label>
	<input type="text" id="nama_wp2" name="nama_wp" value='' class="form-control" disabled>
	<input type="hidden" id="nama_wp" name="nama_wp" value='' class="form-control">
	<label for='tahun_berkas'>Tahun Berkas</label>
	<input type="text" id="tahun_berkas" name="tahun_berkas" class="form-control">
	<label for='masa'>Masa</label>
	<input type="text" id="masa" name="masa" maxlength="2" value="00" class="form-control">
	<input type="hidden" value="" name="alamat_url" id='alamat_url'>
	<span class="help-inline">isi jika format nomor berkas tidak mengandung tahun.</span>
	<br \>
	<br \>
	<button type="button" onclick='validasiForm()' class="btn btn-primary">Simpan</button>
</form>
</div>
<div class="col-md-9">
<h4>Berkas di Box ini</h4>
<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>NPWP</th>
	<th>Nama WP</th>
	<th>Jenis Berkas</th>
	<th>Tahun</th>
	<th>Tindakan</th>
	</tr>
	</thead>
	<tbody>
		<?php
			$tahun = date("Y");
			$q = mysql_query("select no_berkas,npwp,nama_wp,tbl_berkas.jenis_berkas as jenis, tbl_jenis.nama_jenis as jenis_berkas,masa,tahun_berkas,user_id from tbl_berkas, tbl_jenis where tbl_jenis.id = jenis_berkas and no_box='".$_GET['no_box']."' order by tgl_masuk DESC");
			$i = 1;
			while ($isiTbl = mysql_fetch_array($q)) {
				echo "<tr>";
				echo "<td>".$i."</td>";
				if($isiTbl['tahun_berkas'] < ($tahun-10) && $isiTbl['jenis'] != "25"){
					echo "<td class='blink red'>".$isiTbl['npwp']."</td>";
				}else{
					echo "<td>".$isiTbl['npwp']."</td>";
				}
				echo "<td>".$isiTbl['nama_wp']."</td>";
				echo "<td>".$isiTbl['jenis_berkas']."</td>";
				echo "<td>".$isiTbl['tahun_berkas']."-".$isiTbl['masa']."</td>";
				echo "<td>";

				if($_SESSION['admin']==1){
				echo "<button value='".$isiTbl['no_berkas']."' onclick= 'konfirmasiHapus(this.value)' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></button> | ";
				}
				echo "<button value='".$isiTbl['no_berkas']."' onclick='edit(this.value)' class='btn btn-primary btn-xs'><span class='fa fa-pencil'></span></button></td>";
				echo "</tr>";
				$i++;
			}
		?>
	</tbody>
</table>
<form method="POST" action="php/modul/export_box.php">
<input type="hidden" name="no_box" value=<?php echo "'Box-".$_GET['no_box']."'"; ?>>
<button type="submit">Export Excell</button>
</form>
</div>
<script text="JavaScript">
	$('#tablePagination').DataTable();
	function isinama(){
		$('#nama_wp').attr('disabled',false);
	}
	function cekNamaWp(npwp){
		$.ajax({
			type: "POST",
			url: 'php/modul/cek_nama_wp.php',
			data: {
				'npwp': npwp
			},
			success: function(data){
				$('#nama_wp').attr('value',data);
				$('#nama_wp2').attr('value',data);
			}
		});
		
	}
	function validasiForm() {
		if($('#jenis_berkas').val() == '' ||
		$('#npwp').val() == '' ||
		$('#nama_wp').val() == '' ||
		$('#masa').val() == ''
		){
			alert("belum lengkap");
		}else{
			var alamat_url = window.location.href;
			$('#alamat_url').attr('value', alamat_url);
			$('#formBerkas').submit();
		}
		

	}

	function hapus(id){
		$.ajax({
			type: "POST",
			url: 'php/modul/hapus_berkas.php',
			data: {
				"no_berkas":  id
			},
			success: function(data){
				if(data == "ok"){
					alert("Berkas Dihapus");
				}else{
					alert("Berkas Gagal Dihapus");
				}
				
				var alamat = document.location.href;
				document.location.href=alamat;
				//var alamat = document.location.href;
				//var test = buangGetParam('msg',alamat);
				//alert(test);
			}
		});

	}

	function konfirmasiHapus(id){
		var tombol_konfirmasi = "<button type='button' class='btn btn-danger' value='"+id+"' onclick='hapus(this.value)' data-dismiss='modal'>Yakin</button>\
		<button type='button' class='btn btn-primary' data-dismiss='modal'>Tidak</button>"
		tampilkanModal('Konfirmasi','Apakah anda yakin akan menghapus berkas?',tombol_konfirmasi);
	}

	function prosesEdit(){
		var alamat_url = window.location.href;
		$('#formEditBerkas>#alamat_url').attr('value', alamat_url);
		if(
			$('#formEditBerkas>#no_berkas').val() == '' || 
			$('#formEditBerkas>#jenis_berkas').val() == '' || 
			$('#formEditBerkas>#npwp').val() == '' || 
			$('#formEditBerkas>#nama_wp').val() == '' || 
			$('#formEditBerkas>#tahun_berkas').val() == '' ||
			$('#formEditBerkas>#masa').val() == '' ){
			$('#formEditBerkas>#tombol_submit').removeAttr('data-dismiss');
			alert("Form Belum Lengkap.");
		}else{
			$('#formEditBerkas').submit();
			//$('#formEditBerkas>#tombol_submit').addAttr('data-dismiss');
			//$('#formEditBerkas>#tombol_submit').attr('data-dismiss','modal');	

		}
	}
	function edit(id){
		$.ajax({
			type: "POST",
			url: "php/modul/modal_edit.php",
			data: {
				'no_berkas': id
			},
			success: function(data){
				tampilkanModal("Edit Berkas",data,"");
			}
		});
		
	}
	if($('#msg').text() != ''){
	$('#msg').show();
	}
	setTimeout(function() {
		$('#msg').hide();
	}, 2000);
</script>
