<?php include 'atas.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Add Employee</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('simpan_karyawan') ?>">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="NikKaryawan" class="form-label">NOCC</label>
                        <input type="text" class="form-control <?php if (session('validation.nik')) : ?> is-invalid <?php endif ?>" id="nik" name="nik" autofocus placeholder="Please enter NOCC" value="<?= old('nik'); ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.nik'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKaryawan" class="form-label">Employee Name</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_karyawan')) : ?> is-invalid <?php endif ?>" id="nama_karyawan" name="nama_karyawan" placeholder="Please enter employee name" value="<?= old('nama_karyawan'); ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Department</label>
                        <select name="jabatan" id="jabatan" class="form-select <?php if (session('validation.jabatan')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Option-</option>
                            <?php foreach ($jabatan as $value) : ?>
                                <option value="<?= $value['id_jabatan']; ?>" <?= old('jabatan') == $value['id_jabatan'] ? 'selected' : null ?>><?= $value['nama_jabatan']; ?></option>"
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.jabatan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Devisi" class="form-label">Division</label>
                        <select name="divisi" id="divisi" class="form-select <?php if (session('validation.divisi')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Option-</option>
                            <?php foreach ($divisi as $value) : ?>
                                <option value="<?= $value['id_divisi']; ?>" <?= old('divisi') == $value['id_divisi'] ? 'selected' : null ?>><?= $value['nama_divisi']; ?></option>"
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.divisi'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Photo Profile</label>
                        <input type="file" id="foto" name="foto" class="form-control <?php if (session('validation.foto')) : ?> is-invalid <?php endif ?>" value="<?= old('foto'); ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.foto'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>

<script>
    $(document).ready(function() {
        $('#divisi').select2();
        $('#jabatan').select2();
    });
</script>