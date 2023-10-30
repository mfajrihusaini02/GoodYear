<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Employee Profile</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../dashboard" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">Back</span>
            </a>
        </div>
    </div>

    <form method="POST" enctype="multipart/form-data" action="<?= base_url('update_profile/' . $karyawan['nik']); ?>">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">
        <input type="hidden" name="emailLama" value="<?= $users['email']; ?>">
        <input type="hidden" name="passwordLama" value="<?= $users['password']; ?>">
        <input type="hidden" name="password_hashLama" value="<?= $users['password_hash']; ?>">

        <div class="card-body mb-3 mt-3">
            <div class="row">
                <div class="col-lg-3 col-xl-3 col-md-3 col-xs-12 col-sm-12 col-12" align="center">
                    <img src="../img/<?= $karyawan["foto"]; ?>" alt="" style="width: 250px; height: 350px;">
                </div>

                <div class="col-lg-9 col-xl-9 col-md-9 col-xs-12 col-sm-12 col-12">
                    <div class="mb-3">
                        <label class="form-label">NOCC</label>
                        <input type="text" class="form-control <?php if (session('validation.nik')) : ?> is-invalid <?php endif ?>" id="nik" name="nik" value="<?= $karyawan['nik']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= session('validation.nik'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_karyawan')) : ?> is-invalid <?php endif ?>" id="nama_karyawan" name="nama_karyawan" value="<?= $karyawan['nama_karyawan']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= session('validation.nama_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control <?php if (session('validation.email')) : ?> is-invalid <?php endif ?>" id="email" name="email" value="<?= $users['email']; ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.email'); ?>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_hash" class="form-control <?php if (session('validation.password_hash')) : ?> is-invalid <?php endif ?>" name="password_hash" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" value="<?= old('password_hash'); ?>">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            <div class="invalid-feedback">
                                <?= session('validation.password_hash'); ?>
                            </div>
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
        </div>
    </form>
</div>

<?php include 'bawah_edit.php' ?>

<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

    $(document).ready(function() {
        $('#jabatandisable').select2();
        $('#divisidisable').select2();
        $('#id_sertifikat2').select2();
    });
</script>