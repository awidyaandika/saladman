<style type="text/css" media="print">
	.print{
		visibility: hidden;
	}
	.kembali{
		visibility: hidden;
	}
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Detail Pembelian</h3>
        </div>
        <div class="card-body">
           <?php 
				//Query Inner Join pada tabel "pembelian" dan tabel "pelanggan"
				$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
					                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan
					                      WHERE pembelian.id_pembelian = '$_GET[id]'");
				$detail = $query->fetch_assoc();
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
        <div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">							
						<!-- <button class="print btn btn-info btn-sm" onclick="window.print();return false;">Print</button> -->
						<a href="print-detail.php?id=<?php echo $detail['id_pembelian']; ?>" class="print btn btn-info btn-sm">Print</a>
						<a href="index.php?halaman=pembelian" class="kembali btn btn-primary btn-sm">Kembali</a>						
					</div>
				</div>
			</div>
		</div>
    </div>
</div>