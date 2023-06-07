<?php
// session_start();
if (isset($_POST["gantiPassword"])) {
  $id = $row["id"];
  $passwordlama = md5($_POST["PasswordLama"]);
  $passwordDB = $row["password"];
  $password = md5($_POST["password"]);
  $cofirmPassword = md5($_POST["cofirmPassword"]);
  if ($passwordDB != $passwordlama) {
    $_SESSION["ubahpassword"] = '<p id="nama" class="text-danger">password lama Anda salah</p>';
  } else {
    if ($password == $cofirmPassword) {
      $querypw = mysqli_query($koneksi, "UPDATE user SET password = '$password' WHERE id=$id");
      if ($querypw) {
        $_SESSION["ubahpassword"] = '<p id="nama" class="text-success">password berhasil di ganti</p>';
      } else {
        $_SESSION["ubahpassword"] = '<p id="nama" class="text-danger">Gagal ganti password</p>';
      }
    } else {
      $_SESSION["ubahpassword"] = '<p id="nama" class="text-danger">Password does not match!</p>';
    }
  }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary container-fluid sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="."> <img width="40" src="src/img/kupi.png" alt=""> DECOFEE</a>
    <div class="position-absolute" style="right:0px; margin-right: 2rem;">
      <a class="nav-link link-light dropdown-toggle opacity-50 me-md-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?= $row["username"]; ?>
      </a>
      <ul class="dropdown-menu ">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ubahpassword">Ubah password</a></li>
        <li><a class="dropdown-item" href="proses/logout.php">Logout</a></li>
      </ul>
      </li>
    </div>
  </div>
</nav>
<!-- modal ubah password -->
<div class="modal fade" id="ubahpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="needs-validation" novalidate>
          <div class="row">
            <div class="form-floating mb-3 col-md-6">
              <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" readonly value="<?= $row["username"]; ?>">
              <label class="ms-2" for="floatingInput">username</label>
              <div class="invalid-feedback">
                Username belum Di masukkan
              </div>
            </div>
            <div class="form-floating mb-3 col-md-6">
              <input type="password" name="PasswordLama" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label class="ms-2" for="floatingInput">Password lama</label>
              <div class="invalid-feedback">
                Password lama belum Di masukkan
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <p style="font-size: 14px; color: gray;" class="mb-2 opacity-75">Password Baru</p>
            </div>
            <div class="form-floating mb-3 col-md-6">
              <input type="password" name="password" class="form-control" id="password" placeholder="name@example.com" required>
              <label class="ms-2" for="floatingInput">Password</label>
              <div class="invalid-feedback">
                Password belum Di masukkan
              </div>
            </div>
            <div class="form-floating mb-3 col-md-6">
              <input type="password" name="cofirmPassword" class="form-control" id="confirmPassword" placeholder="name@example.com" required>
              <label class="ms-2" for="floatingInput">Confirm Password</label>
              <div class="invalid-feedback">
                Confirm Password belum Di masukkan
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button id="button" type="submit" name="gantiPassword" class="btn btn-primary">Ganti Password</button>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- End modal ubah password -->