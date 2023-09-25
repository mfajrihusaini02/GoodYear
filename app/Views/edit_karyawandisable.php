<?php include 'atas_edit.php' ?>

<div class="card shadow">
    <div class="row card-header bg-primary p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6">
            <h4 class="text-white mt-2">Profile Karyawan</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-6 col-sm-6 col-6" align="right">
            <a href="../karyawan" class="btn btn-success btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="center">
                <img src="../img/<?= $karyawan["foto"]; ?>" alt="" style="width: 250px; height: 350px;">
            </div>

            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('update_karyawan/' . $karyawan['id_karyawan']); ?>">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
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
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'bawah_edit.php' ?>

<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

    $(document).ready(function() {
        $('#jabatandisable').select2();
        $('#divisidisable').select2();
        $('#id_sertifikat2').select2();
    });
</script>