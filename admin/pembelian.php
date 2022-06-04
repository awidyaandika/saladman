<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data Pembelian</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>No</th>
							<th>Nama Pelanggan</th>
							<th>Tanggal</th>
							<th>Total</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php
							//Query Inner Join pada tabel "pembelian" dan "pelanggan" untuk menampilkan nama pelanggan pada tabel "pelanggan" dan menampilkan tanggal pembelian dan total pembelian pada tabel "pembelian"
							$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
								                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
							//Membuat nomor urut
							$nomor = 1; 
							//Menampilkan data
							while($data = $query->fetch_assoc()){
						?> 
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $data['nama_pelanggan']; ?></td>
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
								<a href="index.php?halaman=detail&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info btn-sm">Detail</a>
								
								<a href="index.php?halaman=pembayaran&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-success btn-sm">Konfirmasi</a>
								
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