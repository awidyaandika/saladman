<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Saladman</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="container">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			    <li class="nav-item active">
			    	<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			    </li>
			    <li class="nav-item">
			        <a class="nav-link" href="keranjang.php">Keranjang</a>
			    </li>
			    <!-- Jika sudah login -->
			    <?php if(isset($_SESSION['pelanggan'])) : ?>
			    	<li class="nav-item">
			        	<a class="nav-link" href="checkout.php">Checkout</a>
			    	</li>
			    	<li class="nav-item">
			        	<a class="nav-link" href="riwayat.php">Riwayat Transaksi</a>
			    	</li>
			    <!-- Jika belum login -->
			    <?php else : ?>
					<li class="nav-item">
				    	<a class="nav-link" href="daftar.php">Daftar</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="login.php">Login</a>
				    </li>
				<?php endif ?>
			</ul>

			<!-- Jika sudah login -->
			<?php if(isset($_SESSION['pelanggan'])) : ?>
			<ul class="navbar-nav">
			    <li class="nav-item">
			        <a class="nav-link" href="home.php"><?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></a>
			    </li>
			    <li class="nav-item">
			        <a class="nav-link" href="logout.php">Logout</a>
			    </li>
			</ul>
			<?php endif ?>
			<form class="form-inline my-2 my-lg-0" action="pencarian.php" method="get">
				<input class="form-control mr-sm-2" type="search" name="keyword" placeholder="" aria-label="Search">
			    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
			</form>
		</div>
	</div>
</nav>