<?php
include "../config.php";
$q = mysql_query("select no_berkas, jenis_berkas,npwp,tahun_berkas,nama_wp from tbl_berkas where no_berkas='".$_POST['no_berkas']."'");
$isiTbl = mysql_fetch_array($q);
?>
<form id="formEditBerkas" method="POST" action="php/modul/edit_berkas.php">
<label for='no_berkas'>Nomor Berkas</label>
<input type='text' id='no_berkas' value='<?php echo $isiTbl['no_berkas'];?>' name='no_berkas' class='form-control'>
<label for='jenis_berkas'>Jenis Berkas</label>
<select type='text' id='jenis_berkas' name='jenis_berkas' class='form-control'>
	<option value="">Pilih Jenis Berkas</option>
		<?php
		$q2 = mysql_query("SELECT id, nama_jenis from tbl_jenis");
		while($isiTbl2 = mysql_fetch_array($q2)) {
			echo "<option value='".$isiTbl2['id']."' ";
			if($isiTbl2['id']==$isiTbl['jenis_berkas']){
				echo "selected='true'>".$isiTbl2['nama_jenis']."</option>";
			}else{
			echo">".$isiTbl2['nama_jenis']."</option>";
			}
		}
		?>
</select>
<label for='npwp'>Npwp</label>
<input type='text' id='npwp' name='npwp' value='<?php echo $isiTbl['npwp'];?>' class='form-control'>
<label for='nama_wp'>Nama WP</label>
<input type='text' id='nama_wp' name='nama_wp' value='<?php echo $isiTbl['nama_wp'];?>' class='form-control'>
<label for='tahun_berkas'>Tahun Berkas</label>
<input type='text' id='tahun_berkas' name='tahun_berkas' value='<?php echo $isiTbl['tahun_berkas'];?>' class='form-control'>
<br \>
<input type="hidden" value="" name="alamat_url" id='alamat_url'>
<input type="hidden" value="<?php echo $isiTbl['no_berkas'];?>" name="no_lama" id='no_lama'>
<button type="button" id='tombol_submit' class="btn btn-primary" data-dismiss='modal' onclick="prosesEdit()">Update</button>
</form>