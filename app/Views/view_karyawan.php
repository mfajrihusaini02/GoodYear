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
                        <div class="card-body">
                            <div class="m-0" align="center">
                                <img src="../logo.png" class="img-fluid mt-2" width="250px;" height="300px;">
                                <h3><b>GOODYEAR INDONESIA</b></h3>
                            </div>

                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <img src="../img/<?= $detail_karyawan['foto']; ?>" class="img-fluid" width="150px;" height="200px;" style="border-radius: 10px;">
                                </div>

                                <div class="col-md-9" style="text-align: justify;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>NIK</b></th>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: <?= $detail_karyawan['nik']; ?></th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: justify; vertical-align: top; margin: 5px; padding: 7px; width: 45%;"><b>Nama Lengkap</b></th>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: <?= $detail_karyawan['nama_karyawan']; ?></th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>Alamat</b></th>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: <?= $detail_karyawan['alamat']; ?></th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>Jabatan</b></th>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">:
                                                    <?php foreach ($jabatan as $value) : ?>
                                                        <?= $detail_karyawan['id_jabatan'] == $value['id_jabatan'] ? $value['nama_jabatan'] : null ?>
                                                    <?php endforeach ?>
                                                </th>
                                            </tr>
                                            <!-- <tr>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>Sertifikat</b></th>
                                                <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: </th>
                                            </tr> -->
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive container mt-0 mb-4">
                            <label for=""><b>Jenis Sertifikat :</b></label>
                            <table class="table table-hover display nowrap table-bordered w-100" cellspacing="0">
                                <thead>
                                    <tr class="first even" style="text-shadow: none; cursor: pointer;">
                                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;"><b>No</b></th>
                                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;"><b>Nama Sertifikat</b></th>
                                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;"><b>Tanggal Ambil</b></th>
                                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;"><b>Tanggal Expired</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($transaksi as $value) : ?>
                                        <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                                            <td style="margin: 5px; padding: 3px; text-align: center; width: 5%;"><?= $nomor++; ?></td>
                                            <td style="margin: 5px; padding: 3px; text-align: center; width: 30%;"><?= $value['nama_sertifikat']; ?></td>
                                            <td style="margin: 5px; padding: 3px; text-align: center; width: 15%;"><?= $value['tanggal_ambil']; ?></td>
                                            <td style="margin: 5px; padding: 3px; text-align: center; width: 15%;"><?= $value['tanggal_ekspire']; ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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