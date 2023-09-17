<?php include 'atas_edit.php' ?>

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
                                <div class="row">
                                    <div class="col-lg-4 col-xl-4 col-md-4 col-ls-4 col-xs-4 col-4">
                                        <p><b>NIK</b></p>
                                        <p><b>Nama Lengkap</b></p>
                                        <p><b>Alamat</b></p>
                                        <p><b>Jabatan</b></p>
                                        <p><b>Sertifikat</b></p>
                                    </div>
                                    <div class="col-lg-8 col-xl-8 col-md-8 col-ls-8 col-xs-8 col-8">
                                        <p>: <?= $detail_karyawan['nik']; ?></p>
                                        <p>: <?= $detail_karyawan['nama_karyawan']; ?></p>
                                        <p>: <?= $detail_karyawan['alamat']; ?></p>
                                        <p>:
                                            <?php foreach ($jabatan as $value) : ?>
                                                <?= $detail_karyawan['id_jabatan'] == $value['id_jabatan'] ? $value['nama_jabatan'] : null ?>
                                            <?php endforeach ?>
                                        </p>
                                        <p>: </p>
                                    </div>
                                    <div class="table-responsive  mt-0">
                                        <table class="table table-hover display nowrap table-bordered w-100" cellspacing="0">
                                            <thead>
                                                <tr class="first even" style="text-shadow: none; cursor: pointer;">
                                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">No</th>
                                                    <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">Nama Sertifikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor = 1; ?>
                                                <?php foreach ($transaksi as $value) : ?>
                                                    <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                                                        <td style="margin: 5px; padding: 3px; text-align: center; width: 10%;"><?= $nomor++; ?></td>
                                                        <td style="margin: 5px; padding: 3px; text-align: center; width: 90%;"><?= $value['nama_sertifikat']; ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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