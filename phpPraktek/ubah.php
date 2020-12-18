<?php 

session_start();
if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
 
require 'functions.php';

$id = $_GET['id']; 

if(!isset($_GET['id']) ) {
	header("Location: index.php");
  exit;
}

$m = query("SELECT * FROM mahasiswa WHERE id = $id");

if( isset($_POST['ubah']) ) {
	if(ubah($_POST) > 0) {
		echo "<script>
		alert('Data Berhasil Diubah!')
		document.location.href = 'index.php';
		</script>";
		
	}else {
		echo "<script>
		alert('Data Gagal Diubah!')
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
	<title>Halaman Update</title>
</head>
<body>
	<h3>Ubah Data Mahasiswa</h3>
	
	<form action="" method="post" enctype="multipart/form-data">
       <ul>
	   <input type="hidden" name="id" value="<?= $m['id']; ?>">
	       <li>
		     <label>
			   Nama :
			   <input type="text" name="nama" required value="<?= $m['nama']; ?>">
		     </label>
		   </li>
		   <li>
		     <label>
				 Nrp :
				 <input type="text" name="nrp" required value="<?= $m['nrp']; ?>">
			 </label>
		   </li>
		   <li>
		     <label>
				 Email :
				 <input type="text" name="email" required value="<?= $m['email']; ?>">
			 </label>
		   </li>
		   <li>
		     <label>
				 Jurusan :
				 <input type="text" name="jurusan" required value="<?= $m['jurusan']; ?>">
			 </label>
		   </li>
		   <li>
		   <input type="hidden" name="gambar" value="<?= $m['gambar']; ?>">
		     <label>
				 Gambar :
				 <input type="file" name="gambar" class="gambar" onchange="previewImage()">
			 </label>
			 <img src="img/<?= $m['gambar']; ?>" width="100" style="display:block;" class="img-preview">
		   </li>
		   <li>
		   <button type="submit" name="ubah">Ubah Data!</button>
		   </li> <br>
		   <li>
		   <button type="submit" name="kembali">
		      <a href="index.php" style="text-decoration : none;">Kembali</a>
		   </button>
		   </li>
	   </ul>
	</form>
	<script src="js/script.js"></script>
</body>
</html>