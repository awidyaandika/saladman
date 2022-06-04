<?php
	include'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Saladman | Daftar Pelanggan</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>		
		<br>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Daftar Pelanggan</h3>
						</div>
						<div class="card-body">
							<form method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label">Nama</label>
							
										<input type="text" class="form-control" name="nama" required="">
								
								</div>
								<div class="form-group">
									<label class="control-label">Email</label>
							
										<input type="email" class="form-control" name="email" required="">
								
								</div>
								<div class="form-group">
									<label class="control-label">Password</label>
								
										<input type="text" class="form-control" name="password" required="">
									
								</div>
								<div class="form-group">
									<label class="control-label">Telepon</label>
									
										<input type="text" class="form-control" name="telepon" required="">
								
								</div>
								<div class="form-group">
									<label class="control-label">Alamat</label>
									
										<textarea class="form-control" name="alamat" required=""></textarea>
									
								</div>
								<div class="form-group">
									
										<button class="btn btn-primary" name="daftar">Daftar</button>
									
								</div>
							</form>
							<?php
								if(isset($_POST['daftar'])){
									//Mengambil data dan menyimpan divariabel
									$nama     = $_POST['nama'];
									$email    = $_POST['email'];
									$password = $_POST['password'];
									$telepon  = $_POST['telepon'];
									$alamat   = $_POST['alamat'];	

									$query = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
									$data_email = $query->num_rows;

									//Validasi ketika email yang didaftarkan sama
									if($data_email == 1){
										echo "<script>alert('Email telah terdaftar!');</script>";
										echo "<script>location='daftar.php';</script>";
									}
									//Validasi ketika email tidak sama
									else{
										$koneksi->query("INSERT INTO pelanggan (email_pelanggan,
									                                            password_pelanggan,
									                                            nama_pelanggan,
									                                            telepon_pelanggan,
									                                            alamat_pelanggan)
									                                    VALUES ('$email',
									                                            '$password',
									                                            '$nama',
									                                            '$telepon',
									                                            '$alamat')");
										echo "<script>alert('Selamat, pendaftaran berhasil!');</script>";
										echo "<script>location='login.php';</script>";
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>