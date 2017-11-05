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
<div class="row">
	<a href="insert.php" class="btn btn-primary">Add New</a>
</div>
<br>
<div class="row">
<table id="table" class="table table-bordered table-hover">
<thead>
	<tr><th>Nama</th><th>Merek</th><th>Harga</th><th>Action</th></tr>
</thead>
<tbody>
	<?php
	require_once('dbconfig.php');
	require_once('lib/nusoap.php');
	$client = new nusoap_client('http://localhost/carshop/server.php');
	$key = '';
	$result = $client->call('get', array('key' => $key));
      if (is_array($result))
        {
          foreach($result as $data)
          {
            echo "<tr><td>".$data['nama']."</td><td>".$data['merek']."</td><td>Rp ".number_format($data['harga'])."</td>
            <td><a href='hitungkredit.php?nama=".$data['nama']."&harga=".$data['harga']."&merek=".$data['merek']."' class='btn btn-primary btn-sm'>Kredit</a>
            &nbsp;
            <a href='update.php?id=".$data['id']."&nama=".$data['nama']."&harga=".$data['harga']."&merek=".$data['merek']."' class='btn btn-primary btn-sm'>Edit</a>
            &nbsp;
            <a href='index.php?op=delete&id=$data[id]' class='btn btn-primary btn-sm'>Delete</a></tr>";
          } 
        }
 if (isset($_GET['op']))
     {
      if ($_GET['op'] == 'delete')
          {
            $id=$_GET['id'];  
            require_once('lib/nusoap.php');
            $client = new nusoap_client('http://localhost/carshop/server.php');
            $result = $client->call('delete', array('id' => $id));
          }
  }
?>
</tbody>
</table>
</div>
</div>
</body>
</html>