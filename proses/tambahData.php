<?php
require 'koneksi.php';
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

$result = mysqli_query($koneksi, "INSERT INTO user (nama,username,level,nohp,alamat) VALUES
                                  ('$nama','$username',$level,'$nohp','$alamat')");
if ($result) {
  echo "
    <script>
    alert('Data berhasil di Tambahkan')
    document.location='../user'
    </script>
    ";
} else {
  echo "
    <script>
    alert('Gagal menambahkan Data')
    document.location='../user'
    </script>
    ";
}
