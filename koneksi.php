<?php
    $koneksi = mysqli_connect("localhost", "root", "", "saladman");
    // Check koneksi DB
    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>