<?php
include "koneksi.php";
require_once 'theme/view.php';

?>
<div class="konten">
	<h3>TOTAL BELANJA</h3>
	<table width="100%">
		<tr><th>NAMA BARANG</th><th>JUMLAH</th><th>HARGA</th><th>TOTAL</th></tr>
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
			<td><?= $jum ?></td>
			<td><?= number_format($d['HARGA']) ?></td>
			<td><?= $harga ?></td>
		</tr>
		<?php 
			} 
		} ?>
	</table>
	Total Bayar : Rp. <?= number_format($total) ?><br>
	<?php
	echo 'Bayar : <?= $byr ?><br>
	Kembali : <?= $kembali ?><br>
	Pembeli : <?= $pembeli ?><br>';
	?>
</div>