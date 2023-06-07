<?php
require 'koneksi.php';
$id = $_POST["id"];
$result = mysqli_query($koneksi, "DELETE FROM kategori_menu WHERE id=$id");
if ($result) {
  echo "
      <script>
      alert('Hapus Kategori berhasil')
      document.location='../katmenu'
      </script>
      ";
} else {
  echo "
      <script>
      alert('Gagal Menghapus Kategori')
      document.location='../katmenu'
      </script>
      ";
}
