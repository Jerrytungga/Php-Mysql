<?php
include "koneksi.php";
require_once 'theme/view.php';
if (!isset($_SESSION['Keterangan'])) {
	session_start();
}

?>


<style type="text/css">
	@media print {
	#print {display: none;}
}
	@page{
		margin:0px auto;
		size: auto;
	}
	.page{
		width: 7cm;
		height: auto;
		font-size: 10px;
	}
</style>
<?php

$tgl=date("d-m-Y");
$jam=date("H:i:s");
?>
<div class="page">
	<table width="100%" border="1">
	<tr>
		<td colspan="4" align="center">
			IT ENTHUSIAST<br>
			Alamat : JL.GURU NO 14, SURAKARTA<br>
			Telp : 081241935244<br>
		</td>
	</tr>
	<tr><td align="center" colspan="4"><?= $tgl ?></br><?= $jam ?><br></td></tr>
	<tr>
		<td width="20%">Name</td>
		<td align="center">Qty</td>
		<td width="20%">Price</td>
		<td>Ext Price</td>
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
		<td><?= $d['NAMA_BARANG'] ?></td>
		<td align="center"><?= $jum ?></td>
		<td>Rp <?= number_format($d['HARGA']) ?></td>
		<td>Rp <?= number_format($harga) ?></td>
	</tr>
	<?php
		if (isset($_POST['bayar'])) {
			bayare($koneksi,$d['NAMA_BARANG'],$d['HARGA'],$jum,$harga);
			} 
		} 
	} 
	?>
	<tr>
		<td colspan="2">Total Bayar : </td>
		<td colspan="2">Rp. <?= number_format($total) ?></td>
	</tr>
	<tr>
		<td colspan="2">Bayar       : </td>
		<td colspan="2">Rp. <?= $_SESSION['byr'] ?></td>
	</tr>
	<tr>
		<td colspan="2">Kembali     : </td>
		<td colspan="2">Rp. <?= $_SESSION['kembali'] ?></td>
	</tr>
	<tr>
		<td colspan="2">Nama Pembeli : </td>
		<td colspan="2"><?= $_SESSION['pembeli'] ?></td>
	</tr>
	<tr>
		<td colspan="2">Nama Kasir : </td>
		<td colspan="2"><?= $_SESSION['Keterangan'] ?></td>
	</tr>
	<tr>
		<td colspan="4" align="center">TERIMAKASIH</td>
	</tr>
</table>
</div>

<div id="print"><p>
	<input type="button" onclick="window.print()" value="PRINT">
	<form method="post">
		<input type="submit" name="bayar" value="Selesai">
	</form>
</div>