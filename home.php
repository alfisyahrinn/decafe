<style>
  .card-total {
    color: red;
    width: 100%;
    height: 170px;
    background: rgba(13, 110, 253, 0.28);
    border-radius: 30px;
    display: flex;
  }

  .card-total h1 {
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 27px;
    color: #0067FF;
  }

  .card-total p {
    font-style: normal;
    font-weight: 700;
    font-size: 40px;
    line-height: 60px;
    color: #0067FF;
  }
</style>

<?php
$user = mysqli_query($koneksi, "SELECT * FROM user");
$menu = mysqli_query($koneksi, "SELECT * FROM menu");
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori_menu");
?>

<div class="card-body">
  <div class="row">
    <div class="col-6 mb-4">
      <div class="card-total">
        <div class="m-auto">
          <h1>Jumlah User</h1>
          <p class="text-center"><?php echo mysqli_num_rows($user) ?></p>
        </div>
      </div>
    </div>
    <div class="col-6 mb-4">
      <div class="card-total">
        <div class="m-auto">
          <h1>Jumlah Menu</h1>
          <p class="text-center"><?php echo mysqli_num_rows($menu) ?></p>
        </div>
      </div>
    </div>
    <div class="col-6 mb-4">
      <div class="card-total">
        <div class="m-auto">
          <h1>Jumlah Kategori</h1>
          <p class="text-center"><?php echo mysqli_num_rows($kategori) ?></p>
        </div>
      </div>
    </div>
  </div>
</div>