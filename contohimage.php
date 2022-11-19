<?php 
//Databse Connection file
include('config/koneksi.php');
if(isset($_POST['submit'])){
  //getting the post values
  $nama=$_POST['nama'];
  $pemilik=$_POST['pemilik'];
  $merk=$_POST['merk'];
  $tanggal=$_POST['tanggal'];
  $deskripsi=$_POST['deskripsi'];
  $status = $_POST['status'];
  $foto=$_FILES["foto"]["name"];
  // get the image extension
  $extension = substr($foto,strlen($foto)-4,strlen($foto));
  // allowed extensions
  $allowed_extensions = array(".jpg","jpeg",".png",".gif");
  // Validation for allowed extensions .in_array() function searches an array for a specific value.
  if(!in_array($extension,$allowed_extensions))
  {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
  } else {
    //rename the image file
    $imgnewfile=md5($foto).time().$extension;
    // Code for move image into directory
    move_uploaded_file($_FILES["foto"]["tmp_name"],"dbimg/".$imgnewfile);
    // Query for data insertion
    $query=mysqli_query($koneksi, "INSERT INTO showroom(nama_mobil, pemilik_mobil, merk_mobil, tanggal, deskripsi, foto_mobil, status_pembayaran) 
    value('$nama', '$pemilik', '$merk', '$tanggal', '$deskripsi', '$foto', '$status')");
    if ($query) {
      echo "<script>alert('You have successfully inserted the data');</script>";
      echo "<script type='text/javascript'> document.location ='myshowroom.php'; </script>";
    } else{
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
  }
}
?>