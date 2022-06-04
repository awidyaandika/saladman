<?php
	//Query mengamil data pada tabel "pelanggan" berdasarkan id_pelanggan
	$query = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	$data  = $query->fetch_assoc();

	//Query menghapus data pada tabel "pelanggan" berdasarkan id_pelanggan
	$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

	echo "<script>alert('pelanggan terhapus!');</script>";
	echo "<script>location='index.php?halaman=pelanggan';</script>";
?>