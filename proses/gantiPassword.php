<?php
require 'koneksi.php';
$id = $_POST["id"];
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE id=$id");
