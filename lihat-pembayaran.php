<?php 
	session_start();
	include 'koneksi.php';

	$id_pembelian = $_GET['id'];

	$query	= $koneksi->query("SELECT * FROM pembayaran 
		                          LEFT JOIN pembelian 
		                          ON    pembayaran.id_pembelian = pembelian.id_pembelian 
		                          WHERE pembelian.id_pembelian  = '$id_pembelian'");
	$data   = $query->fetch_assoc();

	//Jika tidak ada data pembayaran
	if(empty($data)){
		echo "<script>alert('Belum ada data pembayaran!');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
	//Jika pelanggan yang bayar tidak sesuai dengan pelanggan yang login
	if($_SESSION['pelanggan']['id_pelanggan'] !== $data['id_pelanggan']){
		echo "<script>alert('Data tidak sesuai!')</script>";
    	echo "<script>location='riwayat.php'</script>";
        exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Saladman | Detail Pembayaran</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>		
		
		<div class="container">
			<h3 class="my-4">Detail Pembayaran</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th scope="col">Nama</th>
								<td scope="col">:</td>
								<td scope="col"><?php echo $data['nama']; ?></td>
							</tr>
							<tr>
								<th scope="col">Bank</th>
								<td scope="col">:</td>
								<td scope="col"><?php echo $data['bank']; ?></td>
							</tr>
							<tr>
								<th scope="col">Tanggal</th>
								<td scope="col">:</td>
								<td scope="col"><?php echo $data['tanggal']; ?></td>
							</tr>
							<tr>
								<th scope="col">Jumlah</th>
								<td scope="col">:</td>
								<td scope="col">Rp. <?php echo number_format($data['jumlah']) ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<img src="bukti_pembayaran/<?php echo $data['bukti']; ?>" alt="" class="img-responsive">
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