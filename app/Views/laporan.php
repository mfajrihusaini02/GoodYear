<?php include 'atas.php' ?>

<?php if (session()->getFlashdata('status')) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>CONGRATULATIONS </strong> <?= session()->getFlashdata('status'); ?>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
} ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Report</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../cetak_laporan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                <span class="text p-1">Print</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover display wrap w-100" id="datatabelKaryawan" cellspacing="0">
                <thead>
                    <tr class="first even" style="text-shadow: none; cursor: pointer;">
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">PERSNUMBER</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">FULL NAME</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">POSITION TITLE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">DEPARTMENT</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE NAME</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE DATE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">DATE OF EXPIRED</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE (SAFETY) SCORE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE (QUALITY) SCORE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE (OPERATION) SCORE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE AVERAGE SCORE</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($karyawan as $value) : ?>
                        <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $nomor++; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["nik"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["nama_karyawan"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["nama_jabatan"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["nama_divisi"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["nama_sertifikat"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <?= date('d M Y', strtotime($value['tanggal_ambil'])); ?>
                            </td>
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <?= date('d M Y', strtotime($value['tanggal_ekspire'])); ?>
                            </td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["n_safety"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["n_quality"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["n_operation"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["n_average"]; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>