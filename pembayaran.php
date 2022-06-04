<?php
	session_start();
    include 'koneksi.php';
    
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }
    //Mendapatkan id_pembelian dari url
    $idpembeli            = $_GET['id'];
    $query                = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpembeli'");
    $detail_pembelian     = $query->fetch_assoc();

    //Jika pelanggan yang beli tidak sesuai dengan pelanggan yang login (tidak berhak melihat pembayaran orang lain)
	//Pelanggan yang beli harus sama dengan pelanggan yang login
    	//Mendapatkan id_pelanggan yang beli
    $user_beli  = $detail_pembelian['id_pelanggan'];
    	//Mendapatkan id_pelanggan yang login
    $user_login = $_SESSION['pelanggan']['id_pelanggan'];
    
    if($user_beli !== $user_login){
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
		<title>Saladman | Konfirmasi Pembayaran</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<?php include 'menu.php'; ?>
		
		<div class="container">
			<h3 class="my-4">Konfirmasi Pembayaran</h3>
			<p>Kirim bukti pembayaran anda disini...</p>
			<div class="alert alert-info">
				Total tagihan anda <strong>Rp. <?php echo number_format($detail_pembelian['total_pembelian']); ?></strong>
			</div>
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Penyetor</label>
					<input type="text" class="form-control" name="nama">
				</div>
				<div class="form-group">
					<label>Bank</label>
					<select class="form-control" name="bank">
						<option value="">Pilih Bank</option>
						<option value="BCA">BCA (Bank Central Asia)</option>
						<option value="BNI">BNI (Bank Negara Indonesia)</option>
						<option value="BRI">BRI (Bank Rakyat Indonesia)</option>
						<option value="Danamon">Danamon</option>
						<option value="Mandiri">Mandiri</option>
						<option value="Mega">Mega</option>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" class="form-control" name="jumlah" min="1">
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" class="form-control" name="bukti">
					<p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>
		</div>
		<?php
		if(isset($_POST['kirim'])){
			//Menyimpan file
			$namabukti   = $_FILES['bukti']['name'];
			$lokasibukti = $_FILES['bukti']['tmp_name'];
			$namafix     = date("YmdHis").$namabukti;
			move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

			$nama    = $_POST['nama'];
			$bank    = $_POST['bank'];
			$jumlah  = $_POST['jumlah'];
			$tanggal = date("Y-m-d");

			//Simpan pembayaran
			$koneksi->query("INSERT INTO pembayaran (id_pembelian,
		                                             nama,
		                                             bank,
		                                             jumlah, 
		                                             tanggal,
		                                             bukti)
		                                    VALUES  ('$idpembeli',
		                                            '$nama',
		                                            '$bank',
		                                            '$jumlah',
		                                            '$tanggal',
		                                            '$namafix')");
			
			//Ubah status pembelian dari pending menjadi processing
			$koneksi->query("UPDATE pembelian SET status_pembelian = 'Processing'
				                              WHERE id_pembelian   = '$idpembeli'");
			echo "<script>alert('Data terkirim, kami akan meninjau pembayaran anda!')</script>";
   			echo "<script>location='keranjang.php'</script>";
		}
		?>
		
		<?php include 'footer.php' ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>