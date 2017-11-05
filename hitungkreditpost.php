<!DOCTYPE html>
<html>
<head>
	<title>Carshop</title>
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="style/jquery-ui.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
<?php
    require_once('lib/nusoap.php');
    $client = new nusoap_client('http://localhost/carshop/server.php');
    $harga = $_POST['harga'];
    $tenor = $_POST['tenor'];
    $bunga = $_POST['bunga'];
    $dp = $_POST['dp'];
    $tipebunga = $_POST['tipebunga'];
    $result = $client->call('hitungkredit', array('harga' => $harga,'tenor' => $tenor, 'bunga' => $bunga, 'dp' => $dp,'tipebunga' => $tipebunga));
  
?>
<div class="container">
	<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Informasi Kredit</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="hitungkreditpost.php" class="form-horizontal">
    <div class="form-group">
      <label class="col-lg-2 control-label">Nama</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $_POST['nama'] ?></b>
        <input type="hidden" name="nama" value="<?php echo $_POST['nama'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Merek</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $_POST['merek'] ?></b>
        <input type="hidden" name="merek" value="<?php echo $_POST['merek'] ?>">
      </div>
    </div>
   <div class="form-group">
      <label class="col-lg-2 control-label">Harga</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($_POST['harga']) ?></b>
        <input type="hidden" name="harga" value="<?php echo $_POST['harga'] ?>">
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

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Informasi Pinjaman Anda</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class="col-lg-2 control-label">Harga Mobil OTR</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($_POST['harga']) ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Uang Muka (DP)</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['dpnominal']) ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Tenor</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $result[0]['tenorbulan']." Bulan" ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Bunga</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo $result[0]['bungabulan']." %" ?></b>
      </div>
    </div>   
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Plafon Pinjaman Anda</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class="col-lg-2 control-label">Harga Mobil OTR</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($_POST['harga']) ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Uang Muka (DP)</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['dpnominal']) ?></b>
      </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">-</label>
      <div class="col-lg-10"><hr></div>     
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Plafon Pinjaman Anda</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['jumlahpinjaman']) ?></b>
      </div>
    </div>   
  </div>
</div>
</div>

<?php 
  if($_POST['tipebunga'] == 'flat'){
    echo '<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Angsuran per Bulan</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class="col-lg-2 control-label">Angsuran Pokok/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['angsuranpokok']).'</b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Angsuran Bunga/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['angsuranbunga']).'</b>
      </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">+</label>
      <div class="col-lg-10"><hr></div>     
    </div>      
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Total Angsuran/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['totalangsuran']).'</b>
      </div>
    </div>   
  </div>
</div><div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Angsuran per Bulan</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class="col-lg-2 control-label">Angsuran Pokok/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['angsuranpokok']).'</b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Angsuran Bunga/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['angsuranbunga']).'</b>
      </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">+</label>
      <div class="col-lg-10"><hr></div>     
    </div>      
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Total Angsuran/bulan</label>
      <div class="col-lg-10">
        <b class="form-control"> Rp '.number_format($result[0]['totalangsuran']).'</b>
      </div>
    </div>   
  </div>
</div>';
  }
?>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Pembayaran Pertama Kali</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class="col-lg-2 control-label">Uang Muka (DP)</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['dpnominal']) ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Angsuran Pertama  </label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['totalangsuran']) ?></b>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">+</label>
      <div class="col-lg-10"><hr></div>     
    </div>    
    <div class="form-group">
      <label class="col-lg-2 control-label">Total Pembayaran Pertama</label>
      <div class="col-lg-10">
        <b class="form-control"><?php echo "Rp ".number_format($result[0]['angsuranpertama']) ?></b>
      </div>
    </div>   
  </div>
</div>

<table class="table table-bordered table-hover table-striped">
<thead>
<th>Bulan</th><th>Angsuran Bunga (Rp)</th><th>Angsuran Pokok (Rp)</th><th>Total Angsuran (Rp)</th><th>Sisa pinjaman (Rp)</th>
</thead>
<tbody>
<?php
  foreach($result[0]['tabelangsuran'] as $data)
  {
    echo "<tr><td>".$data['bulan']."</td><td>".number_format($data['angsuran_bunga'])."</td><td>".number_format($data['angsuran_pokok'])."</td><td>".number_format($data['total_angsuran'])."</td><td>".number_format($data['sisa_pinjaman'])."</td></tr>";
  }
?>
</tbody>
</table>
<?php


?>

</body>
</html>