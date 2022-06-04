<style type="text/css">
	.tambah{
		margin-bottom: 10px;
	}
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data Pelanggan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            	<a href="index.php?halaman=tambah-pelanggan" class="tambah btn btn-success btn-sm">Tambah Data</a>
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Username</th>
							<th>Password</th>
							<th>Telepon</th>
							<th>Alamat</th>
							<th>
								<div class="row">
									<div class="col-md-6">
										Aksi
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
							</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							//Query menampilkan data pada tabel "pelanggan" 
							$query = $koneksi->query("SELECT * FROM pelanggan");
							//Membuat nomor urut
							$nomor = 1;
							//Menampilkan data
							while ($data = $query->fetch_assoc()){  
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $data['nama_pelanggan']; ?></td>
							<td><?php echo $data['email_pelanggan']; ?></td>
							<td><?php echo $data['user_pelanggan']; ?></td>
							<td><?php echo $data['password_pelanggan']; ?></td>
							<td><?php echo $data['telepon_pelanggan']; ?></td>
							<td><?php echo $data['alamat_pelanggan']; ?></td>
							<td>
								<a href="index.php?halaman=ubah-pelanggan&id=<?php echo $data['id_pelanggan']; ?>" class="btn btn-warning btn-sm"> Ubah</a>
								<a href="index.php?halaman=hapus-pelanggan&id=<?php echo $data['id_pelanggan']; ?>" class="btn-danger btn btn-sm"> Hapus</a>
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

