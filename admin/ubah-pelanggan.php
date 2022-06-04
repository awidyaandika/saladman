<?php
	//Query menampilkan tabel "pelanggan" berdasarkan id_pelanggan
	$query = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
	$data  = $query->fetch_assoc();
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">Ubah Pelanggan</h3>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $data["id_pelanggan"];?>">

				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="<?php echo $data['email_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $data['user_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" class="form-control" name="password" value="<?php echo $data['password_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" class="form-control" name="telepon" value="<?php echo $data['telepon_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat" rows="10"><?php echo $data['alamat_pelanggan']; ?></textarea>
				</div>
				<button class="btn btn-success btn-sm" name="ubah">Ubah</button>
				<a href="index.php?halaman=pelanggan" class="kembali btn btn-primary btn-sm">Kembali</a>
			</form><br>
			<?php 
				if(isset($_POST['ubah'])){
					$id       = $_GET['id'];
					$nama     = $_POST['nama'];
					$email    = $_POST['email'];
					$username = $_POST['username'];
					$password = $_POST['password'];
					$telepon  = $_POST['telepon'];
					$alamat   = $_POST['alamat'];

					$query = "UPDATE pelanggan SET nama_pelanggan     = '$nama',
					                               email_pelanggan    = '$email',
					                               user_pelanggan     = '$username',
					                               password_pelanggan = '$password',
					                               telepon_pelanggan  = '$telepon',
					                               alamat_pelanggan   = '$alamat'
					                               WHERE id_pelanggan = '$id'";
					$sql = mysqli_query($koneksi, $query) or die (mysqli_error());

					if($query){
						echo "Data berhasil dirubah!";
					}else{
						echo "Error".$query."<br>".mysqli_error($koneksi);
					}
					mysqli_close($koneksi);
					echo "<div class='alert alert-info'>Data telah diubah!</div>";
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
				}
			?>
		</div>
	</div>
</div>
