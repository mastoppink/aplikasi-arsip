
<?php
require_once "php/cek_sesi.php";
?>
<div class="col-md-12">
  <div class="col-md-12">
    <h2 id="tabTitle"><small>Aplikasi Manajemen Berkas</small></h2>
  <hr />
  </div>
  <div class="right col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">KPP Pratama Tasikmalaya</h3>
      </div>
      <div class="panel-body" id="rightContent">
        <?php
        if(isset($_GET['mod'])){
          $modul = $_GET['mod'];
          $q = mysql_query("select link from tbl_modul where id = '".$modul."' limit 1");
          $row = mysql_num_rows($q);
          $isiTabel = mysql_fetch_array($q);
          if($row == 1){
            include $isiTabel['link'];
            }else{
            echo "<strong>HALAMAN TIDAK DITEMUKAN.</strong>";
            }
        }else
        {
          include "php/modul/home.php";
        }
        ?>
      </div>
    </div>
  </div>
