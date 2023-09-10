<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Tambah Role</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <a href="../daftar_role" class="btn btn-primary btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" action="simpan_role">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_role" class="form-label">Nama Role</label>
                        <input type="text" class="form-control <?php if(session('validation.nama_role')) : ?> is-invalid <?php endif ?>" id="nama_role" name="nama_role" autofocus placeholder="Silahkan masukan nama role">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_role'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control <?php if(session('validation.level')) : ?> is-invalid <?php endif ?>" id="level" name="level" placeholder="Silahkan masukan level">
                        <div class="invalid-feedback">
                            <?= session('validation.level'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>