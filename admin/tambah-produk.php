<?php
	$datakategori=array();
	$query=$koneksi->query("SELECT * FROM kategori");
	while($data = $query->fetch_assoc())
	{
	    $datakategori[]=$data;
	}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">Tambah Produk</h3>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Kategori</label>
					<select class="form-control" name="id_kategori">
						<option value="">Pilih Kategori</option>
						<?php foreach ($datakategori as $key =>$value): ?>
						<option value="<?php echo $value["id_kategori"]; ?>"<?php if($data["id_kategori"] == $value["id_kategori"]){echo "selected";} ?> >
							<?php echo $value["nama_kategori"] ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" name="nama">
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="number" class="form-control" name="harga">
				</div>
				<div class="form-group">
					<label>Stok</label>
					<input type="number" class="form-control" name="stok">
				</div>
				<div class="form-group">
					<label>Berat (gr)</label>
					<input type="number" class="form-control" name="berat">
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<textarea class="form-control" name="deskripsi" rows="10"></textarea>
				</div>
				<div class="form-group">
					<label>Foto</label>
					<div class="letak-input" style="margin-bottom: 10px;">
						<input type="file" class="form-control" name="foto[]">
					</div>
					<!-- <span class="btn btn-primary btn-tambah">
						<i class="fa fa-plus"></i>			
					</span> -->
				</div>
			  <button class="btn btn-success btn-sm" name="save">Simpan</button>
			  <a href="index.php?halaman=produk" class="btn btn-primary btn-sm">Kembali</a>
			</form><br>
			<?php
				if(isset($_POST['save']))
				{
					//Menyimpan File
					$namanamafoto = $_FILES['foto']['name'];
					$lokasilokasifoto =$_FILES['foto']['tmp_name'];
					move_uploaded_file($lokasilokasifoto[0],"../foto_produk/".$namanamafoto[0]);
					//Query menyimpan data pada form input ke tabel "produk" dalam database 
					$koneksi->query("INSERT INTO produk (nama_produk, harga_produk, stok_produk, berat_produk, foto_produk, deskripsi_produk,id_kategori)
					                     VALUES ('$_POST[nama]',
					                             '$_POST[harga]',
					                             '$_POST[stok]',
					                             '$_POST[berat]',
					                             '$namanamafoto[0]',
					                             '$_POST[deskripsi]',
												 '$_POST[id_kategori]')");
					$id_produk_barusan=$koneksi->insert_id;
					foreach ($namanamafoto as $key =>$tiap_nama)
					{
						$tiap_lokasi=$lokasilokasifoto[$key];
						move_uploaded_file($tiap_lokasi,"../foto_produk/".$tiap_nama);
						//simpan ke mysql
						$koneksi->query("INSERT INTO produk_foto(id_produk,nama_produk_foto)
						                                 VALUES ('$id_produk_barusan','$tiap_nama')");
					}
					echo "<div class='alert alert-info'>Data berhasil disimpan!</div>";
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
				}
			?>	
		</div>
	</div>
</div>
<!-- <script>
	$(document).ready(function(){
		$(".btn-tambah").on("click",function(){
			$(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
		})
	})
</script> -->