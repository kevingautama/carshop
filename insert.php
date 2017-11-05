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
if(isset($_GET['action'])){
  if($_GET['action']=="true")
  {
    require_once('lib/nusoap.php');
    $client = new nusoap_client('http://localhost/carshop/server.php');
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
      $result = $client->call('insert', array('nama' => $nama,'merek' => $merek, 'harga' => $harga));
      if($result=="true")
      {
        header('Location:index.php');
      }
      else
      {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Warning!</h4>
  <p>Input failed.</p>
</div>';
      }
  }
}
?>
<form method="post" action="insert.php?action=true" class="form-horizontal">
  <fieldset>
    <legend>Insert Data</legend>
    <div class="form-group">
      <label class="col-lg-2 control-label">Nama</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="nama" placeholder="Nama Mobil" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Merek</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="merek" placeholder="Merek Mobil" required="">
      </div>
    </div>
   <div class="form-group">
      <label class="col-lg-2 control-label">Harga</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="harga" placeholder="Harga Mobil" required="">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="index.php" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>


</div>

</body>
</html>