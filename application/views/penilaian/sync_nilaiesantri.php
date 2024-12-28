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
                <div id="load_Datacasan">
                    <div class="col-md-12">
                        <div class="card mb-2">
                            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                                <a href="<?= base_url('penilaian/getsync_nilaiesantri'); ?>" class="btn btn-sm btn-light">
                                    <i class="fas fa-sync"></i> Syncron Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="LoadData_psb" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                        <thead style="background-color: teal;" class="text-white text-center">
                                            <tr>
                                                <th>ID Santri</th>
                                                <th>Nama Santri</th>
                                                <th>Jenis Penilaian</th>
                                                <th>Jadwal Tes</th>
                                                <th>Nilai</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($DataSyncPenilaian as $santri): ?>
                                                <tr>
                                                    <td><?= $santri['id_santri']; ?></td>
                                                    <td><?= $santri['nama_lengkap']; ?></td>
                                                    <td><?= $santri['nama_penilaian']; ?></td>
                                                    <td><?= $santri['nama_jadwal']; ?> (<?= $santri['nama_tahap']; ?>) - <?= $santri['ket_tapel']; ?></td>
                                                    <td><?= $santri['nilai']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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