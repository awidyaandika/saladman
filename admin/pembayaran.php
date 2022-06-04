<?php
	//Mendapatkan id_pembelian dari url
	$id_pembelian = $_GET['id']; 

	// $query = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
	$query = $koneksi->query("SELECT * FROM pembelian 
		                               JOIN pelanggan 
		                               ON pembelian.id_pelanggan = pelanggan.id_pelanggan
		                               WHERE id_pembelian = '$id_pembelian'");
	$data  = $query->fetch_assoc();
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" readonly="" value="<?php echo $data['nama_pelanggan']?>">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" readonly="" value="Rp. <?php echo number_format($data['total_pembelian']); ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="stok" readonly="" value="<?php echo $data['tanggal_pembelian']?>">
                </div>
                <div class="form-group">
                    <label>No Resi Pengiriman</label>
                    <input type="text" class="form-control" name="resi">
                </div>
                <div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option value="">Pilih Status</option>
						<option value="Di Batalkan">Di Batalkan</option>
						<option value="Barang dikirim">Barang Dikirim</option>
						<option value="Lunas">Lunas</option>
						<option value="Batal">Batal</option>
					</select>
				</div>
				<button class="btn btn-success btn-sm" name="proses">Proses</button>
                <a href="index.php?halaman=pembelian" class="kembali btn btn-primary btn-sm">Kembali</a>
            </form><br>
			<?php
                if(isset($_POST['proses'])){
                    $resi   = $_POST['resi'];
                    $status = $_POST['status'];
                    $koneksi->query("UPDATE pembelian SET resi_pengiriman  = '$resi',
                                                          status_pembelian = '$status'
                                                    WHERE id_pembelian     = '$id_pembelian'");
                    echo "<script>alert('Data pembelian terupdate!');</script>";
                    echo "<script>location='index.php?halaman=pembelian';</script>";
                }
            ?>
        </div>
    </div>
</div>



