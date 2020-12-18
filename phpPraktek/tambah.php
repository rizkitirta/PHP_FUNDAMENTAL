<?php 

session_start();
if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
 
require 'functions.php';

if( isset($_POST['tambah']) ) {
	if( tambah($_POST) > 0) {
		echo "<script>
		alert('Data Berhasil Ditambahkan!')
		document.location.href = 'index.php';
		</script>";
		
	}else {
		echo "<script>
		alert('Data Gagal Ditambahkan!')
		document.location.href = 'index.php';
		</script>";
	}
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Tambah</title>
</head>
<body>
	<h3>Tambah Data Mahasiswa</h3>
	
	<form action="" method="post" enctype="multipart/form-data">
       <ul>
	       <li>
		     <label>
			   Nama :
			   <input type="text" name="nama" required>
		     </label>
		   </li>
		   <li>
		     <label>
				 Nrp :
				 <input type="text" name="nrp" required>
			 </label>
		   </li>
		   <li>
		     <label>
				 Email :
				 <input type="text" name="email" required>
			 </label>
		   </li>
		   <li>
		     <label>
				 Jurusan :
				 <input type="text" name="jurusan" required>
			 </label>
		   </li>
		   <li>
		     <label>
				 Gambar :
				 <input type="file" name="gambar" class="gambar" onchange="previewImage()">
			 </label>
			 <img src="img/notimage.jpeg" width="120" style="display:block;" class="img-preview">
		   </li>
		   <li>
		   <button type="submit" name="tambah">Tambah Data!</button>
		   </li> <br>
		   <li>
		   <button type="submit" name="kembali">
		      <a href="index.php" style="text-decoration : none;">Kembali</a>
		   </button>
		   </li>
	   </ul>
	</form>
	<script src=js/script.js></script>
</body>
</html>