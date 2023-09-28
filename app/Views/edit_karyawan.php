<?php include 'atas_edit.php' ?>

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
            <h4 class="text-white mt-2">Edit Employee</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('update_karyawan/' . $karyawan['nik']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="idLama" value="<?= $karyawan['id_karyawan']; ?>">
            <input type="hidden" name="nikLama" value="<?= $karyawan['nik']; ?>">
            <input type="hidden" name="nama_karyawanLama" value="<?= $karyawan['nama_karyawan']; ?>">
            <input type="hidden" name="jabatanLama" value="<?= $karyawan['id_jabatan']; ?>">
            <input type="hidden" name="divisiLama" value="<?= $karyawan['id_divisi']; ?>">
            <input type="hidden" name="alamatLama" value="<?= $karyawan['alamat']; ?>">
            <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">
            <input type="hidden" name="status_karyawanLama" value="<?= $karyawan['status_karyawan']; ?>">

            <div class="row">
                <div class="col-lg-2 col-xl-2 col-md-2 col-xs-12 col-sm-12 col-12" align="center">
                    <img src="../img/<?= $karyawan["foto"]; ?>" alt="" style="width: 150px; height: 200px;">
                </div>

                <div class="col-lg-5 col-xl-5 col-md-5 col-xs-12 col-sm-12 col-12">
                    <h6><b>Old Data</b></h6>
                    <div class="mb-3">
                        <label class="form-label">NOCC</label>
                        <input type="text" class="form-control" id="nikdisable" name="nikdisable" value="<?= $karyawan['nik']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="nama_karyawandisable" name="nama_karyawandisable" value="<?= $karyawan['nama_karyawan']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="jabatandisable" id="jabatandisable" class="form-select" disabled>
                            <option value="" disabled>-Option-</option>
                            <?php foreach ($jabatan as $value) { ?>
                                <option value="<?= $value['id_jabatan']; ?>" <?= $karyawan['id_jabatan'] == $value['id_jabatan'] ? 'selected' : null ?>>
                                    <?= $value['nama_jabatan']; ?>
                                </option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Division</label>
                        <select name="divisidisable" id="divisidisable" class="form-select" disabled>
                            <option value="" disabled>-Option-</option>
                            <?php foreach ($divisi as $value) { ?>
                                <option value="<?= $value['id_divisi']; ?>" <?= $karyawan['id_divisi'] == $value['id_divisi'] ? 'selected' : null ?>>
                                    <?= $value['nama_divisi']; ?>
                                </option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_karyawandisable" id="status_karyawandisable" class="form-select" disabled>
                            <option value="" disabled>-Option-</option>
                            <option value="<?= $karyawan['status_karyawan'] == 1 ?>"><?= ($karyawan['status_karyawan'] == 1) ? 'ACTIVE' : 'INACTIVE' ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-5 col-md-5 col-xs-12 col-sm-12 col-12">
                    <h6><b>New Data</b></h6>
                    <div class="mb-3">
                        <label for="NikKaryawan" class="form-label">NOCC</label>
                        <input type="text" class="form-control <?php if (session('validation.nik')) : ?> is-invalid <?php endif ?>" id="nik" name="nik" autofocus placeholder="Please enter employee NOCC">
                        <div class="invalid-feedback">
                            <?= session('validation.nik'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKaryawan" class="form-label">Employee Name</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_karyawan')) : ?> is-invalid <?php endif ?>" id="nama_karyawan" name="nama_karyawan" placeholder="Please enter employee name">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Department</label>
                        <select name="jabatan" id="jabatan" class="form-select <?php if (session('validation.jabatan')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Option-</option>
                            <?php foreach ($jabatan as $value) { ?>
                                <option value="<?= $value['id_jabatan']; ?>"><?= $value['nama_jabatan']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.jabatan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Devisi" class="form-label">Division</label>
                        <select name="divisi" id="divisi" class="form-select <?php if (session('validation.divisi')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Option-</option>
                            <?php foreach ($divisi as $value) { ?>
                                <option value="<?= $value['id_divisi']; ?>"><?= $value['nama_divisi']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.divisi'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_karyawan" id="status_karyawan" class="form-select <?php if (session('validation.status_karyawan')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Option-</option>
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.status_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Photo Profile</label>
                        <input type="file" class="form-control <?php if (session('validation.foto')) : ?> is-invalid <?php endif ?>" id="foto" name="foto">
                        <div class="invalid-feedback">
                            <?= session('validation.foto'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<div class="card shadow mt-4">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Employee Certificate</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="#" data-href="<?= base_url('add_sertifikatkaryawan') ?>" onclick="confirmToAdd(this)" class="btn btn-sm btn-success mt-2">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text p-1">Add</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12 col-12">
                <div class="table-responsive">
                    <table class="table table-hover display nowrap w-100" id="datatabelSertifikatKaryawan" cellspacing="0">
                        <thead>
                            <tr class="first even" style="text-shadow: none; cursor: pointer;">
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">CERTIFICATE NAME</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">PICK UP DATE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">EXPIRED DATE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">SAFETY VALUE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">QUALITY VALUE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">OPERATION VALUE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">AVERAGE VALUE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php foreach ($transaksi as $value) : ?>
                                <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                                    <td style="margin: 5px; padding: 3px; text-align: center;"><?= $nomor++; ?></td>
                                    <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["nama_sertifikat"]; ?></td>
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
                                    <td style="margin: 5px; padding: 3px; text-align: center;">
                                        <a href="#" data-href="<?= base_url('delete_sertifikatkaryawan/' . $value['id_transaksi']) ?>" onclick="confirmToDelete(this)" class="btn btn-outline-danger">
                                            <span class='icon'><i class='fas fa-trash'></i></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
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

                    <div id="add-dialog" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="<?= base_url('../simpan_sertifikatkaryawan') ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3><b>Form Input Certificate</b></h3>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="hidden" value="<?= $karyawan['id_karyawan'] ?>" id="id_karyawan" name="id_karyawan">

                                            <label for="id_sertifikat">Certificate</label>
                                            <select name="id_sertifikat" id="id_sertifikat" class="form-select <?php if (session('validation.id_sertifikat')) : ?> is-invalid <?php endif ?>">
                                                <option value="" disabled selected>-Pilih-</option>
                                                <?php foreach ($jenissertifikat as $value) { ?>
                                                    <option value="<?= $value['id_sertifikat']; ?>" <?= old('id_sertifikat') == $value['id_sertifikat'] ? 'selected' : null ?>><?= $value['nama_sertifikat']; ?></option>"
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= session('validation.id_sertifikat'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_ambil">Pick Up Date</label>
                                            <input type="date" id="tanggal_ambil" name="tanggal_ambil" class="form-control <?php if (session('validation.tanggal_ambil')) : ?> is-invalid <?php endif ?>" value="<?= old('tanggal_ambil'); ?>">
                                            <div class="invalid-feedback">
                                                <?= session('validation.tanggal_ambil'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_ekspire">Expiry Date</label>
                                            <input type="date" id="tanggal_ekspire" name="tanggal_ekspire" class="form-control <?php if (session('validation.tanggal_ekspire')) : ?> is-invalid <?php endif ?>" value="<?= old('tanggal_ekspire'); ?>">
                                            <div class="invalid-feedback">
                                                <?= session('validation.tanggal_ekspire'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="n_safety">Safety Value</label>
                                            <input type="number" id="n_safety" name="n_safety" onkeyup="ratarata();" max="100" min="0" class="form-control <?php if (session('validation.n_safety')) : ?> is-invalid <?php endif ?>" value="<?= old('n_safety'); ?>" placeholder="Enter a safety value">
                                            <div class="invalid-feedback">
                                                <?= session('validation.n_safety'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="n_quality">Quality Value</label>
                                            <input type="number" id="n_quality" name="n_quality" onkeyup="ratarata();" max="100" min="0" class="form-control <?php if (session('validation.n_quality')) : ?> is-invalid <?php endif ?>" value="<?= old('n_quality'); ?>" placeholder="Enter a quality value">
                                            <div class="invalid-feedback">
                                                <?= session('validation.n_quality'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="n_operation">Operation Value</label>
                                            <input type="number" id="n_operation" name="n_operation" onkeyup="ratarata();" max="100" min="0" class="form-control <?php if (session('validation.n_operation')) : ?> is-invalid <?php endif ?>" value="<?= old('n_operation'); ?>" placeholder="Enter a operation value">
                                            <div class="invalid-feedback">
                                                <?= session('validation.n_operation'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="n_average">Average Value</label>
                                            <input type="number" id="n_average" name="n_average" disabled class="form-control <?php if (session('validation.n_average')) : ?> is-invalid <?php endif ?>" value="<?= old('n_average'); ?>" placeholder="The average value is auto-filled">
                                            <div class="invalid-feedback">
                                                <?= session('validation.n_average'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
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

    function confirmToAdd(el) {
        $("#add-button").attr("href", el.dataset.href);
        $("#add-dialog").modal('show');
    }

    $(document).ready(function() {
        $('#jabatan').select2();
        $('#jabatandisable').select2();
        $('#divisi').select2();
        $('#divisidisable').select2();
        $('#id_sertifikat2').select2();
        $('#status_karyawan').select2();
        $('#status_karyawandisable').select2();
    });

    function ratarata() {
        var safety = document.getElementById('n_safety').value;
        var quality = document.getElementById('n_quality').value;
        var operation = document.getElementById('n_operation').value;
        var average = (parseFloat(safety) + parseFloat(quality) + parseFloat(operation)) / 3;
        if (!isNaN(average)) {
            document.getElementById('n_average').value = average;
        } else {
            document.getElementById('n_average').value = 0;
        }
    }
</script>