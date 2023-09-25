<?php

use PHPUnit\Framework\Constraint\Count; ?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Goodyear Indonesia</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <?php include 'kumpulanlink/linkatas.php' ?>
</head>

<body>
    <div class="card shadow">
        <div class="card-body mb-3 mt-3">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12 col-12">
                    <div class="card mb-3">
                        <div class="card-body m-0">
                            <div class="m-0" align="center">
                                <img src="../logo.png" class="img-fluid mt-2" width="250px;" height="300px;">
                                <h3><b>GOODYEAR INDONESIA</b></h3>
                            </div>

                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <img src="../img/<?= $detail_karyawan['foto']; ?>" class="img-fluid" width="150px;" height="200px;" style="border-radius: 10px;">
                                </div>

                                <div class="col-md-9" style="text-align: justify;">
                                    <div class="mb-3">
                                        <label class="form-label"><b>NIK</b></label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $detail_karyawan['nik']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Nama Karyawan</b></label>
                                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?= $detail_karyawan['nama_karyawan']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Alamat</b></label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $detail_karyawan['alamat']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Jabatan</b></label>
                                        <select name="jabatan" id="jabatan" class="form-control" disabled>
                                            <option value="" disabled>-Pilih-</option>
                                            <?php foreach ($jabatan as $value) { ?>
                                                <option value="<?= $value['id_jabatan']; ?>" <?= $detail_karyawan['id_jabatan'] == $value['id_jabatan'] ? 'selected' : null ?>>
                                                    <?= $value['nama_jabatan']; ?>
                                                </option>"
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mb-3">
                            <?php if ($transaksi == false || count($transaksi) < 1) : ?>
                                <div class="card" align="center">
                                    <div class="card-body">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-2 col-xl-2 col-md-2 col-xs-2 col-sm-2 col-2" align="center">
                                                <i class="menu-icon tf-icons ti ti-certificate" style="font-size: 45px;"></i>
                                            </div>
                                            <div class="col-lg-10 col-xl-10 col-md-10 col-xs-10 col-sm-10 col-10">
                                                <h6><b>Belum ada data sertifikat</b></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php foreach ($transaksi as $value) : ?>
                                <div class="card mb-2" align="center">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2 col-xl-2 col-md-2 col-xs-2 col-sm-2 col-2" align="center">
                                                <i class="menu-icon tf-icons ti ti-certificate" style="font-size: 45px;"></i>
                                            </div>
                                            <div class="col-lg-10 col-xl-10 col-md-10 col-xs-10 col-sm-10 col-10">
                                                <h5><b><?= $value['nama_sertifikat']; ?></b></h5>
                                                <span><b>Tanggal Ambil</b></span>
                                                <p><?= $value['tanggal_ambil']; ?></p>
                                                <span><b>Tanggal Expired</b></span>
                                                <p><?= $value['tanggal_ekspire']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <?php include 'kumpulanscript/linkbawah.php' ?>
</body>

</html>