<?php include 'atas.php' ?>

<div class="row">
  <!-- Overview -->
  <div class="col-lg-6 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-10 col-sm-10 mb-4">
            <h5>Selamat Datang</h5>
            <!-- <?php foreach ($users as $key => $value) : ?>
              <h5>Selamat Datang, <?= $value['nama_karyawan'] ?>!</h5>
              <span>Username : <?= $value['email'] ?></span>
            <?php endforeach ?> -->
          </div>
          <div class="col-lg-2 col-sm-2 mb-4" align="right">
            <i class="menu-icon tf-icons ti ti-user" style="font-size: 60px;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Overview -->

  <!-- Overview -->
  <div class="col-lg-6 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-sm-6 mb-4">
            <h5>Jumlah Karyawan</h5>
            <span><?= count($karyawan) ?> Orang</span>
          </div>
          <div class="col-lg-6 col-sm-6 mb-4" align="right">
            <i class="menu-icon tf-icons ti ti-user" style="font-size: 60px;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Overview -->
</div>

<?php include 'bawah.php' ?>