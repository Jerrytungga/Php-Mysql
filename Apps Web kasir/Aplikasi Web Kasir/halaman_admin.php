<?php
include "koneksi.php";
?>
	<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['Keterangan']==""){
		header("index.php?pesan=gagal");
	}?>

<div class="col-md-12">
<h1>KASIR</h1>
<p>Hai <?=$_SESSION['Keterangan']?> Selamat Datang </p>
<h3 style="color:Tomato;">Sebelum menambahkan barang diharapkan tambahkan MEREK terlebih dahulu!! </h3>
<a href="logout.php">Logout</a> |
<a href="halaman_admin.php">Beranda</a> |
<a href="merek.php">Tambah Merek</a> |
<a href="riwayat.php">Riwayat Pembeli</a> |
<a href="barang_log.php">Riwayat Admin</a> |
</div>


<?php


#Code Untuk Menambahkan Data
if(isset($_POST['tambah'])){
	mysqli_query($koneksi," set @u='".$_SESSION['Keterangan']."' ");
	mysqli_query($koneksi," insert into barang set
	KD_BARANG = '$_POST[kode]',
	NAMA_BARANG = '$_POST[nama]',
	MEREK = '$_POST[merek]',
	JENIS = '$_POST[jenis]',
	UKURAN = '$_POST[ukuran]',
	JUMLAH = '$_POST[jumlah]',
	HARGA = '$_POST[harga]'");
}


if(isset($_POST['update'])){
	mysqli_query($koneksi," set @u='".$_SESSION['Keterangan']."' ");
	$query = "UPDATE `barang` SET `id_barang`='".$_POST['id']."',
	`KD_BARANG`='".$_POST['kode']."',
	`NAMA_BARANG`='".$_POST['nama']."',
	`MEREK`='".$_POST['merek']."',
	`JENIS`='".$_POST['jenis']."',
	`UKURAN`='".$_POST['ukuran']."',
	`JUMLAH`='".$_POST['jumlah']."',
	`HARGA`='".$_POST['harga']."'
	WHERE `id_barang`='".$_POST['id']."'
	"; // query hapus data
	if(mysqli_query($koneksi, $query)){
		
	}else{
		echo "Update data gagal";
	}
}
#Code Untuk menghapus Data
if(isset($_POST['hapus'])){
	mysqli_query($koneksi," set @u='".$_SESSION['Keterangan']."' ");
	$query = "DELETE FROM barang  WHERE id_barang='".$_POST['id']."'"; // query hapus data
	if(mysqli_query($koneksi, $query)){
		
	}else{
		echo "Hapus data gagal";
	}
}



#Code Untuk Mengedit
if(isset($_POST['edit'])){ 
	$query=mysqli_query($koneksi, "SELECT * FROM barang where id_barang='".$_POST['id']."'");
	$data=mysqli_fetch_array($query);
	//mengisi data babel
	$id=$data['id_barang'];
	$nama=$data['NAMA_BARANG'];
	$harga=$data['HARGA'];
	$jumlah=$data['JUMLAH'];
	$kode=$data['KD_BARANG'];
	$merek=$data['MEREK'];
	$jenis=$data['JENIS'];
	$ukuran=$data['UKURAN'];
	$time=$data['Waktu'];
?>

<form action="halaman_admin.php" method="POST" name="formedit">
<br><table>
<tr><td>Kode Barang</td><td>: <input type="text" name="kode" value='<?php echo $kode; ?>'></td></tr>
<tr><td>Nama Barang </td><td>: <input type="text" name="nama" value='<?php echo $nama; ?>'></td></tr>
<tr><td>Harga Satuan</td><td>: <input type="text" name="harga" value='<?php echo $harga; ?>'></td></tr>
<tr><td>Jumlah Barang</td><td>: <input type="text" name="jumlah" value='<?php echo $jumlah; ?>'></td></tr>
<tr><td>Merek Barang</td><td>: <select name="merek" value='<?php echo $merek; ?>'> <option value=""><------Silahkan Pilih------></option>
  <?php
   //Perintah sql untuk menampilkan semua data pada tabel jurusan
    $sql="select * from merek";

    $hasil=mysqli_query($koneksi,$sql);
    $no=0;
    while ($data = mysqli_fetch_array($hasil)) {
    $no++;
   ?>
    <option value="<?php echo $data['Nama_Merek'];?>"><?php echo $data['Nama_Merek'];?></option>
  <?php 
	}
  ?>
</select></td></tr>
<tr><td>Jenis Barang</td><td>: <select name="jenis" value='<?php echo $jenis; ?>'> 
<option value=""><------Silahkan Pilih------></option>
<option>Makanan</option>
<option>Minuman</option> 
<option>Peralatan</option> 
<option>Alat Tulis</option> 
<option>Speapart</option> 
</select></td></tr>
<tr><td>Ukuran</td><td>: <input type="text" name="ukuran" value='<?php echo $ukuran; ?>'></td></tr>
</td></tr>
<tr><td></td><td><input type="submit" name="update" value="Edit Barang">
</table>

<?php } 
else {?>
<P>
<form action="halaman_admin.php" method="POST" name="form">
<br><table>
<tr><td>Kode Barang</td><td>: <input type="text" name="kode"></td></tr>
<tr><td>Nama Barang </td><td>: <input type="text" name="nama"></td></tr>
<tr><td>Harga Satuan</td><td>: <input type="text" name="harga"></td></tr>
<tr><td>Jumlah Barang</td><td>: <input type="text" name="jumlah"></td></tr>
<tr><td>Merek Barang</td><td>: <select name="merek"> <option value=""><------Silahkan Pilih------></option>
  <?php
   //Perintah sql untuk menampilkan semua data pada tabel jurusan
    $sql="select * from merek";

    $hasil=mysqli_query($koneksi,$sql);
    $no=0;
    while ($data = mysqli_fetch_array($hasil)) {
    $no++;
   ?>
    <option value="<?php echo $data['Nama_Merek'];?>"><?php echo $data['Nama_Merek'];?></option>
  <?php 
	}
  ?>
</select></td></tr>
<tr><td>Jenis Barang</td><td>: <select name="jenis"> 
<option value=""><------Silahkan Pilih------></option>
<option>Makanan</option>
<option>Minuman</option> 
<option>Peralatan</option> 
<option>Alat Tulis</option> 
<option>Speapart</option> 
</select></td></tr>
<tr><td>Ukuran</td><td>: <input type="text" name="ukuran"></td></tr>
</td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="Tambah Barang">
</table></form>


<?php } ?>

<?php
//code untuk menampilkan data dari database
print "</table>";
echo "<p><p>";
print "<table  border='1'>
<tr >
<th>No</th>
<th>Nama Barang </th>
<th>Harga Satuan</th>
<th>Jumlah </th>
<th>Kode Barang</th>
<th>Merek</th>
<th>Jenis</th>
<th>Ukuran</th>
<th>Waktu</th>
<th>Aksi</th>
</tr>";
$query=mysqli_query($koneksi,"SELECT * FROM barang ORDER BY id_barang DESC");
while($data=mysqli_fetch_array($query)){
//mengisi data Tabel
$id=$data['id_barang'];
$nama=$data['NAMA_BARANG'];
$harga=$data['HARGA'];
$jumlah=$data['JUMLAH'];
$kode=$data['KD_BARANG'];
$merek=$data['MEREK'];
$jenis=$data['JENIS'];
$ukuran=$data['UKURAN'];
$time=$data['Waktu'];
	print "<form action='halaman_admin.php' method='POST' name='form'><tr>
<td><input type='hidden' name='id' value='$id'>".$id."</td>
<td>".$nama."</td>
<td>".$harga."</td>
<td>".$jumlah."</td>
<td>".$kode."</td>
<td>".$merek."</td>
<td>".$jenis."</td>
<td>".$ukuran."</td>
<td>".$time."</td>
<td> <input type='submit' name='edit' value='EditData'> <input type='submit' name='hapus' value='Hapus Data'></td></form>
</tr>";
}echo "</p></table>";
?>



