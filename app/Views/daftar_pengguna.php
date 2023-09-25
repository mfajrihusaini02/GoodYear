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
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">List Pengguna</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../tambah_pengguna" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text p-1">New</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover display nowrap w-100" id="datatabelPengguna" cellspacing="0">
                <thead>
                    <tr class="first even" style="text-shadow: none; cursor: pointer;">
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NAMA PENGGUNA</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">USERNAME</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">ROLE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">STATUS</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($users as $value) : ?>
                        <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $nomor++; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["nama_karyawan"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["username"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["name"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <?= ($value['active'] == 1) ? 'Aktif' : 'Tidak Aktif' ?>
                            </td>
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <a href="<?= base_url('edit_pengguna/' . $value['nik']) ?>" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                    <span class='icon'><i class='fas fa-edit'></i></span>
                                </a>
                                <a href="#" data-href="<?= base_url('delete_pengguna/' . $value['nik']) ?>" onclick="confirmToDelete(this)" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                    <span class='icon'><i class='fas fa-trash'></i></span>
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