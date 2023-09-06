<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Edit Sertifikat</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <a href="../daftar_sertifikat" class="btn btn-primary btn-sm btn-icon-split mt-2">
                <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                <span class="text p-1">List</span>
            </a>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="KodeSertifikat" class="form-label">Kode Sertifikat</label>
                        <input type="text" class="form-control" id="KodeSertifikat" aria-describedby="KodeSertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="NamaSertifikat" class="form-label">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="NamaSertifikat" aria-describedby="NamaSertifikat">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>