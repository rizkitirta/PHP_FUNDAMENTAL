<?php 

session_start();
if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

if( isset($_POST['cari']) ) {
	$mahasiswa = cari($_POST['keyword'] );
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<h1>Daftar Mahasiswa</h1>
	<a href="logout.php">Logout</a>
	<br>
	<button type="submit">
	    <a href="tambah.php" style="text-decoration : none;">Tambah Data Mahasiswa!</a>
	</button>

	<br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="48" autofocus
           placeholder="Ketik Pencarian disini.." autocomplete="off" class="keyword">
        <button type="submit" name="cari" style="padding:3px;" class="tombol-cari">Cari</button>
     </form>

<br>

  <div class="container">
	<table border="1px" cellpadding="10" cellspacing="0">

       <tr>
	     <th>#</th>
		 <th>Gambar</th>
		 <th>Nama</th>
		 <th>Aksi</th>
	   </tr>

  <?php if( empty($mahasiswa) ) :?>
	   <tr>
	     <td colspan="4"><p style= "text-align:center; font-style:italic;">Data Tidak Ditemukan</p></td>
	   </tr>
  <?php endif; ?>


      <?php $i=1; ?>
      <?php foreach($mahasiswa as $mhs): ?>   
		<tr>
		  <td><?= $i; ?></td>
		  <td><img src="img/<?= $mhs['gambar']; ?>" width="50px" height="50px" alt=""></td>
		  <td><?= $mhs['nama']; ?></td>
		  <td><a href="detail.php?id=<?= $mhs['id']; ?>">Lihat Detail</a></td>
		</tr>
		<?php $i++; ?>
      <?php endforeach; ?>
	</table>
	</div>
  <script src="js/script.js"></script>
</body>
</html>