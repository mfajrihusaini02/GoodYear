<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Tambah Pengguna</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <a href="../daftar_pengguna" class="btn btn-primary btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('simpan_pengguna') ?>">
                    <input type="hidden" id="force_pass_reset" name="force_pass_reset" value="0">
                    <div class="mb-3">
                        <label for="nik">Nama Karyawan</label>
                        <select name="nik" class="form-select" id="nik">
                            <option value="" disabled selected>-Pilih-</option>
                            <?php foreach ($karyawan as $value) { ?>
                                <option value="<?= $value['nik']; ?>"><?= $value['nama_karyawan']; ?></option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Silahkan masukan email pengguna" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Silahkan masukan username pengguna" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_role">Level</label>
                        <select name="id_role" class="form-select" id="id_role">
                            <option value="" disabled selected>-Pilih-</option>
                            <?php foreach ($level as $value) { ?>
                                <option value="<?= $value['id_role']; ?>"><?= $value['nama_role']; ?></option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_hash" maxlength="50" class="form-control" name="password_hash" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="active">Status</label>
                        <select name="active" class="form-select" id="active" required>
                            <option value="" disabled selected>-Pilih-</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>