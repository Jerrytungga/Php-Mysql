<?php
session_start();
//jika tidak ada username yang disimpan maka kembali ke halaman login
if(!isset($_SESSION['username'])){
	header("location:login.php");
}
?>
