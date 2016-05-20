<?php
$q = mysql_query("select distinct(no_rak) as no_rak from tbl_box");
$rowRak = mysql_num_rows($q);

$q = mysql_query("select no_box from tbl_box");
$rowBox = mysql_num_rows($q);
$tahun = date("Y");
$daluarsaMulai = $tahun-10;
$q = mysql_query("select no_berkas from tbl_berkas where tahun_berkas < $daluarsaMulai and jenis_berkas <> '25'");
$rowDal = mysql_num_rows($q);

$q = mysql_query("select id from tbl_peminjam");
$rowPinjam = mysql_num_rows($q);

?>
<div class="col-md-3">
<h4>Statistik Berkas</h4>
<p>Rak Total : <b><?php echo $rowRak; ?></b> Buah</p>
<p>Box Total : <b><?php echo number_format($rowBox); ?></b> Box</p>
<p>Berkas Kemungkinan Daluarsa : <a href="?mod=17"><b class='blink'><?php echo number_format($rowDal); ?></b></a></p>
<p>Berkas Dipinjam : <b><?php echo number_format($rowPinjam); ?></b></p>
</div>
<div class="col-md-9">
<h4>Berkas Tersimpan</h4>
<table class="table table-bordered">
	<tr>
	<th width="8%">No</th>
	<th>Jenis Berkas</th>
	<th>Jumlah Berkas Tersimpan</th>
	</tr>
	<?php
		$q = mysql_query("select jenis,jumlah from v_perjenis");
		$i = 1;
		$total = 0;
		while ($isiTbl = mysql_fetch_array($q)){
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$isiTbl['jenis']."</td>";
			echo "<td>".number_format($isiTbl['jumlah'])."</td>";
			echo "</tr>";
			$i++;
			$total = $total + $isiTbl['jumlah'];
		}
	?>
	<tr>
		<td colspan="2"><b>Total</b></td>
		<td><b><?php echo $total; ?></b></td>
	</tr>
</table>
<a href="?mod=18" class="btn btn-primary"><span class="fa fa-floppy-o"></span> Mulai Menyimpan Berkas</a>
</div>