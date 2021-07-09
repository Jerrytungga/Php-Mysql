<form action="" method="POST">
<table align="center">
<link rel="stylesheet" type="text/css" href="style.css">

<tr>

	<th colspan="2" height="40">FORM PENDAFTARAN</th>
</tr>


<tr>
	<td> Nama Lengkap </td>
	<td> <input type="text" name="namalengkap"> </td>
</tr>

<tr>
	<td width="100"> Username </td>
	<td> <input type="text" name="username"> </td>
</tr>

<tr>
	<td> Password </td>
	<td> <input type="password" name="password"> </td>
</tr>
<tr><td></td><td><select name="keterangan"> 
<option>user</option><option>admin</option></select>


<tr>
	<td></td>
	<td> <input type="submit" value="Simpan" name="proses"><b>
	<a href="index.php">Login</a> </td>
</tr>

</table>
</form>

<?php
include "koneksi.php"; //memanggil file
session_start();
if(isset($_POST['proses'])){
	mysqli_query($koneksi,"insert into user set 
	Nama = '$_POST[namalengkap]',
	Username = '$_POST[username]',
	Sandi = '$_POST[password]',
    Keterangan = '$_POST[keterangan]'");
	echo "Anda Berhasil Terdaftar";
}
?>