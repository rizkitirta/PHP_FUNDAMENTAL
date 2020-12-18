<?php 

$conn = mysqli_connect('localhost', 'root', '', 'dbphpdasar');
$result = mysqli_query($conn,"SELECT * FROM mahasiswa");

$rows = [];
while($row = mysqli_fetch_assoc($result) ) {
   $rows[] = $row;
}

$mahasiswa = $rows;
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>Daftar Mahasiswa</h1>

	<table border="1px" cellpadding="10" cellspacing="0">

       <tr>
	     <th>#</th>
		 <th>Gambar</th>
		 <th>Nrp</th>
		 <th>Nama</th>
		 <th>Email</th>
		 <th>Jurusan</th>
	   </tr>
	   
      <?php $i=1; ?>
      <?php foreach($mahasiswa as $mhs): ?>   
		<tr>
		  <td>1</td>
		  <td><img src="img/<?= $mhs['gambar']; ?>" width="100px" height="100px" alt=""></td>
		  <td><?= $mhs['nrp']; ?></td>
		  <td><?= $mhs['nama']; ?></td>
		  <td><?= $mhs['email']; ?></td>
		  <td><?= $mhs['jurusan']; ?></td>
		</tr>
		<?php $i++; ?>
      <?php endforeach; ?>
	</table>
</body>
</html>