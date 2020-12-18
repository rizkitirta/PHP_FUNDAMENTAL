<?php 

function koneksi() {
	return mysqli_connect('localhost', 'root', '', 'dbphpdasar');
}

function query($query) {

	$conn = koneksi();
	$result = mysqli_query($conn, $query);

   if( mysqli_num_rows($result) == 1) {
	   return mysqli_fetch_assoc($result);
   }

	$rows = [];
    while($row = mysqli_fetch_assoc($result) ) {
      $rows[] = $row;
    }
return $rows;
}

function upload() {
	$conn = koneksi();

	$nama_file = $_FILES['gambar']['name'];
	$tipe_file = $_FILES['gambar']['type'];
	$ukuran_file = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmp_file = $_FILES['gambar']['tmp_name'];

	if($error == 4) {
		return 'notimage.jpeg';
	}

	$daftar_ekstensi = ['jpg', 'jpeg', 'png'];
	$ekstensi_file = explode('.', $nama_file);
	$ekstensi_file = strtolower(end($ekstensi_file));
	if(!in_array($ekstensi_file, $daftar_ekstensi)) {
		echo "<script>
				  alert('Yang anda pilih bukan gambar');
				  document.location.href='tambah.php';
			  </script>";
		return false;
	}

	if($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
		echo "<script>
				  alert('Yang anda pilih bukan gambar');
				  document.location.href='tambah.php';
			  </script>";
		return false;
	}

	if($ukuran_file > 500000) {
		echo "<script>
				  alert('Ukuran file terlalu besar');
				  document.location.href='tambah.php';
			  </script>";
		return false;
	}

	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstensi_file;
	move_uploaded_file($tmp_file,'img/'. $nama_file_baru);

	return $nama_file_baru;

}

function tambah($data) {

	$conn = koneksi();
	
	$nama = htmlspecialchars( $data['nama'] );
	$nrp = htmlspecialchars( $data['nrp'] );
	$email = htmlspecialchars( $data['email'] );
	$jurusan = htmlspecialchars( $data['jurusan'] );
	// $gambar = htmlspecialchars( $data['gambar'] );

	$gambar = upload();
	if(!$gambar) {
	  return false;
	}
	
	$query = "INSERT INTO mahasiswa
				VALUES
				(null,'$nama', '$nrp', '$email', '$jurusan', '$gambar')
				";
	mysqli_query($conn,$query) or die( mysqli_error($conn) );
	return mysqli_affected_rows($conn);
}

function hapus($id) {

	$conn = koneksi();

	$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
	if($mhs['gambar'] != 'notimage.jpeg') {
       unlink('img/'.$mhs['gambar']);
	}

	mysqli_query($conn,"DELETE FROM mahasiswa WHERE id = $id");
	mysqli_error($conn);
	return mysqli_affected_rows($conn);
}

function ubah($data) {

	$conn = koneksi();
	
	$id = $data['id'];
	$nama = htmlspecialchars( $data['nama'] );
	$nrp = htmlspecialchars( $data['nrp'] );
	$email = htmlspecialchars( $data['email'] );
	$jurusan = htmlspecialchars( $data['jurusan'] );
	$gambar_lama = htmlspecialchars( $data['gambar'] );

	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	if($gambar == 'notimage.jpeg') {
		$gambar = $gambar_lama;
	}

	
	$query = "UPDATE mahasiswa SET
				nama = '$nama',
				nrp = '$nrp',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
				WHERE id = $id";

	mysqli_query($conn,$query) or die( mysqli_error($conn) );
	return mysqli_affected_rows($conn);
}


function cari($keyword) {

	 $conn = koneksi();

	 $query = "SELECT * FROM mahasiswa
				WHERE nama LIKE '%$keyword%' ";

	 $result = mysqli_query($conn,$query);
				 
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
	  $rows[] = $row;
	}
	 return $rows;
}

function login($data) {

	$conn = koneksi();
	
	$username = htmlspecialchars($data['username']);
	$password = htmlspecialchars($data['password']);

	if($user = query("SELECT * FROM users WHERE username = '$username'")) {
        if(password_verify($password, $user['password'])) {
			$_SESSION['login'] = true;
			header("Location: index.php");
			exit;
		}
	}
    return [
			'error' => true,
			'pesan' => "Username / Password Salah!"
		];
}

function registrasi($data) {

	$conn = koneksi();

	$username = htmlspecialchars($data['username']);
	$password1 = mysqli_real_escape_string($conn,$data['password1']);
	$password2 = mysqli_real_escape_string($conn,$data['password2']);

	if( empty($username) && empty($password1) && empty($password2) ) {
		echo "<script>
				  alert('username / password tidak boleh kosong');
				  document.location.href='registrasi.php';
			  </script>";
		return false;
	}

	if( query("SELECT * FROM users WHERE username = '$username' ") ) {
		echo "<script>
				 alert('username sudah digunakan');
				 document.location.href='registrasi.php';
	          </script>";
return false;
	}

	if( $password1 !== $password2 ) {
		echo "<script>
		         alert('konfirmasi password salah');
		         document.location.href='registrasi.php';
	          </script>";
return false; 
	}

	if( strlen($password1) <= 5 ) {
		echo "<script>
	 	         alert('password terlalu pendek');
				 document.location.href='registrasi.php';
	          </script>";
return false;
	}

	$password_hash = password_hash($password1, PASSWORD_DEFAULT);
	$query = "INSERT INTO users
				VALUES
				(null, '$username', '$password_hash')";
				
				mysqli_query($conn,$query);
				echo mysqli_error($conn);
				return mysqli_affected_rows($conn);
			
}
?>

