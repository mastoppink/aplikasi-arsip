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
<h4>User Baru</h4>
<form id="formUser" method="POST" action="php/modul/proses_user.php">
	<label for='username'>Username</label>
	<input type="text" id="username" class="form-control" name="username">
	<label for='password'>Password</label>
	<input type="text" id="password" class="form-control" name="password">
	<label for='nama_lengkap'>Nama Lengkap</label>
	<input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap">
	<input type="checkbox" id="admin" name="admin" value="1">
	<label for='nama_lengkap'>admin</label>
	<br>
	<input type="hidden" name="alamat_url" value="" id="alamat_url">
	<button class="btn btn-primary" type="button" onclick="validasiUser()">Simpan</button>
</form>
</div>
<div class="col-md-9">
	<h4>User Terdaftar</h4>
	<table class="table table-bordered" id="tablePagination">
	<thead>
	<tr>
	<th>No</th>
	<th>Username</th>
	<th>Nama Lengkap</th>
	<th>Berkas Diinput</th>
	<th>Tanggal Daftar</th>
	<th>Tindakan</th>
	</tr>
	</thead>
	<tbody>
		<?php
			$q = mysql_query("SELECT username,nama_lengkap,count(tbl_berkas.no_berkas) as berkas_diinput,tgl_daftar from tbl_user left join tbl_berkas ON tbl_berkas.user_id = tbl_user.username group by tbl_user.username");
			$i =  1;
			while ($isiTbl = mysql_fetch_array($q)) {
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$isiTbl['username']."</td>";
				echo "<td>".$isiTbl['nama_lengkap']."</td>";
				echo "<td>".number_format($isiTbl['berkas_diinput'])."</td>";
				echo "<td>".$isiTbl['tgl_daftar']."</td>";
				echo "<td><button value='".$isiTbl['username']."' onclick='konfirmasiHapus(this.value)' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button> | 
				<button value='".$isiTbl['username']."' onclick='gantiPassword(this.value)' class='btn btn-primary btn-xs'><span class='fa fa-pencil'></span> Edit</button>
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
	function validasiUser(){
		if($('#username').val() == '' || $('#password').val() == '' || $('#nama_lengkap').val() == '' ){
			tampilkanModal('Peringatan.','Formulir belum Lengkap','');
		}else{
			$('#alamat_url').attr('value',document.location.pathname);
			$('#formUser').submit();
		}
	}

	function hapus(id){
		$.ajax({
			type: "POST",
			url: 'php/modul/hapus_user.php',
			data: {
				"username":  id
			},
			success: function(data){
				if(data == "ok"){
					alert("User Dihapus");
				}else{
					alert("User Gagal Dihapus");
				}
				
				var alamat = document.location.href;
				document.location.href=alamat;
			}
		});

	}

	function konfirmasiHapus(id){
		var tombol_konfirmasi = "<button type='button' class='btn btn-danger' value='"+id+"' onclick='hapus(this.value)' data-dismiss='modal'>Yakin</button>\
		<button type='button' class='btn btn-primary' data-dismiss='modal'>Tidak</button>"
		tampilkanModal('Konfirmasi','Apakah anda yakin akan menghapus user ini?',tombol_konfirmasi);
	}
	
	function ok(ids){
		var password_baru =  $('#password_baru').val();
		$.ajax({
			type: "POST",
			url: "php/modul/ganti_password.php",
			data: {
				'password' : password_baru,
				'username' : ids
			},
			success: function(data){
				if(data == 'ok'){
					alert('berhasil');
				}else{
					alert('Gagal');
				}
			}
		});
	}

	function gantiPassword(id){
		
		var inputan = "<input type='text' id='password_baru' class='form-control'>";
		var tombol = "<button class='btn btn-primary' value='"+id+"' onclick='ok(this.value)' data-dismiss='modal'>Simpan</button>";
		tampilkanModal('Ganti Password',inputan,tombol);
	}

	if($('#msg').text() != ''){
	$('#msg').show();
	}
	setTimeout(function() {
		$('#msg').hide();
	}, 2000);
</script>
