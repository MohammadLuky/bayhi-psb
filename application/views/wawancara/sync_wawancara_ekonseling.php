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
                                <!-- <a href="<?= base_url('wawancara/getsync_wawancara_ekonseling'); ?>" class="btn btn-sm btn-light">
                                    <i class="fas fa-sync"></i> Syncron Data
                                </a> -->
                                <a href="<?= base_url('wawancara/getsyncapi_wawancara_ekonseling'); ?>" class="btn btn-sm btn-light">
                                    <i class="fas fa-sync"></i> Syncron Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="LoadData_psb" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead style="background-color: teal;" class="text-white text-center">
                                            <tr>
                                                <th>ID Santri</th>
                                                <th>Nama Santri</th>
                                                <th>Jadwal Wawancara</th>
                                                <th>Pewawancara Santri & Ortu</th>
                                                <th>Catatan Khusus</th>
                                                <th>Motivasi</th>
                                                <th>Kemampuan Beradaptasi</th>
                                                <th>Karakter</th>
                                                <th>Kedekatan</th>
                                                <th>Hasil Rekomendasi</th>
                                                <!-- <th>Jenis Wawancara</th>
                                                <th>Item Wawancara</th> -->
                                                <!-- <th>Deskripsi Wawancara</th> -->
                                                <!-- <th>Interviewer</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($DataSyncWawancara as $wawancara): ?>
                                                <tr>
                                                    <td><?= $wawancara['id_santri']; ?></td>
                                                    <td><?= $wawancara['nama_lengkap']; ?></td>
                                                    <td><?= $wawancara['nama_jadwal']; ?> (<?= $wawancara['nama_tahap']; ?>) - <?= $wawancara['ket_tapel']; ?></td>
                                                    <td><?= $wawancara['pegawai_wawancara_santri_id']; ?> | <?= $wawancara['pegawai_wawancara_ortu_id']; ?></td>
                                                    <td><?= $wawancara['catatan_khusus']; ?></td>
                                                    <td><?= $wawancara['motivasi']; ?></td>
                                                    <td><?= $wawancara['kemampuan_beradaptasi']; ?></td>
                                                    <td><?= $wawancara['karakter']; ?></td>
                                                    <td><?= $wawancara['kedekatan']; ?></td>
                                                    <td><?= $wawancara['hasil_rekomendasi']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- <?php
                                                    $no = 1;
                                                    $current_id_santri = '';
                                                    $current_santri = '';
                                                    $current_jenis = '';
                                                    $id_santri_count = [];
                                                    $santri_count = [];
                                                    $jenis_count = [];

                                                    foreach ($DataSyncWawancara as $row) {
                                                        if (!isset($id_santri_count[$row['id_santri']])) {
                                                            $id_santri_count[$row['id_santri']] = 0;
                                                        }
                                                        $id_santri_count[$row['id_santri']]++;

                                                        if (!isset($santri_count[$row['nama_lengkap']])) {
                                                            $santri_count[$row['nama_lengkap']] = 0;
                                                        }
                                                        $santri_count[$row['nama_lengkap']]++;

                                                        if (!isset($jenis_count[$row['id_santri']][$row['nama_lengkap']][$row['jenis_wawancara']])) {
                                                            $jenis_count[$row['id_santri']][$row['nama_lengkap']][$row['jenis_wawancara']] = 0;
                                                        }
                                                        $jenis_count[$row['id_santri']][$row['nama_lengkap']][$row['jenis_wawancara']]++;
                                                    }

                                                    foreach ($DataSyncWawancara as $index => $row):
                                                    ?>
                                                <tr>
                                                    <?php if ($current_id_santri != $row['id_santri']): ?>
                                                        <td rowspan="<?= $id_santri_count[$row['id_santri']]; ?>">
                                                            <?= $row['id_santri']; ?>
                                                        </td>
                                                        <?php $current_id_santri = $row['id_santri']; ?>
                                                    <?php endif; ?>

                                                    <?php if ($current_santri != $row['nama_lengkap']): ?>
                                                        <td rowspan="<?= $santri_count[$row['nama_lengkap']]; ?>">
                                                            <?= $row['nama_lengkap']; ?>
                                                        </td>
                                                        <?php $current_santri = $row['nama_lengkap']; ?>
                                                    <?php endif; ?>

                                                    <?php if ($current_jenis != $row['jenis_wawancara']): ?>
                                                        <td rowspan="<?= $jenis_count[$row['id_santri']][$row['nama_lengkap']][$row['jenis_wawancara']]; ?>">
                                                            <?= $row['jenis_wawancara']; ?>
                                                        </td>
                                                        <?php $current_jenis = $row['jenis_wawancara']; ?>
                                                    <?php endif; ?>

                                                    <td><?= $row['item_wawancara']; ?></td>
                                                    <td><?= $row['deskripsi_wawancara']; ?></td>
                                                    <td><?= $row['nama_lengkap_pegawai']; ?></td>
                                                </tr>
                                            <?php endforeach; ?> -->
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