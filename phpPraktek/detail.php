<?php

session_start();
if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
 
require 'functions.php';

$id = $_GET['id'];
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman detail</title>
</head>
<body>
	<h1>Detail Mahasiswa</h1>

	<ul>
	   <li>
	    <img src="img/<?= $mhs['gambar']; ?>" width="100px" height="100px" alt="Gambar Profil">
	   </li>
	   <li>Nama :<?= $mhs['nama']; ?></li>
	   <li>Nrp :<?= $mhs['nrp']; ?></li>
	   <li>Email :<?= $mhs['email']; ?></li>
	   <li>Jurusan :<?= $mhs['jurusan']; ?></li>
	   <li>
	   <a href="ubah.php?id=<?= $mhs['id']; ?>">Ubah</a> | <a href="hapus.php?id=<?= $mhs['id']; ?>">Hapus</a>
	   </li>
	   <li><a href="index.php">Kembali Ke Home</a></li>

	</ul>
</body>
</html>