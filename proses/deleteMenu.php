<?php
require 'koneksi.php';
$id = $_POST["id_menu"];
$foto = $_POST["foto"];
$result = mysqli_query($koneksi, "DELETE FROM menu WHERE id_menu=$id");
if ($result) {
  unlink("../src/img/menu/$foto");
  echo "
      <script>
      alert('Hapus data berhasil')
      document.location='../menu'
      </script>
      ";
} else {
  echo "
      <script>
      alert('Gagal Menghapus Data')
      document.location='../menu'
      </script>
      ";
}
