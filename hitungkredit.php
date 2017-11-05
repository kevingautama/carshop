<!DOCTYPE html>
<html>
<head>
	<title>Carshop</title>
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="style/jquery-ui.min.css">
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<!-- <link rel="stylesheet" href="style/jquery.dataTables.min.css"> -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="style/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script>
		$(document).ready(function(){
    		$('#table').DataTable();
		});
	</script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CARSHOP</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">  
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <?php
    require_once('lib/nusoap.php');
    $client = new nusoap_client('http://localhost/carshop/server.php');
    if(isset($_GET['id'])){
      $key = $_GET['id'];
    }
    $resultbyid = $client->call('get', array('key' => $key));
  ?>
	<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Informasi Kredit</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="hitungkreditpost.php" class="form-horizontal">
    <div class="form-group">
      <label class="col-lg-2 control-label">Nama</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $resultbyid[0]['nama'] ?></b>
        <input type="hidden" name="nama" value="<?php echo $resultbyid[0]['nama'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Merek</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $resultbyid[0]['merek'] ?></b>
        <input type="hidden" name="merek" value="<?php echo $resultbyid[0]['merek'] ?>">
      </div>
    </div>
   <div class="form-group">
      <label class="col-lg-2 control-label">Harga</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($resultbyid[0]['harga']) ?></b>
        <input type="hidden" name="harga" value="<?php echo $resultbyid[0]['harga'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Tenor</label>
      <div class="col-lg-10">
        <input type="text" required="true" class="form-control" name="tenor" placeholder="Jangka Waktu Dalam Tahun">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Bunga Pinjaman</label>
      <div class="col-lg-10">
        <input type="text" required="true" class="form-control" name="bunga" placeholder="Bunga dalam %/tahun">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Uang Muka</label>
      <div class="col-lg-10">
        <input type="text" required="true" class="form-control" name="dp" placeholder="DP dalam % dari harga mobil">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Perhitungan Bunga</label>
      <div class="col-lg-10">
        <select class="form-control" name="tipebunga">
          <option value="flat">Flat</option>
          <option value="efektif">Efektif</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="index.php" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Kalkulasi</button>
      </div>
    </div>
</form>
  </div>
</div>
</div>


</body>
</html>