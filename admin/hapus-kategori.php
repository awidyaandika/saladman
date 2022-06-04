<?php
	//Query mengamil data pada tabel "kategori" berdasarkan id_kategori
	$query = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
	$data  = $query->fetch_assoc();

	//Query menghapus data pada tabel "kategori" berdasarkan id_kategori
	$koneksi->query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

	echo "<script>alert('Kategori terhapus!');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
?>