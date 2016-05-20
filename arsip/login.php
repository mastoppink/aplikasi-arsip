<?php
require_once("php/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log In | Aplikasi Manajemen Berkas</title>
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/muji.css" />
<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

</head>

<body>
  <div class="col-md-4 col-md-offset-4 loginBox">
  	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Log In</h3>
      </div>
      <div class="panel-body">       
        <div class="col-md-12">
          <form method="post" action="php/modul/proses_login.php">
              <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="nip" name="username" class="form-control" aria-describedby="keyLogo" placeholder="Username"/>
                    <span class="input-group-addon" id="keyLogo"><i class="fa fa-user"></i></span>
                  </div>
                 
              </div>
              <div class="form-group">
                  <div class="input-group">
                  <input type="password" id="pass" class="form-control" name="password" placeholder="Password" />
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
              	  </div>
                  
              </div>
              <p class="text-danger" id="msg">
              <?php
              if(isset($_GET['m'])){
              	$q = mysql_query("select isi from tbl_msg where id='".$_GET['m']."'");
              	$isi = mysql_fetch_array($q);
              	echo $isi['isi'];
              }
              ?>
              </p>
              <input type="submit" class="btn btn-default" id="tombol" value="Log In" />
          </form>
      	</div>
      </div>
    </div>
  </div> <!--Header End -->
<!--Load JS -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function() {
			$('#msg').hide();
		}, 4000);
	});
</script>
</body>
</html>