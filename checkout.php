<?php 
	session_start();
	include 'koneksi.php';

	//Jika belum login
	if(!isset($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
    }

    //Jika checkout kosong
    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
		echo "<script>alert('Checkout kosong!');</script>";
		echo "<script>location='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>SALADMAN | Checkout</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>

		<div class="container">
			
				<h3 class="my-4">Checkout</h3>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
					  <thead>
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Produk</th>
					      <th scope="col">Harga</th>
					      <th scope="col">Jumlah</th>
					      <th scope="col">Subharga</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php $nomor = 1; ?>
						<?php $totalbelanja = 0; ?>
						<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
						<?php 
							$query    = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
							$data     = $query->fetch_assoc();
							$subharga = $data["harga_produk"] * $jumlah;
						?> 
					    <tr>
					      <th scope="row"><?php echo $nomor; ?></th>
					      <td><?php echo $data['nama_produk']; ?></td>
					      <td>Rp. <?php echo number_format($data['harga_produk']); ?></td>
					      <td><?php echo $jumlah; ?></td>
					      <td>Rp. <?php echo number_format($subharga); ?></td>
					    </tr>
					    <?php $nomor++; ?>
					    <?php $totalbelanja += $subharga; ?>
					    <?php endforeach ?>
					  </tbody>
					  <tfoot>
						<tr>
							<th scope="col" colspan="4">Total Belanja</th>
							<th scope="col">Rp. <?php echo number_format($totalbelanja); ?> ,-</th>
						</tr>
					</tfoot>
					</table>
				</div>
				<form method="POST">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama</label>
								<input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Telepon</label>
								<input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Ongkir</label>
								<select class="form-control" name="id_ongkir">
									<option value="">Pilih ongkos kirim</option>
									<?php
										$query = $koneksi->query("SELECT * FROM ongkir ORDER BY nama_kota ASC");
										while($data  = $query->fetch_assoc()){
									?>
									<option value="<?php echo $data['id_ongkir']; ?>">
										<?php echo $data['nama_kota']; ?> -
							            Rp.<?php echo number_format($data['tarif']); ?> ,-
									</option>
									<?php 
										} 
									?>	
								</select>
							</div>
						</div>
					</div>
					<div class="form-group"> 
						<label> Alamat Lengkap Pengiriman </label>
						<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap" ></textarea>
					</div>
					<a href="keranjang.php" class="btn btn-primary">Kembali</a> &nbsp;
					<button class="btn btn-success" name="checkout">Lanjutkan</button>
				</form>
				<?php
					if(isset($_POST['checkout'])){
						//Mengambil data field pada tabel pembelian dan menyimpannya di beberapa variabel
						$id_pelanggan      = $_SESSION['pelanggan']['id_pelanggan'];
						$id_ongkir         = $_POST['id_ongkir'];
						$tanggal_pembelian = date("Y-m-d");
						$alamat_pengiriman = $_POST['alamat_pengiriman'];

						//Menghitung Ongkir
						$query           = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
						$ongkir          = $query->fetch_assoc();
						$nama_kota		 = $ongkir['nama_kota'];
							//Mengambil data field tarif dan menyimpannya di $tarif_ongkir
						$tarif   = $ongkir['tarif'];
							//Menghitung total belanja beserta ongkirnya dan disimpan di total_pembelian
						$total_pembelian = $totalbelanja + $tarif;

						//Menyimpan data checkout ke tabel "pembelian"
						$koneksi->query("INSERT INTO pembelian (id_pelanggan, 
							                                    id_ongkir,
							                                    tanggal_pembelian,
							                                    total_pembelian,nama_kota,tarif,alamat_pengiriman)
									                    VALUES ('$id_pelanggan',
									                            '$id_ongkir',
									                            '$tanggal_pembelian',
									                            '$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

						//Menyimpan hasil dari data checkout (produk yang dibeli) ke tabel pembelian_produk
						$id_pembelian_produk = $koneksi->insert_id;

						foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
						{
							//mendapatkan data produk berdasarkan id_produk
							$query    = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
							$data     = $query->fetch_assoc();
							$nama 	  = $data ['nama_produk'];
							$harga 	  = $data ['harga_produk'];
							$berat    = $data ['berat_produk'];

							$subberat = $data ['berat_produk']*$jumlah;
							$subharga = $data ['harga_produk']*$jumlah;
							$koneksi->query("INSERT INTO pembelian_produk (id_pembelian, 
								                                           id_produk,nama,harga,
																		   berat,subberat,subharga,
								                                           jumlah)
								                                   VALUES ('$id_pembelian_produk',
								                                           '$id_produk', '$nama', '$harga', '$berat', 
																		   '$subberat', '$subharga',
								                                           '$jumlah')");
							//Update stock produk
							$koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah
								                           WHERE id_produk = '$id_produk'");
						}

						//Mengosongkan keranjang belanja
						unset($_SESSION['keranjang']);

						//Mengalihkan tampilan ke halaman nota
						echo "<script>alert('Pembelian sukses!');</script>";
						echo "<script>location='nota.php?id=$id_pembelian_produk';</script>";
					}
				?>
			
		</div>
		
		<br>
		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>