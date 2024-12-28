<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        <p>Data Dashboard masih dalam Uji Coba Pengambilan Data.</p>
                        <p class="mb-0">Terimakasih atas perhatiannya.</p>
                    </div>
                </div>
            </div>
            <?php if ($this->session->userdata('role_id') != 5 && $panitia['unit_tugas_id']): ?>
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            Total Inden <?= $panitia['nama_tingkat']; ?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $JumlahCasanPerTingkat; ?> Santri</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="<?= base_url('dashboard/JumlahIndenPerTingkat/' . $panitia['unit_tugas_id']); ?>" class="btn btn-primary btn-sm shadow-sm">
                                        <i class="fas fa-arrow-right"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php elseif ($this->session->userdata('role_id') != 5): ?>
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            Total Inden SMP</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $TotalAllIndenSMP; ?> Santri</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="<?= base_url('dashboard/JumlahIndenPerTingkat/' . 1); ?>" class="btn btn-primary btn-sm shadow-sm">
                                        <i class="fas fa-arrow-right"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                            Total Inden SMA</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $TotalAllIndenSMA; ?> Santri</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="<?= base_url('dashboard/JumlahIndenPerTingkat/' . 2); ?>" class="btn btn-success btn-sm shadow-sm">
                                        <i class="fas fa-arrow-right"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Total Inden SMK</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $TotalAllIndenSMK; ?> Santri</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="<?= base_url('dashboard/JumlahIndenPerTingkat/' . 3); ?>" class="btn btn-warning btn-sm shadow-sm">
                                        <i class="fas fa-arrow-right"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">
                                            Total Seluruh Inden</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $TotalAllInden; ?> Santri</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="<?= base_url('dashboard/JumlahAllInden'); ?>" class="btn btn-danger btn-sm shadow-sm">
                                        <i class="fas fa-arrow-right"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

            <!-- Ucapan Salam dan Selamat Datang -->
            <div class="row">

                <?php if ($this->session->userdata('role_id') == 5): ?>
                    <div class="row mt-3 mb-4 justify-content-center">
                        <div class="col-md-10">
                            <div class="card shadow">
                                <div class="card-header bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">Salam</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="alert alert-success" role="alert">
                                                <h4 class="alert-heading">Assalamualaikum Wr. Wb.</h4>
                                                <p>Selamat datang calon santri baru PP. Bayt Alhikmah Pasuruan di Sistem Manajemen Penerimaan Santri Baru (PSB). Mohon segera melakukan update biodata santri, ya.</p>
                                                <hr>
                                                <p class="mb-0">Semoga harimu selalu bahagia.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row mt-3 mb-4 justify-content-center">
                        <div class="col-md-10">
                            <div class="card shadow">
                                <div class="card-header bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">Salam</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="alert alert-success" role="alert">
                                                <h4 class="alert-heading">Assalamualaikum Wr. Wb.</h4>
                                                <p>Selamat datang Sistem Manajemen Penerimaan Santri Baru (PSB). Semangat untuk hari ini.</p>
                                                <hr>
                                                <p class="mb-0">Semoga harimu selalu bahagia.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

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