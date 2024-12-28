<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('master/data_pelengkap'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">Data Pelengkap Santri</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Agama</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/agama'); ?>" class="btn btn-sm btn-primary">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Kebutuhan Khusus</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/kebutuhan_khusus'); ?>" class="btn btn-sm btn-warning">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Alat Transportasi</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/alat_tranportasi'); ?>" class="btn btn-sm btn-success">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Pendidikan Orang Tua</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/pendidikan_ortu'); ?>" class="btn btn-sm btn-danger">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Pekerjaan Orang Tua</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/pekerjaan_ortu'); ?>" class="btn btn-sm btn-info">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-secondary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Penghasilan Orang Tua</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/penghasilan_ortu'); ?>" class="btn btn-sm btn-secondary">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">Data Pelengkap Santri</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Provinsi</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/data_provinsi'); ?>" class="btn btn-sm btn-primary">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Kota Kabupaten</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/data_kotakab'); ?>" class="btn btn-sm btn-warning">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Kecamatan</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/data_kecamatan'); ?>" class="btn btn-sm btn-success">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Proses Ambil Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Kelurahan</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('master/data_kelurahan'); ?>" class="btn btn-sm btn-danger">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; IT - BAYHI Thn. 2024</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->