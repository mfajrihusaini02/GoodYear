<?php include 'atas_edit.php' ?>

<?php if(session()->getFlashdata('status')){
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Selamat</strong> <?= session()->getFlashdata('status'); ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
} ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Edit Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../daftar_karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('update_karyawan/' . $karyawan['id_karyawan']); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">

            <div class="row">
                <div class="col-lg-2 col-xl-2 col-md-2 col-xs-12 col-sm-12 col-12" align="center">
                    <img src="../img/<?= $karyawan["foto"]; ?>" alt="" style="width: 150px; height: 200px;">
                </div>
                
                <div class="col-lg-5 col-xl-5 col-md-5 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Lama</b></h6>
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nikdisable" name="nikdisable" value="<?= $karyawan['nik']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawandisable" name="nama_karyawandisable" value="<?= $karyawan['nama_karyawan']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <select name="jabatandisable" id="jabatandisable" class="form-select" disabled>
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($jabatan as $value) { ?>
                                <option value="<?= $value['id_jabatan']; ?>" <?= $karyawan['id_jabatan'] == $value['id_jabatan'] ? 'selected' : null ?>>
                                    <?= $value['nama_jabatan']; ?>
                                </option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Divisi</label>
                        <select name="divisidisable" id="divisidisable" class="form-select" disabled>
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($divisi as $value) { ?>
                                <option value="<?= $value['id_divisi']; ?>" <?= $karyawan['id_divisi'] == $value['id_divisi'] ? 'selected' : null ?>>
                                    <?= $value['nama_divisi']; ?>
                                </option>"
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamatdisable" id="alamatdisable" cols="20" rows="3" class="form-control" value="<?= $karyawan['alamat']; ?>" disabled><?= $karyawan['alamat']; ?></textarea>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-5 col-md-5 col-xs-12 col-sm-12 col-12">
                    <h6><b>Data Baru</b></h6>
                    <div class="mb-3">
                        <label for="NikKaryawan" class="form-label">NIK</label>
                        <input type="text" class="form-control <?php if (session('validation.nik')) : ?> is-invalid <?php endif ?>" id="nik" name="nik" maxlength="16" minlength="16" autofocus placeholder="Silahkan masukan NIK karyawan">
                        <div class="invalid-feedback">
                            <?= session('validation.nik'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NamaKaryawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control <?php if (session('validation.nama_karyawan')) : ?> is-invalid <?php endif ?>" id="nama_karyawan" name="nama_karyawan" placeholder="Silahkan masukan nama karyawan">
                        <div class="invalid-feedback">
                            <?= session('validation.nama_karyawan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Jabatan</label>                        
                        <select name="jabatan" id="jabatan" class="form-select <?php if (session('validation.jabatan')) : ?> is-invalid <?php endif ?>">
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
                        <label for="Devisi" class="form-label">Divisi</label>
                        <select name="divisi" id="divisi" class="form-select <?php if (session('validation.divisi')) : ?> is-invalid <?php endif ?>">
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
                        <textarea name="alamat" id="alamat" cols="20" rows="3" class="form-control <?php if (session('validation.alamat')) : ?> is-invalid <?php endif ?>" placeholder="Silahkan masukan alamat karyawan"></textarea>
                        <div class="invalid-feedback">
                            <?= session('validation.alamat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto</label>
                        <input type="file" class="form-control <?php if (session('validation.foto')) : ?> is-invalid <?php endif ?>" id="foto" name="foto">
                        <div class="invalid-feedback">
                            <?= session('validation.foto'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<div class="card shadow mt-4">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Sertifikat Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="#" data-href="<?= base_url('add_sertifikatkaryawan') ?>" onclick="confirmToAdd(this)" class="btn btn-sm btn-success mt-2">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text p-1">Tambah</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12 col-12">
                <div class="table-responsive">
                    <table class="table table-hover display nowrap w-100" id="datatabelSertifikatKaryawan" cellspacing="0">
                        <thead>
                            <tr class="first even" style="text-shadow: none; cursor: pointer;">
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NAMA SERTIFIKAT</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">TANGGAL AMBIL</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">TANGGAL EKSPIRE</th>
                                <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php foreach ($transaksi as $value) : ?>
                                <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                                    <td style="margin: 5px; padding: 3px; text-align: center;"><?= $nomor++; ?></td>
                                    <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["nama_sertifikat"]; ?></td>
                                    <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["tanggal_ambil"]; ?></td>
                                    <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["tanggal_ekspire"]; ?></td>
                                    <td style="margin: 5px; padding: 3px; text-align: center;">
                                        <a href="#" data-href="<?= base_url('delete_sertifikatkaryawan/' . $value['id_transaksi']) ?>" onclick="confirmToDelete(this)" class="btn btn-outline-danger">
                                            <span class='icon'><i class='fas fa-trash'></i></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h2 class="h2">Are you sure?</h2>
                                    <p>The data will be deleted and lost forever</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="add-dialog" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="<?= base_url('../simpan_sertifikatkaryawan') ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" value="<?= $karyawan['id_karyawan'] ?>" id="id_karyawan" name="id_karyawan">
                                        <label for="id_sertifikat">Sertifikat</label>
                                        <select name="id_sertifikat" id="id_sertifikat" class="form-select <?php if (session('validation.id_sertifikat')) : ?> is-invalid <?php endif ?>">
                                            <option value="" disabled selected>-Pilih-</option>
                                            <?php foreach ($jenissertifikat as $value) { ?>
                                                <option value="<?= $value['id_sertifikat']; ?>" <?= old('id_sertifikat') == $value['id_sertifikat'] ? 'selected' : null ?>><?= $value['nama_sertifikat']; ?></option>"
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= session('validation.id_sertifikat'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_ambil">Tanggal Ambil</label>
                                        <input type="date" id="tanggal_ambil" name="tanggal_ambil" class="form-control <?php if (session('validation.tanggal_ambil')) : ?> is-invalid <?php endif ?>" value="<?= old('tanggal_ambil'); ?>">
                                        <div class="invalid-feedback">
                                            <?= session('validation.tanggal_ambil'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_ekspire">Tanggal Ekspire</label>
                                        <input type="date" id="tanggal_ekspire" name="tanggal_ekspire" class="form-control <?php if (session('validation.tanggal_ekspire')) : ?> is-invalid <?php endif ?>" value="<?= old('tanggal_ekspire'); ?>">
                                        <div class="invalid-feedback">
                                            <?= session('validation.tanggal_ekspire'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah.php' ?>

<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

    function confirmToAdd(el) {
        $("#add-button").attr("href", el.dataset.href);
        $("#add-dialog").modal('show');
    }

    $(document).ready(function() {
        $('#jabatan').select2();
        $('#jabatandisable').select2();
        $('#divisi').select2();
        $('#divisidisable').select2();
        $('#id_sertifikat2').select2();
    });
</script>