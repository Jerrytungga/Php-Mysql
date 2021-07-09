<?php
include "koneksi.php";
?>
	<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['Keterangan']==""){
		header("index.php?pesan=gagal");
	}?>
	
<?php
#Code Untuk Menambahkan Data
if(isset($_POST['tambah'])){
	mysqli_query($koneksi," insert into merek set
	Id = '$_POST[id]',
	Nama_Merek = '$_POST[nama]'");
}

#Code Untuk menghapus Data
if(isset($_POST['hapus'])){
	$query = "DELETE FROM merek  WHERE IM ='".$_POST['id']."'"; // query hapus data
	if(mysqli_query($koneksi, $query)){
		
	}else{
		echo "Hapus data gagal";
	}
}
?>

<div class="col-md-12">
<h1>KASIR</h1>
<h1 style="color:Tomato;">HARAP DI ISI DENGAN BENAR !</h1>
<a href="logout.php">Logout</a> |
<a href="halaman_admin.php">Beranda</a> |
<a href="merek.php">Tambah Merek</a> |
<a href="riwayat.php">Riwayat Pembeli</a> |
<a href="barang_log.php">Riwayat Admin</a> |
</div>
	
<form action="merek.php" method="POST" name="form">
<br><table>
<tr><td>Id Merek </td><td>: <input type="text" name="id"></td></tr>
<tr><td>Nama Merek </td><td>: <input type="text" name="nama"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="Tambah">
</table></form>

<?php
//code untuk menampilkan data dari database
print "</table>";
echo "<p><p>";
print "<table  border='1'>
<tr >
<th>No</th>
<th>Id</th>
<th>Nama Merek </th>
<th>Aksi</th>
</tr>";
$query=mysqli_query($koneksi,"SELECT * FROM merek ORDER BY Id DESC");
while($data=mysqli_fetch_array($query)){
//mengisi data Tabel
$num=$data['IM'];
$id=$data['Id'];
$nama=$data['Nama_Merek'];
print "<form action='merek.php' method='POST' name='form'><tr>
<td><input type='hidden' name='id' value='$num'>".$num."</td>
<td>".$id."</td>
<td>".$nama."</td>
<td><input type='submit' name='hapus' value='Hapus'></td></form>
</tr>";
}echo "</p></table>";
?>