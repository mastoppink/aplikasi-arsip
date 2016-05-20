<div class="col-md-12">
  <div class="menu col-md-10">
      <a href="?mod=16&sm=13" class="btn btn-default">
      <i class="fa fa-user"></i> User</a>            
      <a href="?mod=16&sm=14" class="btn btn-default">
      <i class="fa fa-floppy-o"></i> Rak</a>
      <a href="?mod=16&sm=15" class="btn btn-default">
      <i class="fa fa-file"></i> Jenis Berkas</a>
      <a href="?mod=16&sm=19" class="btn btn-default">
      <i class="fa fa-trash"></i> Hapus Berkas(NPWP)</a>
      <a href="?mod=16&sm=20" class="btn btn-default">
      <i class="fa fa-trash"></i> Hapus Berkas(Box)</a>
  </div>
</div>
&nbsp
<div class="col-md-12">
   <?php
        if(isset($_GET['sm'])){
          $sm = $_GET['sm'];
          $q = mysql_query("select link from tbl_modul where id = '".$sm."' limit 1");
          $row = mysql_num_rows($q);
          $isiTabel = mysql_fetch_array($q);
          if($row == 1){
            include $isiTabel['link'];
            }else{
            echo "<strong>HALAMAN TIDAK DITEMUKAN.</strong>";
            }
        }else
        {
          include "php/modul/isi_user.php";
        }
    ?>
</div>
         