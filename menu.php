<?php
$queryMenu = mysqli_query($koneksi, "SELECT * FROM kategori_menu");


$resultUser = mysqli_query($koneksi, "SELECT * FROM menu
                                      INNER JOIN kategori_menu ON kategori_menu.id = menu.kategori");
// var_dump(mysqli_fetch_assoc($resultUser));
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
if (isset($_POST["tambahMenu"])) {
  // $fotoMenu = $_POST["fotoMenu"];
  $namaMenu = $_POST["namaMenu"];
  $keterangan = $_POST["keterangan"];
  $kategori = $_POST["kategori"];
  $harga = $_POST["harga"];
  $stok = $_POST["stok"];
  $foto = upload();
  if (!$foto) {
    return false;
  }

  $result = mysqli_query($koneksi, "INSERT INTO menu (foto,nama_menu,keterangan,kategori,harga,stok) VALUES('$foto','$namaMenu','$keterangan',$kategori,$harga,$stok)");
  if ($result) {
    echo "
    <script>
    alert('Data berhasil di Tambahkan')
    document.location='menu'
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Gagal menambahkan Data')
    document.location='menu'
    </script>
    ";
  }
}

// edit
if (isset($_POST["editMenu"])) {
  $id = $_POST["id_menu"];
  $namaMenu = $_POST["namaMenu"];
  $keterangan = $_POST["keterangan"];
  $kategori = $_POST["kategori"];
  $harga = $_POST["harga"];
  $stok = $_POST["stok"];
  $foto = upload();
  if (!$foto) {
    return false;
  }

  $result = mysqli_query($koneksi, "UPDATE menu SET 
                                  foto='$foto', 
                                  nama_menu='$namaMenu', 
                                  keterangan='$keterangan', 
                                  kategori=$kategori,
                                  harga=$harga ,
                                  stok=$stok
                                  WHERE  id_menu=$id;");

  if ($result) {
    echo "
    <script>
    alert('Data berhasil di Update')
    document.location='menu'
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Gagal Update Data')
    document.location='menu'
    </script>
    ";
  }
}

?>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <div><?= $_GET["halaman"]; ?></div>
    <div>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMenu">Tambah Menu</button>
      <!-- Modal Tambah Menu -->
      <div class="modal fade" id="tambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="formFile" class="form-label">Masukan Foto Menu</label>
                    <input class="form-control" type="file" id="formFile" required name="foto">
                    <div class="invalid-feedback">
                      masukkan foto Menu
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="namaMenu" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Nama Menu</label>
                    <div class="invalid-feedback">
                      Nama Menu belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="keterangan" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Keterangan</label>
                    <div class="invalid-feedback">
                      Keterangan Belum Masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <select class="form-select" id="mySelect" name="kategori" required>
                      <option value="">Pilih kategori ni bang</option>
                      <?php while ($Menu = mysqli_fetch_assoc($queryMenu)) : ?>
                        <option value="<?= $Menu["id"]; ?>"><?= $Menu["kategori_menu"]; ?></option>
                      <?php endwhile ?>
                    </select>
                    <div class="invalid-feedback">
                      Kategori belum Di masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="number" name="harga" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Harga</label>
                    <div class="invalid-feedback">
                      Harga Belum Masukkan
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="number" name="stok" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Stok</label>
                    <div class="invalid-feedback">
                      Stok Belum Masukkan
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="tambahMenu" class="btn btn-primary">Tambah Menu</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- End Modal Tambah Menu -->
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
            <th scope="col">Foto</th>
            <th scope="col">Menu</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jenis Menu</th>
            <th scope="col">Katagori</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
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
              <td><img width="30" src="src/img/menu/<?= $rowUser["foto"]; ?>" alt="<?= $rowUser["nama_menu"]; ?>"></td>
              <td><?= $rowUser["nama_menu"]; ?></td>
              <td><?= $rowUser["keterangan"]; ?></td>
              <td><?php echo ($rowUser["jenis_menu"] == 1) ? "Makanan" : "Minuman" ?></td>
              <td><?= $rowUser["kategori_menu"]; ?></td>
              <td><?= $rowUser["harga"]; ?></td>
              <td><?= $rowUser["stok"]; ?></td>
              <td class="d-flex">
                <button class="me-1 btn btn-info" data-bs-toggle="modal" data-bs-target="#viewMenu<?= $rowUser['id_menu']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                </button>
                <!-- Modal View User -->
                <div class="modal fade" id="viewMenu<?= $rowUser['id_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-floating mb-3 col-md-12 text-center">
                            <img width="120" src="src/img/menu/<?= $rowUser["foto"]; ?>" alt="<?= $rowUser["nama_menu"]; ?>">
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" readonly value="<?= $rowUser["nama_menu"]; ?>">
                            <label class="ms-2" for="floatingInput">nama menu</label>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" readonly value="<?= $rowUser["keterangan"]; ?>">
                            <label class="ms-2" for="floatingInput">keterangan</label>
                          </div>
                          <div class="form-floating mb-3 col-md-12">
                            <select class="form-select" id="mySelect" name="level" disabled>
                              <option value="<?= $rowUser["kategori"]; ?>">
                                <?php if ($rowUser["kategori"] == 1) {
                                  echo "nasi";
                                } elseif ($rowUser["kategori"] == 2) {
                                  echo "snack";
                                } elseif ($rowUser["kategori"] == 4) {
                                  echo "kopi";
                                } else {
                                  echo "air";
                                } ?>
                              </option>
                            </select>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" readonly value="<?= $rowUser["harga"]; ?>">
                            <label class="ms-2" for="floatingInput">Harga</label>
                          </div>
                          <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="nohp" class="form-control" id="floatingInput" placeholder="name@example.com" readonly value="<?= $rowUser["stok"]; ?>">
                            <label class="ms-2" for="floatingInput">Stok</label>
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
                <button class="me-1 btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMenu<?= $rowUser['id_menu']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </button>
                <!-- Modal Edit User -->
                <div class="modal fade" id="editMenu<?= $rowUser['id_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                          <input class="form-control" type="text" id="formFile" name="id_menu" value="<?= $rowUser["id_menu"]; ?>" hidden>
                          <div class="row">
                            <div class="form-floating mb-3 col-md-12 text-center">
                              <img width="120" src="src/img/menu/<?= $rowUser["foto"]; ?>" alt="<?= $rowUser["nama_menu"]; ?>">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="formFile" class="form-label">Masukan Foto Menu</label>
                              <input class="form-control" type="file" id="formFile" name="foto" value="<?= $rowUser["foto"]; ?>">
                              <div class="invalid-feedback">
                                masukkan foto Menu
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="namaMenu" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser["nama_menu"]; ?>">
                              <label class="ms-2" for="floatingInput">Nama Menu</label>
                              <div class="invalid-feedback">
                                Nama Menu belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="keterangan" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser["keterangan"]; ?>">
                              <label class="ms-2" for="floatingInput">Keterangan</label>
                              <div class="invalid-feedback">
                                Keterangan Belum Masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <select class="form-select" id="mySelect" name="kategori" required>
                                <option value="<?= $rowUser["kategori"]; ?>">
                                  <?php if ($rowUser["kategori"] == 1) {
                                    echo "nasi";
                                  } elseif ($rowUser["kategori"] == 2) {
                                    echo "snack";
                                  } elseif ($rowUser["kategori"] == 4) {
                                    echo "kopi";
                                  } else {
                                    echo "air";
                                  } ?>
                                </option>
                                <?php
                                $ucok = mysqli_query($koneksi, "SELECT * FROM kategori_menu");
                                while ($Menu = mysqli_fetch_assoc($ucok)) : ?>
                                  <option value="<?= $Menu["id"]; ?>"><?= $Menu["kategori_menu"]; ?></option>
                                <?php endwhile ?>
                              </select>
                              <div class="invalid-feedback">
                                Kategori belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="number" name="harga" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser["harga"]; ?>">
                              <label class="ms-2" for="floatingInput">Harga</label>
                              <div class="invalid-feedback">
                                Harga Belum Masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="number" name="stok" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser["stok"]; ?>">
                              <label class="ms-2" for="floatingInput">Stok</label>
                              <div class="invalid-feedback">
                                Stok Belum Masukkan
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="editMenu" class="btn btn-primary">edit Menu</button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- End Modal Edit User -->

                <button class="me-1 btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMenu<?= $rowUser['id_menu']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>

                <!-- delete -->
                <div class="modal fade" id="deleteMenu<?= $rowUser['id_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="proses/deleteMenu.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                          <input class="form-control" type="text" id="formFile" name="id_menu" value="<?= $rowUser["id_menu"]; ?>" hidden>
                          <input class="form-control" type="text" id="formFile" name="foto" value="<?= $rowUser["foto"]; ?>" hidden>
                          <div class="row">
                            <div class="form-floating mb-3 col-md-12 text-center">
                              <div class="alert alert-danger" role="alert">
                                Yakin menghapus Menu <b><?= $rowUser["nama_menu"]; ?></b>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="deleteMenu" class="btn btn-danger">Delete Menu</button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

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