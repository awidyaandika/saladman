<?php
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
<style type="text/css">
    .lihat{
        margin-bottom: 10px;
    }
</style>
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
                <a href="print-laporan-pembelian.php" class="print btn btn-info btn-sm">Print</a>
            </div>
        </div>
    </div>
</div>