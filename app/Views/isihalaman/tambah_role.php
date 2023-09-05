<div class="card shadow">
    <div class="row card-header bg-gray p-2 m-0">
        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
            <h4 class="text-white mt-2">Tambah Role</h4>
        </div>

        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12" align="right">
            <form method="GET" action="daftar_role" enctype="multipart/form-data">
                <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                    <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                    <span class="text p-1">List</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card-body mb-3 mt-3">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12 col-12">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="NamaRole" class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="NamaRole" aria-describedby="NamaRole">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>