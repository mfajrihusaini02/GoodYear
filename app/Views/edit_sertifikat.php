<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Edit Master Certificate</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_sertifikat" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" action="<?= base_url('update_sertifikat/' . $sertifikat['id_sertifikat']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="kodesertifikatLama" value="<?= $sertifikat['kode_sertifikat']; ?>">
            <input type="hidden" name="namasertifikatLama" value="<?= $sertifikat['nama_sertifikat']; ?>">

            <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>Old Data</b></h6>
                    <div class="mb-3">
                        <label class="form-label">Certificate Code</label>
                        <input type="text" class="form-control" id="kodesertifikatdisable" name="kodesertifikatdisable" value="<?= $sertifikat['kode_sertifikat']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Certificate Name</label>
                        <input type="text" class="form-control" id="namasertifikatdisable" name="namasertifikatdisable" value="<?= $sertifikat['nama_sertifikat']; ?>" disabled>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                    <h6><b>New Data</b></h6>
                    <div class="mb-3">
                        <label for="kodesertifikat" class="form-label">Certificate Code</label>
                        <input type="text" class="form-control <?php if (session('validation.kodesertifikat')) : ?> is-invalid <?php endif ?>" id="kodesertifikat" name="kodesertifikat" autofocus value="<?= $sertifikat['kode_sertifikat']; ?>" placeholder="Please enter certificate code">
                        <div class="invalid-feedback">
                            <?= session('validation.kodesertifikat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="namasertifikat" class="form-label">Certificate Name</label>
                        <input type="text" class="form-control <?php if (session('validation.namasertifikat')) : ?> is-invalid <?php endif ?>" id="namasertifikat" name="namasertifikat" placeholder="Please enter certificate name">
                        <div class="invalid-feedback">
                            <?= session('validation.namasertifikat'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include 'bawah_edit.php' ?>