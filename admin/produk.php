<style type="text/css">
	.foto-produk{
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 100px;
	}
	.tombol{
		margin-bottom: 10px;
	}
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data Produk</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            	<a href="index.php?halaman=tambah-produk" class="tombol btn btn-success btn-sm">Tambah Data</a>
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>No</th>
							<th>Kategori</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Berat (gr)</th>
							<th>Foto</th>
							<th>Deskripsi</th>
							<th>Aksi</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php
							//Query menampilkan data pada tabel "produk" 
							$query = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); 
							//Membuat nomor urut
							$nomor = 1;
							//Menampilkan data
							while ($data = $query->fetch_assoc()){  
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $data['nama_kategori']; ?></td>
							<td><?php echo $data['nama_produk']; ?></td>
							<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
							<td><?php echo $data['stok_produk']; ?></td>
							<td><?php echo $data['berat_produk']; ?></td>
							<td>
								<img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100px">
							</td> 
											<?php 
								//Membatasi deskripsi
								$desc       = $data['deskripsi_produk'];
								$desc_limit = substr($desc, 0, 25). "...";
							?>
							<td><?php echo $desc_limit; ?></td>
							<td>
								<a href="index.php?halaman=ubah-produk&id=<?php echo $data['id_produk']; ?>" class="btn btn-warning btn-sm"></span> Ubah</a>
								<a href="index.php?halaman=hapus-produk&id=<?php echo $data['id_produk']; ?>" class="btn-danger btn btn-sm"></span> Hapus</a>
								<a href="index.php?halaman=detail-produk&id=<?php echo $data['id_produk']; ?>" class="btn btn-info btn-sm"></span> Detail</a>
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
    </div>
</div>