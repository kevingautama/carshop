<?php
	require_once('lib/nusoap.php');
	require_once('dbconfig.php');
	$server = new soap_server;
	$server->register('get');
	$server->register('insert');
	$server->register('hitungkredit');
	$server->register('update');
	$server->register('delete');

	function get($key){
		$query = 'select * from car';
		$hasil = mysql_query($query);
		while($data = mysql_fetch_array($hasil)){
			$result[] = array('id' => $data['id'],'nama' => $data['nama'],'merek' => $data['merek'], 'harga' => $data['harga']);
		}
		return $result;
	}

	function insert($nama,$merek,$harga){
		$query = "insert into car values ('','".$nama."','".$merek."','".$harga."')";
		$hasil = mysql_query($query);
		
		if ($hasil) { 
			return 'true';

		 }
		 else{
		 	return 'false';
		 }
	}

	function update($id,$nama,$merek,$harga){
		$query = "UPDATE car SET nama='".$nama."', merek='".$merek."', harga='".$harga."' WHERE id='".$id."'";
		$hasil = mysql_query($query);
		
		if ($hasil) { 
			return 'true';

		 }
		 else{
		 	return 'false';
		 }
		}

	function delete($id)
		{
		$query = "DELETE FROM car WHERE id ='$id'";
		$hasil = mysql_query($query);
		if ($hasil) { 
			return 'true';

		 }
		 else{
		 	return 'false';
		 }		
		}


	function hitungkredit($harga,$tenor,$bunga,$dp){
		$dpnominal=$dp*$harga/100;
		$tenorbulan=$tenor*12;
		$bungabulan=$bunga/12;
		$jumlahpinjaman=$harga-$dpnominal;
		$angsuranpokok=$jumlahpinjaman/$tenorbulan;
		$angsuranbunga=$jumlahpinjaman*$bunga/100/12;
		$totalangsuran=$angsuranpokok+$angsuranbunga;
		$angsuranpertama=$dpnominal+$totalangsuran;
		$tmpjumlahpinjaman=$jumlahpinjaman;
		$tabelangsuran[]=array();

		for ($i = 0; $i <= $tenorbulan; $i++) {
			if(($i)==0){
				$angsur=array('bulan'=>$i,'angsuran_bunga'=>'0','angsuran_pokok'=>'0','total_angsuran'=>'0','sisa_pinjaman'=>$tmpjumlahpinjaman);
			}
			else{
				$angsur=array('bulan'=>$i,'angsuran_bunga'=>$angsuranbunga,'angsuran_pokok'=>$angsuranpokok,'total_angsuran'=>$totalangsuran,'sisa_pinjaman'=>$tmpjumlahpinjaman);
			}
			if($i==0){
				array_pop($tabelangsuran);
			}
			array_push($tabelangsuran, $angsur);
			$tmpjumlahpinjaman=$tmpjumlahpinjaman-$angsuranpokok;
			
			
		}
		$result[]=array('dpnominal' => $dpnominal,'tenorbulan' => $tenorbulan, 'bungabulan' => $bungabulan, 'jumlahpinjaman' => $jumlahpinjaman, 'angsuranpokok' => $angsuranpokok, 'angsuranbunga' => $angsuranbunga, 'totalangsuran' => $totalangsuran, 'angsuranpertama' => $angsuranpertama, 'tabelangsuran'=> $tabelangsuran);
		return $result;
	}



	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>