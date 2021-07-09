<?php
include "koneksi.php";
require_once 'fungsi.php';
session_start();
?>
<?php function headere(){ ?>

<html>
<head>
	<title></title>
</head>

<body>
<p align="center">

Halo, selamat datang <b> <?php echo $_SESSION['username']; ?> </b> <br>
Silahkan <a href="logout.php"> <b> Logout </b> </a> untuk keluar dari aplikasi

</p>
<div class="col-md-12">
<h1>Halaman Kasir </h1>


</div><p>

<?php } ?>

<?php function footere() {?>

</body>
</html>
<?php } ?>