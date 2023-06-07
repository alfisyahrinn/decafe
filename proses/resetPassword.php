<?php
require 'koneksi.php';
$id = $_GET["id"];

$result = mysqli_query($koneksi, "UPDATE user SET password = '202cb962ac59075b964b07152d234b70' WHERE  id=$id;");

if ($result) {
  echo "
    <script>
    alert('Reset password berhasil')
    document.location='../user'
    </script>
    ";
} else {
  echo "
    <script>
    alert('Gagal Reset Password')
    document.location='../user'
    </script>
    ";
}
