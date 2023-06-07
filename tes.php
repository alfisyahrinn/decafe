<!-- Modal View User -->
<div class="modal fade" id="viewData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Edit User -->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required value="<?= $rowUser['username']; ?>">
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