<?php include 'atas.php' ?>

<?php if (session()->getFlashdata('status')) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Selamat</strong> <?= session()->getFlashdata('status'); ?>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
} ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">List Karyawan</h4>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover display nowrap w-100" id="datatabelKaryawan" cellspacing="0">
                <thead>
                    <tr class="first even" style="text-shadow: none; cursor: pointer;">
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NIK</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NAMA KARYAWAN</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">JABATAN</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">DEVISI</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">AKSI</th>
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
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <a href="<?= base_url('edit_karyawandisable/' . $value['nik']) ?>" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                    <span class='icon'><i class='fas fa-edit'></i></span>
                                </a>
                                <a href="<?= base_url('lihat_karyawan/' . $value['id_karyawan']) ?>" class="btn btn-outline-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View">
                                    <span class='icon'><i class='fas fa-eye'></i></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div id="confirm-dialog" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h2 class="h2">Are you sure?</h2>
                            <p>The data will be deleted and lost forever</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                            <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>
<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }
</script>