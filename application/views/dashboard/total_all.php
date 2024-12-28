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

            <a href="<?= base_url('dashboard'); ?>" class="btn btn-warning mb-2"><i class="fas fa-arrow-circle-left"></i> Kembali</a>

            <!-- Content Row -->
            <?php if ($this->session->userdata('role_id') != 5): ?>
                <div class="row">
                    <?php
                    // Kumpulkan data berdasarkan tingkat
                    $grouped_by_tingkat = [];
                    foreach ($hasil_perhitungan as $data) {
                        $grouped_by_tingkat[$data['tingkat']][] = $data;
                    }
                    foreach ($grouped_by_tingkat as $tingkat => $data_per_tingkat):
                    ?>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><strong><?= $tingkat; ?></strong></h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tahun Pelajaran</th>
                                                <th>Jumlah Santri</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_per_tingkat as $data): ?>
                                                <tr>
                                                    <td><?= $data['tahun_pelajaran']; ?></td>
                                                    <td><?= $data['jumlah']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
<!-- End of Content Wrapper -->