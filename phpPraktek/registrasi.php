<?php 

require 'functions.php';

if( isset($_POST['registrasi']) ) {
	if( registrasi($_POST) > 0 ) {
		echo "<script>
		        alert('user berhasil ditambahkan');
		        document.location.href='login.php';
	          </script>";
	}else {
		echo 'user gagal ditambahkan';
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Registrasi</title>
</head>
<body>
	<h1>Form Registrasi</h1>
      <form action="" method="POST">
	    <ul>
		  <li>
		    <label>
				Username :
				<input type="text" name="username">
			</label>
		  </li>
		  <li>
		    <label>
				Password :
				<input type="password" name="password1">
			</label>
		  </li>
		  <li>
		    <label>
				Konfirmasi Password :
				<input type="password" name="password2">
			</label>
		  </li>
		  <li>
		    <button type="submit" name="registrasi">Registrasi</button>
		  </li> 
		</ul>
	  </form>
</body>
</html>