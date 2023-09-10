<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Edit Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <a href="../daftar_karyawan" class="btn btn-primary btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('update_karyawan/'.$karyawan['id_karyawan']); ?>">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="NikKaryawan" class="form-label">NIK</label>
                        <input type="text" class="form-control <?php if(session('validation.nik')) : ?> is-invalid <?php endif ?>" id="nik" name="nik" maxlength="16" minlength="16" value="<?= $karyawan['nik']; ?>" autofocus placeholder="Silahkan masukan NIK karyawan">
                        <div class="invalid-feedback">
                            <?= session('validation.nik'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKaryawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control <?php if(session('validation.nama_karyawan')) : ?> is-invalid <?php endif ?>" id="nama_karyawan" name="nama_karyawan" placeholder="Silahkan masukan nama karyawan" value="<?= $karyawan['nama_karyawan']; ?>">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select <?php if(session('validation.jabatan')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Pilih-</option>
                            <?php foreach ($jabatan as $value) { ?>
                                <option value="<?= $value['id_jabatan']; ?>"><?= $value['nama_jabatan']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.jabatan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Devisi" class="form-label">Devisi</label>
                        <select name="divisi" id="divisi" class="form-select <?php if(session('validation.divisi')) : ?> is-invalid <?php endif ?>">
                            <option value="" disabled selected>-Pilih-</option>
                            <?php foreach ($divisi as $value) { ?>
                                <option value="<?= $value['id_divisi']; ?>"><?= $value['nama_divisi']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.divisi'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="20" rows="3" class="form-control <?php if(session('validation.alamat')) : ?> is-invalid <?php endif ?>" placeholder="Silahkan masukan alamat karyawan" value="<?= $karyawan['alamat']; ?>"><?= $karyawan['alamat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('validation.alamat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" aria-describedby="Foto" value="<?= $karyawan['foto']; ?>" placeholder="Silahkan upload foto karyawan">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <img src="<?= $karyawan["foto"]; ?>" alt="" style="width: 250px; height: 350px;">
            </div>
        </div>
    </div>
</div>