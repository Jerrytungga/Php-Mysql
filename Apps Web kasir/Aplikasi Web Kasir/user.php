<?php
include "koneksi.php";
require_once 'theme/view.php';
headere();

?>

<?php 
	
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['Keterangan']==""){
		header("index.php?pesan=gagal");
	}?>

<?php
//TABEL STOK BARANG PEMBELI
?>
	<table border="1">
  	 <tr>
    	<th colspan="5">MENU BARANG</th></tr>
	
		<tr><td>NO</td>
		<td>Nama Barang</td>
    	<td>Stok</td>
		<td>Harga Satuan</td>
    	<td>Aksi</td>
  	 </tr>

		<?php
		if (isset($_GET['carbar'])) {
			$carbar=$_GET['carbar'];
			$row=mysqli_query($koneksi,"SELECT * FROM barang WHERE NAMA_BARANG LIKE '%".$carbar."%'");
		}else{$row=mysqli_query($koneksi,"SELECT * FROM barang");}
		while ($d=mysqli_fetch_assoc($row)) {
		?>
		<tr>
			<td><?= $d['id_barang'] ?></td>
			<td><?= $d['NAMA_BARANG'] ?></td>
			<td><?= $d['JUMLAH'] ?></td>
			<td>Rp. <?= number_format($d['HARGA']) ?></td>
			<td><a href="user.php?ttl=add&id_barang=<?= $d['id_barang'] ?>"> Pilih </a></td>
		</tr>
		<?php } ?>
	</table>


<?php
//TABEL BARANG YANG DI BELI 
?>
<?php
if (isset($_GET['ttl'])) {
	$ttl=$_GET['ttl'];

	if ($ttl=='add') {
		if (isset($_GET['id_barang'])) {
			$id=$_GET['id_barang'];
			if (isset($_SESSION['barang'][$id])) {
				$_SESSION['barang'][$id]+=1;
			}else{$_SESSION['barang'][$id]=1;}
			header('location:user.php');
		}
	}

	

	elseif ($ttl=='min') {
		if (isset($_GET['id_barang'])) {
			$id=$_GET['id_barang'];
			if (isset($_SESSION['barang'][$id])) {
				$_SESSION['barang'][$id]-=1;
				if ($_SESSION['barang'][$id]==0) {
					unset($_SESSION['barang'][$id]);
				}
			}
		}
	}

	elseif ($ttl=='del') {
		if (isset($_GET['id_barang'])) {
			$id=$_GET['id_barang'];
			if (isset($_SESSION['barang'][$id])) {
				unset($_SESSION['barang'][$id]);
			}
		}
	}

	elseif ($ttl=='batal') {
		if (isset($_GET['id_barang'])) {
			$id=$_GET['id_barang'];
			if (isset($_SESSION['barang'][$id])) {
				unset($_SESSION['barang']);
			}
		}
	}
}
?>
<div class="konten">

	<table border="1">
  	 <tr>
    	<th colspan="6">KERANJANG BARANG</th></tr><tr>
		<td>ID</td>
		<td>Nama Barang</td>
        <td>Stok</td>
        <td>Harga Satuan</td>
        <td>Total</td>
		<th width="20%">OPSI</th>
		
		
  	 </tr>
	  
		<?php
		$total=0;
		if (isset($_SESSION['barang'])) {
			foreach ($_SESSION['barang'] as $key => $jum) {
				$query=mysqli_query($koneksi,"SELECT * FROM barang WHERE id_barang=$key");
				$d=mysqli_fetch_array($query);
				$harga=$d['HARGA']*$jum;
				$total+=$harga;
		?>
		<tr>
			<td><?= $d['KD_BARANG'] ?></td>
			<td><?= $d['NAMA_BARANG'] ?></td>
			<td><?= $jum ?></td>
			<td><?= number_format($d['HARGA']) ?></td>
			<td><?= $harga ?></td>
			<td align="center">
				<a href="user.php?ttl=add&id_barang=<?= $d['id_barang'] ?>" class="tmbl tombol">TAMBAH</a>
				<a href="user.php?ttl=min&id_barang=<?= $d['id_barang'] ?>" class="tmbl tombol">KURANG</a>
				<a href="user.php?ttl=del&id_barang=<?= $d['id_barang'] ?>" class="tmbl tombol">HAPUS</a>
			</td>
		</tr>
		<?php 
			} 
		} 
		?>
	</table>
	
	<?php
	if ($total != 0) {
	?>
	<P>
	<?php
	if (isset($_POST['cetak'])) {
		$pembeli=$_POST['pembeli'];
		$byr=$_POST['byr'];
		$kembali=$byr-$total;
		if ((trim($pembeli))&&(trim($byr))) {
			$_SESSION['pembeli']=$pembeli;
			$_SESSION['byr']=$byr;
			$_SESSION['kembali']=$kembali;
			header('location:cetak.php');
		}else echo "Lengkapi Data !!!";
	}
	?>
	<form method="post">
		<table border="1">
		
		<tr><td colspan="2"> <h3><p align="center">	ISI DATA ANDA !!</h3></td> </tr>
			<tr><td width="200px">Nama Pembeli</td><td> 
			<input type="text" name="pembeli"></td></tr>
			<tr><td>Bayar</td><td><input type="number" name="byr"></td></tr>
			<tr>
				<td colspan="2">
				<h3> Total Bayar : Rp. <?= number_format($total) ?><br></h3>
					<input type="submit" name="cetak" value="BAYAR" class="tmbl tombol">
					<a href="user.php?ttl=batal&id_barang=<?= $d['id_barang'] ?>" class="tmbl tombol">BATAL</a>
				</td>


				
			</tr>
			
		</table>
	</form>
	<?php } ?>
</div>




