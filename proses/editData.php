<?php
require 'koneksi.php';
$id = $_POST["id"];
$nama = $_POST["nama"];
$username = $_POST["username"];
$level = $_POST["level"];
$nohp = $_POST["nohp"];
$alamat = $_POST["alamat"];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

if (mysqli_num_rows($query) > 0) {
  echo "
    <script>
    alert('Username Telah Di gunakan')
    document.location='../user'
    </script>
    ";
  exit();
}

$result = mysqli_query($koneksi, "UPDATE user SET 
                                  nama='$nama', 
                                  username='$username', 
                                  level=$level, 
                                  nohp='$nohp',
                                  alamat='$alamat' 
                                  WHERE  id=$id;");

if ($result) {
  echo "
    <script>
    alert('Data berhasil di Update')
    document.location='../user'
    </script>
    ";
} else {
  echo "
    <script>
    alert('Gagal Update Data')
    document.location='../user'
    </script>
    ";
}
