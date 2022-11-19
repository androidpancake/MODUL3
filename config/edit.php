<?php
    include 'koneksi.php';

        $id_mobil = $_POST['id_mobil'];
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
            $sqlquery = "UPDATE showroom SET nama_mobil = '$nama', pemilik_mobil = '$pemilik', merk_mobil = '$merk', tanggal = '$tanggal', deskripsi = $deskripsi', foto_mobil = '$foto', status_pembayaran = '$status', WHERE id_mobil = '$id'";
            
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
?>