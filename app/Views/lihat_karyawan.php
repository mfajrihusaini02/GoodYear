<?php include 'atas.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Detail Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <a href="../daftar_karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4" align="middle">
                            <span>Ini Foto</span>
                            <img src="<?= $detail_karyawan['foto']; ?>" class="img-fluid rounded-start" alt="">
                        </div>
                        <div class="col-md-8" style="text-align: justify;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $detail_karyawan['nama_karyawan']; ?></h5>
                                <p class="card-text"><?= $detail_karyawan['nik']; ?></p>
                                <p class="card-text" ><?= $detail_karyawan['alamat']; ?></p>
                                <p class="card-text"><small class="text-muted"><?= $detail_karyawan['id_jabatan']; ?></small></p>
                                <img src="<?= $detail_karyawan["qr_code"]; ?>" alt="" width="100px;" align="right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>