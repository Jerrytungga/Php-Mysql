<?php
include "koneksi.php";
function barang(){
	$query = "SELECT * FROM barang ORDER BY id_barang DESC";
	return result($query);
}

function bayare($koneksi,$Nama_Produk,$Harga_satuan,$jum,$Harga_total){
	if (isset($_POST['bayar'])) {
		$pembeli=$_SESSION['pembeli'];
		$barang=$_SESSION['barang'];
		$sql="INSERT INTO pembelian(Nama_Produk,Harga_satuan,Jumlah,Harga_total,pembeli) VALUES ('$Nama_Produk','$Harga_satuan','$jum','$Harga_total','$pembeli')";
		$result=$koneksi->query($sql);
		unset($_SESSION['barang']);
		unset($_SESSION['pembeli']);
		header('location:user.php');
	}
}

function result($query){
	global $koneksi;
	if($result = mysqli_query($koneksi,$query)){
		return $result;
	}else{
		mysqli_error($koneksi);
	}
}

?>