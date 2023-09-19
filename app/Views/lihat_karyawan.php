<?php

use PHPUnit\Framework\Constraint\Count;

include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Kartu Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" align="center">
                                <img src="../img/<?= $detail_karyawan['foto']; ?>" class="img-fluid rounded-start" alt="" width="150px;" height="200px;">
                            </div>

                            <div class="col-md-9" style="text-align: justify;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>NIK</b></th>
                                            <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: <?= $detail_karyawan['nik']; ?></th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>Nama Lengkap</b></th>
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
                                        <tr>
                                            <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px;"><b>Sertifikat</b></th>
                                            <th style="text-align: justify; vertical-align: middle; margin: 5px; padding: 7px; width: 100%;">: </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive container mt-0">
                        <table class="table table-hover display nowrap table-bordered w-100" cellspacing="0">
                            <thead>
                                <tr class="first even" style="text-shadow: none; cursor: pointer;">
                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">No</th>
                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">Nama Sertifikat</th>
                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">Tanggal Ambil</th>
                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">Tanggal Ekspired</th>
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

                    <div class="container mt-2" align="center">
                        <img src="<?= $detail_karyawan["qr_code"]; ?>" height="100px;" width="100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah_edit.php' ?>