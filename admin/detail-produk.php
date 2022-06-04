<?php 
    $id_produk = $_GET["id"];
    $query  = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk='$id_produk'");
    $detailproduk = $query->fetch_assoc();

    $fotoproduk = array();
    $queryfoto  = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
    while($tiap = $queryfoto->fetch_assoc())
    {
        $fotoproduk[] = $tiap;
    }
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Detail Produk</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" class="form-control" readonly="" value="<?php echo $detailproduk['nama_kategori']; ?>">
                </div>
                <div class="form-group">
                    <label>Produk</label>
                    <input type="text" class="form-control" readonly="" value="<?php echo $detailproduk['nama_produk']; ?>">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" readonly="" value="<?php echo $detailproduk['harga_produk']; ?>">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" class="form-control" readonly="" value="<?php echo $detailproduk['stok_produk']; ?>">
                </div>
                <div class="form-group">
                    <label>Berat (gr)</label>
                    <input type="number" class="form-control" readonly="" value="<?php echo $detailproduk['berat_produk']; ?>">
                </div>
                <div class="form-group">
                    <label>Foto Produk</label><br>
                    <div class="col-md-3">
                        <img src="../foto_produk/<?php echo $detailproduk['foto_produk']; ?>" alt="" class="img-fluid"><br>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" readonly="" rows="10"><?php echo $detailproduk['deskripsi_produk']; ?>      
                    </textarea>
                </div>
            </form><br>
            <a href="index.php?halaman=produk" class="btn btn-primary btn-sm">Kembali</a>
        </div>
    </div>
</div>



