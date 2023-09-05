<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Daftar Pengguna</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <form method="GET" action="tambah_pengguna" enctype="multipart/form-data">
                <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                    <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                    <span class="text p-1">Tambah Pengguna</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover display nowrap w-100" id="datatabelPengguna" cellspacing="0">
                <thead>
                    <tr class="first even" style="text-shadow: none; cursor: pointer;">
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NO</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">NAMA PENGGUNA</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">USERNAME</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">ROLE</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">STATUS</th>
                        <th style="text-align: center; vertical-align: middle; margin: 5px; padding: 7px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($pengguna as $value) : ?>
                        <tr style="vertical-align: middle; text-align: center; text-shadow: none;">
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $nomor++; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["nama_pengguna"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: justify;"><?= $value["username"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["nama_role"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;"><?= $value["status"]; ?></td>
                            <td style="margin: 5px; padding: 3px; text-align: center;">
                                <a class="btn btn-outline-secondary" href="#">
                                    <span class='icon'><i class='fas fa-edit'></i></span>
                                </a>
                                <a class="btn btn-outline-secondary" href="#">
                                    <span class='icon'><i class='fas fa-trash'></i></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>