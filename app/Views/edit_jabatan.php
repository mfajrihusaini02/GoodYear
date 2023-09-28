<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Edit Department</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_jabatan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" action="<?= base_url('update_jabatan/' . $jabatan['id_jabatan']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="nama_jabatanLama" value="<?= $jabatan['nama_jabatan']; ?>">

            <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Old Data</b></h6>
                    <div class="mb-3">
                        <label for="nama_jabatandisable" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="nama_jabatandisable" name="nama_jabatandisable" value="<?= $jabatan['nama_jabatan']; ?>" disabled>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>New Data</b></h6>
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Department Name</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_jabatan')) : ?> is-invalid <?php endif ?>" id="nama_jabatan" name="nama_jabatan" autofocus placeholder="Silahkan masukan nama jabatan">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_jabatan'); ?>
                        </div>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include 'bawah_edit.php' ?>