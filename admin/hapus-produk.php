<?php
	//Query mengamil data pada tabel "produk" berdasarkan id_produk
	$query = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$data  = $query->fetch_assoc();

	//Mengapus foto pada "folder foto_produk"
	$fotoproduk = $data['foto_produk'];
	if(file_exists("../foto_produk/$fotoproduk")){
		unlink("../foto_produk/$fotoproduk");
	}
	//Query menghapus data pada tabel "produk" berdasarkan id_produk
	$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

	echo "<script>alert('Produk terhapus!');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
?>