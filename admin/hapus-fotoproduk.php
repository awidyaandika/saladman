<?php 
	$id_foto = $_GET["idfoto"];
	$id_produk = $_GET["idproduk"];

	//ambil data
	$queryfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_foto_produk='$id_foto'");
	$detailfoto = $queryfoto->fetch_assoc();

	$namafilefoto = $detailfoto["nama_produk_foto"];
	//hapus file foto dari folder
	unlink("../foto_produk".$namafilefoto);


	//menghapus data di mysql
	$koneksi ->query("DELETE FROM produk_foto WHERE id_foto_produk='$id_foto'");

	echo "<script>alert('Foto Produk terhapus!');</script>";
	echo "<script>location='index.php?halaman=detail-produk&id=$id_produk';</script>";
?>