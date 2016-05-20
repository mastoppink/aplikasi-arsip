<?php
include "php/cek_sesi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DocsMate</title>
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/muji.css" />
<!--Load JS -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery-datatables.min.js"></script>
<script src="assets/js/datatables-bootstrap.min.js"></script>
</head>

<body>
  <div class="col-md-12 wrap">
      <div class="col-md-12">
          <div class="menu col-md-10">
              <a href="?mod=10" class="btn btn-default">
              <i class="fa fa-home"></i> Home</a>            
              <a href="?mod=18" class="btn btn-primary">
              <i class="fa fa-floppy-o"></i> Masukan Berkas</a>
              <a href="?mod=11" class="btn btn-info">
              <i class="fa fa-eye"></i> Peminjaman</a>
              <a href="?mod=12" class="btn btn-danger">
              <i class="fa fa-search"></i> Arsip Berkas</a>
              
              <?php
              if($_SESSION['admin']==1){
                echo "<a href='?mod=16' class='btn btn-warning'>";
                echo "<i class='fa fa-gear'></i> Alat</a>";
              }
              ?>
          </div>
          <div class="info col-md-2">
            <p><?php echo $_SESSION['nama_lengkap']; ?>, <a href="logout.php">Log Out</a></p>
          </div>
        </div>

