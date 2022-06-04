<?php
	//Query menampilkan tabel "kategori" berdasarkan id_kategori
	$query = $koneksi->query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
	$data  = $query->fetch_assoc();
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">Ubah Kategori</h3>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nama Kategori</label>
			    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" value="<?php echo $data['nama_kategori']; ?>" placeholder="">
			  </div>
			  <button type="submit" name="ubah" class="btn btn-success btn-sm">Ubah</button>
			  <a href="index.php?halaman=kategori" class="btn btn-primary btn-sm">Kembali</a>
			</form><br>
			<?php 
				if(isset($_POST['ubah'])){
					$id       = $_GET['id'];
					$nama     = $_POST['nama'];

					$query = "UPDATE kategori SET  nama_kategori     = '$nama'
					                               WHERE id_kategori = '$id'";
					$sql = mysqli_query($koneksi, $query) or die (mysqli_error());

					if($query){
						echo "<div class='alert alert-info'>Data telah diubah!</div>";
					}else{
						echo "Error".$query."<br>".mysqli_error($koneksi);
					}
					mysqli_close($koneksi);
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
				}
			?>
		</div>
	</div>
</div>

