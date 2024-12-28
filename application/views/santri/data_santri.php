<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri/data_santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                        Data Inden SMP</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><code>Proses Ambil Data</code></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
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
                                    <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                        Data Inden SMA</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><code>Proses Ambil Data</code></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
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
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Data Inden SMK</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><code>Proses Ambil Data</code></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-info">
                            <h6 class="m-0 font-weight-bold text-white">Filter <?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Tahun Pelajaran</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('filter_tapel_casan') != '') ? 'is-invalid' : ''; ?>" name="filter_tapel_casan" id="filter_tapel_casan">
                                            <option value="">Pilih Tahun Pelajaran</option>
                                            <?php foreach ($AllTapel as $tapel): ?>
                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('filter_tapel_casan'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="filterDataCasan">Filter</button>
                            <button class="btn btn-sm btn-danger" id="resetDataCasan">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                        Rapat Pleno PSB</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Calon Santri</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                <a href="<?= base_url('santri/proses_plenoPSB'); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-right"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="load_Datacasan">

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