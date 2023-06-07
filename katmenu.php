<?php
$queryMenu = mysqli_query($koneksi, "SELECT * FROM kategori_menu");

$resultUser = mysqli_query($koneksi, "SELECT * FROM kategori_menu");
// var_dump(mysqli_fetch_assoc($resultUser));
$resulty = [];
while ($record = mysqli_fetch_assoc($resultUser)) {
  $ulu[] = $record;
}
if (isset($_POST["tambahkategori"])) {
  // $fotoMenu = $_POST["fotoMenu"];
  $kategoriMenu = $_POST["kategoriMenu"];
  $jenisMenu = $_POST["jenisMenu"];

  $query = mysqli_query($koneksi, "SELECT * FROM kategori_menu WHERE kategori_menu = '$kategoriMenu'");

  if (mysqli_num_rows($query) > 0) {
    echo "
    <script>
    alert('Menu sudah ada')
    document.location='katmenu'
    </script>
    ";
    exit();
  }

  $result = mysqli_query($koneksi, "INSERT INTO kategori_menu (jenis_menu,kategori_menu) VALUES($jenisMenu,'$kategoriMenu')");
  if ($result) {
    echo "
    <script>
    alert('Data berhasil di Tambahkan')
    document.location='katmenu'
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Gagal menambahkan Data')
    document.location='katmenu'
    </script>
    ";
  }
}

// edit
if (isset($_POST["editKategori"])) {
  $id = $_POST["id"];
  $kategoriMenu = $_POST["kategoriMenu"];
  $jenisMenu = $_POST["jenisMenu"];

  $result = mysqli_query($koneksi, "UPDATE kategori_menu SET 
                                  jenis_menu=$jenisMenu, 
                                  kategori_menu='$kategoriMenu'
                                  WHERE  id=$id;");

  if ($result) {
    echo "
    <script>
    alert('Data berhasil di Update')
    document.location='katmenu'
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Gagal Update Data')
    document.location='katmenu'
    </script>
    ";
  }
}

?>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <div><?= $_GET["halaman"]; ?></div>
    <div>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategori">Tambah Kategori</button>
      <!-- Modal Tambah Kategori -->
      <div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <div class="form-floating">
                      <select name="jenisMenu" class="form-select" id="mySelect" required>
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                      </select>
                      <label for="floatingInput" class="form-label">Jenis Menu</label>
                    </div>
                    <div class="invalid-feedback">
                      masukkan Jenis menu
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-md-6">
                    <input type="text" name="kategoriMenu" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label class="ms-2" for="floatingInput">Kategori Menu</label>
                    <div class="invalid-feedback">
                      Kategori Menu belum Di masukkan
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="tambahkategori" class="btn btn-primary">Tambah Kategori</button>
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
            <th scope="col">Jenis Menu</th>
            <th scope="col">Kategori Menu</th>
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
              <td><?php echo ($rowUser["jenis_menu"] == 1) ? "Makanan" : "Minuman" ?></td>
              <td><?= $rowUser["kategori_menu"]; ?></td>
              <td class="d-flex">
                <button class="me-1 btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMenu<?= $rowUser['id']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </button>
                <!-- Modal Edit menu -->
                <div class="modal fade" id="editMenu<?= $rowUser['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                          <input type="text" name="id" value="<?= $rowUser["id"]; ?>" hidden>
                          <div class="row">
                            <div class="form-floating mb-3 col-md-6">
                              <select class="form-select" id="mySelect" name="jenisMenu" required>
                                <?php
                                $data = array("Makanan", "Minuman");
                                foreach ($data as $key => $value) {
                                  if ($rowUser["jenis_menu"] == $key + 1) {
                                    echo "<option selected value='$key'>$value</option>";
                                  } else {
                                    echo "<option value='$key'>$value</option>";
                                  }
                                }
                                ?>
                              </select>
                              <div class="invalid-feedback">
                                Jenis Menu belum Di masukkan
                              </div>
                            </div>
                            <div class="form-floating mb-3 col-md-6">
                              <input type="text" name="kategoriMenu" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser["kategori_menu"]; ?>">
                              <label class="ms-2" for="floatingInput">Kategori Menu</label>
                              <div class="invalid-feedback">
                                Nama Menu belum Di masukkan
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="editKategori" class="btn btn-primary">edit Kategori</button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- End Modal Edit User -->

                <button class="me-1 btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteKategori<?= $rowUser['id']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>

                <!-- delete -->
                <div class="modal fade" id="deleteKategori<?= $rowUser['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Kategori</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="proses/deleteKategori.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                          <input class="form-control" type="text" id="formFile" name="id" value="<?= $rowUser["id"]; ?>" hidden>
                          <div class="row">
                            <div class="form-floating mb-3 col-md-12 text-center">
                              <div class="alert alert-danger" role="alert">
                                Yakin menghapus Kategori <b><?= $rowUser["kategori_menu"]; ?></b>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="deleteMenu" class="btn btn-danger">Delete Kategori</button>
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