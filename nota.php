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
		<title>SALADMAN | Nota Pembayaran</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<style type="text/css" media="print">
			.print{
				visibility: hidden;
			}
			.kembali{
				visibility: hidden;
			}
		</style>
	</head>
	<body>
		<?php include 'menu.php'; ?>

		<div class="container">
			<h3 class="my-4">Nota Pembayaran</h3>
			<?php 
				//Query Inner Join pada tabel "pembelian" dan tabel "pelanggan"
				$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
					                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan
					                      WHERE pembelian.id_pembelian = '$_GET[id]'");
				$detail = $query->fetch_assoc();

				//Jika pelanggan yang beli tidak sesuai dengan pelanggan yang login (tidak berhak melihat nota orang lain)
				//Pelanggan yang beli harus sama dengan pelanggan yang login
					//Id pelanggan yang beli
				$user_beli  = $detail['id_pelanggan'];
					//Id pelanggan yang login
				$user_login = $_SESSION['pelanggan']['id_pelanggan'];

				if($user_beli !== $user_login){
					echo "<script>alert('Data tidak sesuai!')</script>";
                	echo "<script>location='riwayat.php'</script>";
                	exit();
				}
			?>
			<div class="row">
				<div class="col-md-4">
					<h3 class="my-4">Pembelian</h3>
					<table class="table-responsive">
						<tr>
							<th scope="col">No. Pembelian</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['id_pembelian']; ?></td>
						</tr>
						<tr>
							<th scope="col">Tanggal</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['tanggal_pembelian']; ?></td>
						</tr>
						<tr>
							<th scope="col">Total</th>
							<td scope="col">:</td>
							<td scope="col">Rp. <?php echo number_format($detail['total_pembelian']); ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<h3 class="my-4">Pelanggan</h3>
					<table class="table-responsive">
						<tr>
							<th scope="col">Nama</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['nama_pelanggan']; ?></td>
						</tr>
						<tr>
							<th scope="col">Telepon</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['telepon_pelanggan']; ?></td>
						</tr>
						<tr>
							<th scope="col">Email</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['email_pelanggan']; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<h3 class="my-4">Pengiriman</h3>
					<table class="table-responsive">
						<tr>
							<th scope="col">Kota</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['nama_kota']; ?></td>
						</tr>
						<tr>
							<th scope="col">Ongkos kirim</th>
							<td scope="col">:</td>
							<td scope="col">Rp. <?php echo number_format($detail['tarif']); ?></td>
						</tr>
						<tr>
							<th scope="col">Alamat</th>
							<td scope="col">:</td>
							<td scope="col"><?php echo $detail['alamat_pengiriman']; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
						   	<th scope="col">No</th>
						    <th scope="col">Produk</th>
						    <th scope="col">Harga</th>
						    <th scope="col">Berat</th>
						    <th scope="col">Jumlah</th>
						    <th scope="col">Subberat</th>
						    <th scope="col">Subharga</th>
						</tr>
					</thead>
					<tbody>
						<?php
						    //Query Inner Join pada tabel "pembelian_produk" dan tabel "produk" 
							$query = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian= '$_GET[id]'");
							//Membuat nomor urut
							$nomor = 1;
							//Menampilkan data
							while($data = $query->fetch_assoc()){                   
					    ?> 
					   <tr>
						    <th scope="row"><?php echo $nomor; ?></th>
						    <td><?php echo $data['nama']; ?></td>
							<td>Rp. <?php echo number_format($data['harga']); ?></td>
							<td><?php echo $data['berat']; ?> gr. </td>
							<td><?php echo $data['jumlah']; ?></td>
							<td><?php echo $data['subberat']; ?> gr. </td>
							<td>Rp. <?php echo number_format($data['subharga']); ?></td>
						</tr>
						<?php 
							$nomor++; 
							}
						?>
					</tbody>
					<tfoot>
						<tr>
                            <th colspan="6">Total</th>
                            <th>Rp. <?php echo number_format($detail['total_pembelian']) ?></th>
                        </tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>
		<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-info">
					<p>
						Silahkan melakukan pembayaran sebesar <b>Rp. <?php echo number_format($detail['total_pembelian']); ?></b> pada
						<br>
						<strong>BANK MANDIRI 143-00103022-3242 An/ ADMIN SALADMAN</strong>
						<br>
						*Biaya sudah termasuk dengan ongkir
					</p>
				</div>
				<div class="form-group">							
					<button class="print btn btn-info" onclick="window.print();return false;">Print</button>
					<button class="print btn btn-primary" onclick="history.back()">Kembali</button>						
				</div>
			</div>
		</div>
		</div>

		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>