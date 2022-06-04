<?php 
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
    }

    $id_produk= $_GET["id"];

    $query = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $data  = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Saladman | Detail Produk</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<style type="text/css">
			.card-img-top{
				display: block;
				margin-left: auto;
				margin-right: auto;
				height: 300px;
				width: 300px;
			}
		</style>
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<h1 class="my-4">Jenis Produk</h1>
					<div class="list-group">
						<?php
							$query_kategori = $koneksi->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");
							while($kategori = $query_kategori->fetch_assoc()){
						?>
			        		<a href="index.php?catid=<?php echo $kategori['id_kategori']; ?>" class="list-group-item"><?php echo $kategori['nama_kategori']; ?></a>
			        	<?php } ?>
			        </div>
				</div>

				<div class="col-lg-9">
					<div class="card mt-4">
			          <img class="card-img-top img-fluid" src="foto_produk/<?php echo $data["foto_produk"];?>" alt="">
			          <div class="card-body">
			            <h3 class="card-title"><?php echo $data["nama_produk"]?></h3>
			            <h4>Rp. <?php echo number_format($data["harga_produk"]); ?></h4>
			            <hr>
			            <p class="card-text"><?php echo $data["deskripsi_produk"]?></p>
			          </div>
			        </div>

					<div class="card card-outline-secondary my-4">
			          <div class="card-header">
			            Pembelian
			          </div>
			          <div class="card-body">
			           	<form method="post">
			                <div class="form-group">
			                	<h4 class="card-title">Stok : <?php echo $data["stok_produk"]?></h4>
			                    <div class="input-group">
			                       <input type="number" min="1" class="form-control" placeholder="Masukkan jumlah yang ingin dibeli" name="jumlah" max="<?php echo $data['stok_produk'] ?>">
			                        <div class="input-group-btn">
			                            <button class="btn btn-success" name="beli"> Beli</button>
			                        </div>
			                    </div>
			                    <hr>
			                    <a href="index.php" class="btn btn-primary" role="button">Kembali</a>
			                </div>
			            </form>
			          </div>
			        </div>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'footer.php'; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>
<?php 
	if (isset($_POST["beli"])){
        $jumlah = $_POST["jumlah"];
       	$_SESSION['keranjang'][$id_produk] = $jumlah;

        // echo "<script>alert('Produk ditambahkan ke keranjang belanja!')</script>";
        echo "<script>location='keranjang.php'</script>";
    }
?>

<?php
	if(isset($_GET['catid'])){
		$catid   = $_GET['catid'];
		$query   = $koneksi->query("SELECT * FROM produk WHERE id_kategori = '$catid' ORDER BY nama_produk ASC");
	}else{
		$query   = $koneksi->query("SELECT * FROM produk ORDER BY nama_produk ASC");
	}
?>
	