<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">Tambah Pelanggan</h3>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" name="nama">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" class="form-control" name="password">
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" class="form-control" name="telepon">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat" rows="10"></textarea>
				</div>
				<button class="btn btn-success btn-sm" name="save">Simpan</button>
				<a href="index.php?halaman=pelanggan" class="kembali btn btn-primary btn-sm">Kembali</a>
			</form><br>
			<?php
				if(isset($_POST['save'])){
					//Query menyimpan data pada form input ke tabel "pelanggan" dalam database 
					$koneksi->query("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, user_pelanggan, password_pelanggan, telepon_pelanggan, alamat_pelanggan)
					                     VALUES ('$_POST[nama]',
					                             '$_POST[email]',
					                             '$_POST[username]',
					                             '$_POST[password]',
					                             '$_POST[telepon]',
					                             '$_POST[alamat]')");
					//Notif tersimpan
					echo "<div class='alert alert-info'>Data tersimpan!</div>";
					//Merefresh halaman ketika sukses menyimpan
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
				}
			?>	
		</div>
	</div>
</div>
