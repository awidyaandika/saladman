<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">Tambah Kategori</h3>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nama Kategori</label>
			    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" placeholder="">
			  </div>
			  <button type="submit" name="save" class="btn btn-success btn-sm">Simpan</button>
			  <a href="index.php?halaman=kategori" class="btn btn-primary btn-sm">Kembali</a>
			</form><br>
			<?php
				if(isset($_POST['save'])){
					//Query menyimpan data pada form input ke tabel "kategori" dalam database 
					$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$_POST[nama]')");
					//Notif tersimpan
					echo "<div class='alert alert-info'>Data tersimpan!</div>";
					//Merefresh halaman ketika sukses menyimpan
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
				}
			?>	
		</div>
	</div>
</div>
