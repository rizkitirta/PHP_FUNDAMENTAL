<?php 

session_start();
if(isset($_SESSION['login'])) {
	header("Location: index.php");
	exit;
}

require 'functions.php';

if(isset($_POST['login'])) {
	$login = login($_POST);
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
</head>
<body>

   <h1>Form Login</h1>
   <?php if(isset($login['error'])): ?>
     <p style="color:red; font-style:italic;"><?= $login['pesan']; ?></p>
   <?php endif; ?>
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
			   <input type="password" name="password">
		   </label>
		 </li>
		 <li>
		   <button type="submit" name="login">Login</button>
		 </li>
		 <button type="submit" name="kembali">
		    <a href="registrasi.php" style="text-decoration : none;">Registrasi</a>
		 </button>
	   </ul>	
	</form>
</body>
</html>