<?php

$resultUser = mysqli_query($koneksi, "SELECT * FROM user");
$resulty = [];
while ($record = mysqli_fetch_assoc($resultUser)) {
  $ulu[] = $record;
}

function upload()
{
  //mengambil data dari $_FILES
  $namaFile = $_FILES["foto"]["name"];
  $size = $_FILES["foto"]["size"];
  $tmpName = $_FILES["foto"]["tmp_name"];
  $error = $_FILES["foto"]["error"];
  //Cek apakah foto ada di upload
  // 0 = ada, 4 = tidakada, -1=error;

  //cek apakah yang di upload foto atau bukan
  $fotoBenar = ['jpg', 'jpeg', 'png'];
  $ekstensiFoto = explode('.', $namaFile);
  $ekstensiFoto = strtolower(end($ekstensiFoto));
  if (!in_array($ekstensiFoto, $fotoBenar)) {
    echo "
          <script>
          alert('Masukkna file jpg, jpeg atau png!');
          document.location='menu'
          </script>
      ";
    return false;
  }

  //jika file foto terlalu besar
  // if ($size > 1000000) {
  //   echo "
  //           <script>
  //           alert('Ukuran foto kegedean Max 1mb');
  //           </script>
  //       ";
  //   return false;
  // }

  //lolos pengecekan gambar siap upload
  //generate nama file baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFoto;
  move_uploaded_file($tmpName, 'src/img/menu/' . $namaFileBaru);
  return $namaFileBaru;
}
?>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <div><?= $_GET["halaman"]; ?></div>
    <div>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah User</button>
      <!-- Modal Tambah User -->
      <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="proses/tambahData.php" method="post" class="needs-validation" novalidate>
                <div class="row">
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Nama</label>
                    <div class="invalid-feedback">
                      Nama belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">username</label>
                    <div class="invalid-feedback">
                      Username belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">nohp</label>
                    <div class="invalid-feedback">
                      No belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <select class="form-select" id="mySelect" name="level" required>
                      <option value="">Pilih Level</option>
                      <option value="1">Owner/Admin</option>
                      <option value="2">Kasir</option>
                      <option value="3">Pelayan</option>
                      <option value="4">Dapur</option>
                    </select>
                    <div class="invalid-feedback">
                      Level belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-12">
                    <textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                    <label class="ms-2" for="floatingTextarea2">Alamat</label>
                    <div class="invalid-feedback">
                      Alamat belum Di masukkan
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Tambah User -->
    </div>

  </div>
  <div class="card-body">
    <div class="table-responsive">
      <?php if (!empty($_SESSION["ubahpassword"])) { ?>
        <?= $_SESSION["ubahpassword"]; ?>
      <?php } ?>
      <script>
        var nama = document.getElementById('nama')
        setTimeout(() => {
          nama.style.display = 'none'
        }, 5000);
      </script>
      <table id="table_id" class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Level</th>
            <th scope="col">No Hp</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($ulu as $rowUser) :
          ?>
            <tr>
              <th scope="row"><?= $no; ?></th>
              <td><?= $rowUser["nama"]; ?></td>
              <td><?= $rowUser["username"]; ?></td>
              <td><?= $rowUser["level"]; ?></td>
              <td><?= $rowUser["nohp"]; ?></td>
              <td class="d-flex">
                <button class="me-1 btn btn-info" data-bs-toggle="modal" data-bs-target="#viewData<?= $rowUser['id']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                </button>
                <!-- Modal View User -->
                <div class="modal fade" id="viewData<?= $rowUser['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?= $rowUser["nama"]; ?>" readonly>
                            <label class="ms-2" for="floatingInput">Nama</label>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?= $rowUser["username"]; ?>" readonly>
                            <label class="ms-2" for="floatingInput">username</label>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?= $rowUser["nohp"]; ?>" readonly>
                            <label class="ms-2" for="floatingInput">nohp</label>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <select class="form-select" id="mySelect" name="level">
                              <option value="<?= $rowUser["level"]; ?>">
                                <?php if ($rowUser["level"] == 1) {
                                  echo "Owner/Admin";
                                } elseif ($rowUser["level"] == 2) {
                                  echo "kasir";
                                } elseif ($rowUser["level"] == 3) {
                                  echo "pelayan";
                                } else {
                                  echo "dapur";
                                } ?>
                              </option>
                            </select>
                          </div>
                          <div class="form-floating mb-3 col-md-12">
                            <textarea readonly name="alamat" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?= $rowUser["alamat"]; ?></textarea>
                            <label class="ms-2" for="floatingTextarea2">Alamat</label>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal View User -->
                <button class="me-1 btn btn-warning" data-bs-toggle="modal" data-bs-target="#editData<?= $rowUser['id']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </button>
                <!-- Modal Edit User -->
                <div class="modal fade" id="editData<?= $rowUser['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="proses/editData.php" method="post" class="needs-validation" novalidate>
                          <div class="row">
                            <input type="hidden" name="id" value="<?= $rowUser['id']; ?>">
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser['nama']; ?>">
                              <label class="ms-2" for="floatingInput">Nama</label>
                              <div class="invalid-feedback">
                                Nama belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser['username']; ?>" <?php echo ($rowUser['username'] == 'admin') ? 'readonly' : ''; ?>>
                              <label class="ms-2" for="floatingInput">username</label>
                              <div class="invalid-feedback">
                                Username belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser['nohp']; ?>">
                              <label class="ms-2" for="floatingInput">nohp</label>
                              <div class="invalid-feedback">
                                No belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <select class="form-select" id="mySelect" name="level" required>
                                <?php
                                $data = array("owner/admin", "kasir", "pelayan", "dapur");
                                foreach ($data as $key => $value) {
                                  if ($rowUser["level"] == $key + 1) {
                                    echo "<option selected value='$key'>$value</option>";
                                  } else {
                                    echo "<option value='$key'>$value</option>";
                                  }
                                }
                                ?>
                              </select>
                              <div class="invalid-feedback">
                                Level belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-12">
                              <textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required><?= $rowUser['alamat']; ?></textarea>
                              <label class="ms-2" for="floatingTextarea2">Alamat</label>
                              <div class="invalid-feedback">
                                Alamat belum Di masukkan
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Edit User -->
                <a href="proses/deleteData.php?id=<?= $rowUser['id']; ?>">
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData" onclick="return confirm('Apakah Anda yakin akan menghapus aku ini <?= $rowUser['username']; ?> ?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                  </button>
                </a>
                <!-- reset password -->
                <a href="proses/resetPassword.php?id=<?= $rowUser['id']; ?>">
                  <button class="btn btn-secondary ms-1" data-bs-toggle="modal" data-bs-target="#deleteData" onclick="return confirm('Password akan di reset menjadi 123, Yakin reset?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                      <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                      <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </button>
                </a>
                <!-- End reset password -->

                <!-- Modal Edit User -->
                <!-- End Modal Edit User -->
              </td>
            </tr>
          <?php
            $no++;
          endforeach
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>