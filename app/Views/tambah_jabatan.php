<?php include 'atas.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Add Department</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_jabatan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" action="simpan_jabatan">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Department Name</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_jabatan')) : ?> is-invalid <?php endif ?>" id="nama_jabatan" name="nama_jabatan" maxlength="100" autofocus placeholder="Please enter department name" value="<?= old('nama_jabatan'); ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_jabatan'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>