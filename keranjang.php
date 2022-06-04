<?php
	session_start();
	include 'koneksi.php';
	
	if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
		echo "<script>alert('Keranjang kosong!');</script>";
		echo "<script>location='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>SALADMAN | Keranjang Belanja</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>

		<div class="container">
			
				<h3 class="my-4">Keranjang Belanja</h3>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
					  <thead>
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Produk</th>
					      <th scope="col">Harga</th>
					      <th scope="col">Jumlah</th>
					      <th scope="col">Subharga</th>
					      <th scope="col">Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php $nomor = 1; ?>
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
						  <td>
							<a href="hapus-keranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-xs">Hapus</a>
						  </td>
					    </tr>
					    <?php $nomor++; ?>
					    <?php endforeach ?>
					  </tbody>
					</table>
				</div>
				<a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>&nbsp;
				<a href="checkout.php" class="btn btn-success">Checkout</a>
		</div>
		<br>
		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>