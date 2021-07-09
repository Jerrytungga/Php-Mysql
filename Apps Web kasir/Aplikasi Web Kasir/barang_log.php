

<h1><p align="center">
Tabel Riwayat Barang<br>
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
	$query = "DELETE FROM barang_log  WHERE id_log='".$_POST['kode']."'"; // query hapus data
	if(mysqli_query($koneksi, $query)){	
	}else{
		echo "Hapus data gagal";
	}
}
?>
	


<table  align="center" border='1'>
<tr >
<th>No </th>
<th>ID BARANG </th>
<th>NAMA BARANG</th>
<th>JUMLAH BARANG</th>
<th>KETERANGAN Barang</th>
<th>PENGGUNA</th>
<th>WAKTU</th>
<th>Aksi</th>
</tr>


<?php
//code untuk menampilkan data dari database
$query=mysqli_query($koneksi, "SELECT * FROM barang_log ");
while($data=mysqli_fetch_array($query)){
//menampilkan data kota_log dari database
$idlog=$data['id_log'];
$idbarang=$data['ID_BARANG'];
$nama_brng=$data['Nama_barang'];
$jumlah=$data['JUMLAH'];
$ket=$data['Keterangan'];
$pengguna=$data['Pengguna'];
$waktu=$data['Waktu'];

	print "<form action='barang_log.php' method='POST' name='form'><tr>
<td><input type='hidden' name='kode' value='$idlog'>".$idlog."</td>
<td>".$idbarang."</td>
<td>".$nama_brng."</td>
<td>".$jumlah."</td>
<td>".$ket."</td>
<td>".$pengguna."</td>
<td>".$waktu."</td>
<td> <input type='submit' name='hapus' value='Hapus Data'></td></form>

</form>
</tr>";
}

?>



