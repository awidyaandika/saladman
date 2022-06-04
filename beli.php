<?php
	session_start();
	//Mendapat id_produk dari url
	$id_produk = $_GET['id'];

	//Jika suda ada produk dikeranjang, maka produk itu jumlahnya di +1 
	if(isset($_SESSION['keranjang'][$id_produk])){
		$_SESSION['keranjang'][$id_produk] +=1;
	}
	//Jika blm ada produk dikeranjang, maka produk itu 1
	else{
		$_SESSION['keranjang'][$id_produk] = 1;
	}

	// echo "<pre>";
	// print_r($_SESSION);
	// echo "</pre>";
	echo "<script>alert('Produk ditambahkan ke keranjang belanja!')</script>";
	echo "<script>location='keranjang.php'</script>";
?>