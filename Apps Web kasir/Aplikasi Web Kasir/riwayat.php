

<h1><p align="center">
Tabel Riwayat Pembeli<br>
</p></h1>
<p align="center">
Silahkan Kembali Ke Menu <a href="halaman_admin.php"> <b> ADMIN </b> </a> Untuk Keluar Dari Halaman Riwayat
</p>



<?php
include "koneksi.php";
?>
	<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['Keterangan']==""){
		header("index.php?pesan=gagal");
	}
    ?>

<?php
#Code Untuk menghapus Data
if(isset($_POST['hapus'])){
	mysqli_query($koneksi," set @u='".$_SESSION['Keterangan']."' ");
	$query = "DELETE FROM pembelian  WHERE id='".$_POST['kode']."'"; // query hapus data
	if(mysqli_query($koneksi, $query)){	
	}else{
		echo "Hapus data gagal";
	}
}
?>
	


<table  align="center" border='1'>
<tr >
<th>No </th>
<th>NAMA BARANG</th>
<th>HARGA SATUAN</th>
<th>JUMLAH BARANG</th>
<th>TOTAL HARGA</th>
<th>NAMA PEMBELI</th>
<th>WAKTU</th>
<th>Aksi</th>
</tr>


<?php
//code untuk menampilkan data dari database
$query=mysqli_query($koneksi, "SELECT * FROM pembelian ");
while($data=mysqli_fetch_array($query)){
//menampilkan data kota_log dari database
$idlog=$data['id'];
$nama_brng=$data['Nama_Produk'];
$harga=$data['Harga_Satuan'];
$jumlah=$data['Jumlah'];
$hargattl=$data['Harga_total'];
$pengguna=$data['pembeli'];
$waktu=$data['tanggal'];

	print "<form action='riwayat.php' method='POST' name='form'><tr>
<td><input type='hidden' name='kode' value='$idlog'>".$idlog."</td>
<td>".$nama_brng."</td>
<td>".$harga."</td>
<td>".$jumlah."</td>
<td>".$hargattl."</td>
<td>".$pengguna."</td>
<td>".$waktu."</td>
<td> <input type='submit' name='hapus' value='Hapus Data'></td></form>

</form>
</tr>";
}

?>



