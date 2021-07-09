<?php

session_start();
session_destroy(); //menghapus semua session yang pernah disimpan
header("location:index.php");


?>