<?php
    $koneksi = mysqli_connect("localhost", "root", "", "modul3");

    if(!$koneksi){
        die("<p>koneksi gagal</p>" . mysqli_connect_error());
    }
?>