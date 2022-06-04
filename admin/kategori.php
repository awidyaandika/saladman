<?php
    $semuadata  = array();
    $query      = $koneksi->query("SELECT * FROM kategori");
    while($data = $query->fetch_assoc())
    {
        $semuadata[] = $data;
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Kategori Produk</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($semuadata as $key =>$value): ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td><?php echo $value["nama_kategori"] ?></td>
                                <td>
                                    <a href="index.php?halaman=ubah-kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="index.php?halaman=hapus-kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <a href="index.php?halaman=tambah-kategori" class="btn btn-success btn-sm">Tambah Data</a>
            </div>
        </div>
    </div>
</div>
