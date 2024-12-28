<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?php if (empty($jadwal_santri)): ?>
                <div class="row mt-3 justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-header bg-primary">
                                <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Informasi!</h4>
                                            <p>Mohon sabar karena Penjadwalan Tes masih dalam proses.</p>
                                            <hr>
                                            <p class="mb-0">Terimakasih atas perhatiannya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="row  justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-header bg-primary">
                                <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="alert alert-info" role="alert">
                                            <h4 class="alert-heading">PENTING!</h4>
                                            <p>Jadwal Tes Santri <strong><?= $bio_santri['nama_lengkap']; ?></strong> sebagai berikut.</p>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Hari/Tanggal</td>
                                                    <td>:</td>
                                                    <td><?= $jadwal_santri['nama_hari']; ?>, <?= $jadwal_santri['tanggal_tes']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>:</td>
                                                    <td><?= $jadwal_santri['waktu_tes']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat</td>
                                                    <td>:</td>
                                                    <td><?= $jadwal_santri['tempat_tes']; ?></td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <p class="mb-0">Bila berhalangan hadir di tanggal tersebut segera hubungi admin sekolah di grup masing-masing paling lambat 1 minggu sebelum Tes Berlangsung.</p>
                                            <p class="mb-0">Terimakasih atas perhatiannya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>



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
<!-- End of Content Wrapper -->r