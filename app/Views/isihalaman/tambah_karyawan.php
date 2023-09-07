<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Tambah Karyawan</h4>
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
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('simpan_karyawan') ?>">
                    <div class="mb-3">
                        <label for="NikKaryawan" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" maxlength="16" minlength="16" aria-describedby="NikKaryawan" autofocus placeholder="Silahkan masukan NIK karyawan" required>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKaryawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" maxlength="100" aria-describedby="NamaKaryawan" placeholder="Silahkan masukan nama karyawan" required>
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select" aria-describedby="Jabatan" required>
                            <option value="" disabled selected>Pilih</option>
                            <OPtion value="Direktur">Direktur</OPtion>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Devisi" class="form-label">Devisi</label>
                        <select name="divisi" id="divisi" class="form-select" aria-describedby="Devisi" required>
                            <option value="" disabled selected>Pilih</option>
                            <option value="Gudang">Gudang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="20" rows="3" class="form-control" maxlength="100" aria-describedby="Alamat" placeholder="Silahkan masukan alamat karyawan" required></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="QRCode" class="form-label">QR Code</label>
                        <input type="text" class="form-control" id="qr_code" name="qr_code" aria-describedby="QRCode" maxlength="100" placeholder="Silahkan masukan QR Code" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" aria-describedby="Foto" placeholder="Silahkan upload foto karyawan">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>