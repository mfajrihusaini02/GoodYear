<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Edit Divisi</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_divisi" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" action="<?= base_url('update_divisi/' . $role['id_divisi']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            
            <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Lama</b></h6>
                    <div class="mb-3">
                        <label for="nama_divisidisable" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="nama_divisidisable" name="nama_divisidisable" value="<?= $role['nama_divisi']; ?>" disabled>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Baru</b></h6>
                    <div class="mb-3">
                        <label for="nama_divisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_divisi')) : ?> is-invalid <?php endif ?>" id="nama_divisi" name="nama_divisi" autofocus placeholder="Silahkan masukan nama Divisi">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_divisi'); ?>
                        </div>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary" text-align="right">Update</button>
        </form>
    </div>
</div>

<?php include 'bawah_edit.php' ?>