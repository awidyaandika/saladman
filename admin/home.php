<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Selamat datang <?php echo $_SESSION['admin']['nama_lengkap'] ?></h3>
        </div>
        <div class="card-body">
            <pre>
				<?php print_r($_SESSION);?>         
            </pre>
        </div>
    </div>
</div> 

