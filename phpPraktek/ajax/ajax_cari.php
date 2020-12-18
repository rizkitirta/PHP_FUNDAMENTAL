<?php 
require '../functions.php';
$mahasiswa = cari($_GET['keyword']);
?>

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

