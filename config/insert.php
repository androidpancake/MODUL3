<?php
    include_once '../config/koneksi.php';

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $pemilik = $_POST['pemilik'];
        $merk = $_POST['merk'];
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        $status = $_POST['status'];

        // gambar
        $foto = $_FILES['foto']['name'];

        $extension = pathinfo($foto, PATHINFO_EXTENSION); //ekstensi 

        $allowed_extension = array('.jpg', '.png'); //format yang diperbolehkan

        //nama foto baru
        $imgnewfile=md5($foto).time().$extension;  //untuk mengacak nama foto (agar tidak sama ketika dipasang)

        // validasi gambar
        if(!in_array($extension, $allowed_extension)){ //jika tidak sesuai
            echo "<script>alert('invalid format file')</script>";
        } else {
            //pindah file foto
            move_uploaded_file($_FILES['foto']['tmp_name'], "../dbimg/" .$imgnewfile);
            //query
            $sqlquery = "INSERT INTO showroom(nama_mobil, pemilik_mobil, merk_mobil, tanggal, deskripsi, foto_mobil, status_pembayaran)
            VALUE ('$nama', '$pemilik', '$merk', '$tanggal', '$deskripsi', '$foto', '$status')";
            
            //jalankan query
            $query = mysqli_query($koneksi, $sqlquery);
            
            //check query
            if ($query) {
                echo "<script>alert('Data telah ditambahkan')</script>";
                echo "<meta http-equiv='refresh' content='1 url=../myshowroom.php'>";
                // header('Location: ../myshowroom.php?status=sukses');
            } else {
                echo "<script>alert('Data gagal ditambahkan')</script>";
                header('Location: ../add.php?status=gagal');
            }
        }
    } else {
        die("ngawur");
    }
?>