<?php
	session_start();
    include 'koneksi.php';
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Saladman | Riwayat Transaksi</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<div class="container">
			
				<h3 class="my-4">Riwayat Transaksi <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
					  <thead>
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Tanggal</th>
					      <th scope="col">Total</th>
					      <th scope="col">Status</th>
					      <th scope="col">Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
							$nomor = 1;
							//Mendapatkan id_pelanggan
							$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
							//Mendapatkan data berdasarkan id_pelanggan pada tabel pembelian
							$query = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
							while($data = $query->fetch_assoc()){
						?>
					    <tr>
					      <th scope="row"><?php echo $nomor; ?></th>
					      <td><?php echo $data['tanggal_pembelian']; ?></td>
					      <td>Rp. <?php echo number_format($data['total_pembelian']); ?></td>
					      <td>
						  	<?php echo $data['status_pembelian']; ?>
						    <br>
							<?php if(!empty($data['resi_pengiriman'])) : ?>
								Resi : <?php echo $data['resi_pengiriman']; ?>
							<?php endif ?>
						  </td>
						  <td>
							<a href="nota.php?id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info">Nota</a>
							<?php if($data['status_pembelian']=='Pending') : ?>
							<a href="pembayaran.php?id=<?php echo $data['id_pembelian']; ?>" class="btn btn-success">Bayar</a>
							<?php else: ?>
							<a href="lihat-pembayaran.php?id=<?php echo $data['id_pembelian']; ?>" class="btn btn-primary">Detail</a>
							<?php endif ?>
						  </td>
					    </tr>
					    <?php
							$nomor++;
							}
						?>
					  </tbody>
					</table>
				</div>
		</div>

		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>