<?php
	session_start(); 
	include '../koneksi.php';

	$semuadata   = array();
    $tgl_mulai   = "-";
    $tgl_selesai = "-";
    
    if(isset($_POST["kirim"]))
    {
        $tgl_mulai = $_POST["tglm"];
        $tgl_selesai = $_POST["tgls"];
        $query=$koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan
        WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
        while ($data = $query->fetch_assoc())
        {
            $semuadata[]=$data;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Kebun Mimba | Print Detail</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<style type="text/css" media="print">
			.print{
				visibility: hidden;
			}
			.lihat{
				visibility: hidden;
			}
			.kembali{
				visibility: hidden;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
		    <!-- Page Heading -->
		    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
		    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
		    <div class="card shadow mb-4">
		        <div class="card-header py-3">
		            <h3 class="m-0 font-weight-bold text-primary">Laporan Pembelian dari <?php echo $tgl_mulai?> sampai <?php echo $tgl_selesai ?></h3>
		        </div>
		        <div class="card-body">
		            <form method="post">
		                <div class="row">
		                    <div class="col-md-5">
		                        <div class="form-group">
		                            <label> Tanggal Mulai</label>
		                            <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
		                        </div>
		                    </div>
		                    <div class="col-md-5">
		                        <div class="form-group">
		                            <label> Tanggal Selesai</label>
		                            <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <label>&nbsp;</label><br>
		                        <button class="lihat btn btn-primary" name="kirim">Lihat</button>
		                    </div>
		                </div>
		            </form>
		            <div class="table-responsive">
		                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
		                    <thead>
		                        <tr>
		                            <th>No</th>
		                            <th>Pelanggan</th>
		                            <th>Tanggal</th>
		                            <th>Jumlah</th>
		                            <th>Status</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <?php $total = 0; ?>
		                            <?php foreach ($semuadata as $key =>$value): ?>
		                            <?php $total += $value['total_pembelian'] ?>
		                            <tr>
		                                <td><?php echo $key+1; ?></td>
		                                <td><?php echo $value["nama_pelanggan"] ?></td>
		                                <td><?php echo $value["tanggal_pembelian"] ?></td>
		                                <td>Rp. <?php echo number_format ($value["total_pembelian"]) ?></td>
		                                <td><?php echo $value["status_pembelian"] ?></td>
		                            </tr>
		                            <?php endforeach ?>
		                    </tbody>
		                    <tfoot>
		                        <tr>
		                            <th colspan="3">Total</th>
		                            <th>Rp. <?php echo number_format($total) ?></th>
		                            <th> </th>
		                        </tr>
		                    </tfoot>
		                </table>
		                <button class="print btn btn-info btn-sm" onclick="window.print();return false;">Print</button>
		                <button class="print btn btn-primary btn-sm" onclick="history.back()">Kembali</button>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>