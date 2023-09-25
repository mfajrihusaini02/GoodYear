<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Edit Role</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_role" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" action="<?= base_url('update_role/' . $role['id']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="nameLama" value="<?= $role['name']; ?>">
            <input type="hidden" name="descriptionLama" value="<?= $role['description']; ?>">

            <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Lama</b></h6>
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="namedisable" name="namedisable" value="<?= $role['name']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="descriptiondisable" name="descriptiondisable" value="<?= $role['description']; ?>" disabled>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Baru</b></h6>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Role</label>
                        <input type="text" class="form-control <?php if (session('validation.name')) : ?> is-invalid <?php endif ?>" id="name" name="name" autofocus placeholder="Silahkan masukan nama role">
                        <div class="invalid-feedback">
                            <?= session('validation.name'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control <?php if (session('validation.description')) : ?> is-invalid <?php endif ?>" id="description" name="description" placeholder="Silahkan masukan description">
                        <div class="invalid-feedback">
                            <?= session('validation.description'); ?>
                        </div>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include 'bawah_edit.php' ?>