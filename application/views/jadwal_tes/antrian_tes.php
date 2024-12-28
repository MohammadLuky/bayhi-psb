<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('pembayaran/jenis_pembayaran'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?> <?= $IDjadwal['nama_jadwal']; ?></h6>
                        </div>
                        <div class="card-body">
                            <!-- <input type="text" name="id_jadwal_tes_get" id="id_jadwal_tes_get" value="<?= $IDjadwal['id_jadwal_tes']; ?>"> -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>Nomor Urut Antrian</th>
                                            <!-- <th>No</th> -->
                                            <th>Tanggal Antrian</th>
                                            <th>Nama Santri</th>
                                            <th>Program Jenjang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($AntrianTesbytahap as $at): ?>
                                            <tr class="text-center">
                                                <!-- <td><?= $no++; ?></td> -->
                                                <td><?= $at['no_urut_antrian']; ?></td>
                                                <td><?= $at['tanggal_masuk_antrian']; ?></td>
                                                <td><?= $at['nama_lengkap']; ?></td>
                                                <td><?= $at['nama_program']; ?></td>
                                                <td>
                                                    <?php if ($tahap_berikutnya == null): ?>
                                                        <a href="<?= base_url('jadwaltes/tambah_kuota/' . $at['id_antrian_jadwal'] . '/' . $IDjadwal['id_jadwal_tes']); ?>" class="badge badge-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Santri"><i class="fas fa-user-plus"></i></a>
                                                    <?php else: ?>
                                                        <a href="#" class="badge badge-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Santri" data-toggle="modal" data-target="#ValidasiAntrian<?= $at['id_antrian_jadwal']; ?>"><i class="fas fa-user-plus"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?> - <?= $IDjadwal['nama_jadwal']; ?> <?= $IDjadwal['nama_tahap']; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb1" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Santri</th>
                                            <th>Status Antrian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($AntrianTes_perjadwal as $ap): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $ap['nama_lengkap']; ?></td>
                                                <?php if ($ap['status_antrian_santri'] == 1): ?>
                                                    <td>
                                                        <?php if ($tahap_berikutnya == null): ?>
                                                            <span class="badge badge-success">Aktif</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success">Aktif</span>
                                                            <a href="<?= base_url('jadwaltes/hapus_kuota/' . $ap['id_santri'] . '/' . $IDjadwal['id_jadwal_tes'] . '/' . $ap['id_antrian_jadwal']); ?>" class="badge badge-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Santri"><i class="fas fa-user-times"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
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

<?php foreach ($AntrianTesbytahap as $at): ?>
    <div class="modal fade" id="ValidasiAntrian<?= $at['id_antrian_jadwal']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <!-- <h5 class="modal-title text-white" id="exampleModalLabel">NonAktif Jenis Pembayaran</h5> -->
                    <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Jadwal</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <span>Apakah Santri <strong><?= $at['nama_lengkap']; ?></strong> dengan Program Jenjang <strong><?= $at['nama_program']; ?></strong> melanjutkan <?= $tahap_berikutnya['nama_tahap']; ?> ?</span>
                            <input type="hidden" name="id_antrian_jadwal_validasi" id="id_antrian_jadwal_validasi" value="<?= $at['id_antrian_jadwal']; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('jadwaltes/tahap_selanjutnya/' . $at['id_santri'] . '/' . $IDjadwal['id_jadwal_tes'] . '/' . $at['id_antrian_jadwal']); ?>" class="btn btn-success">Ya, Tahap Berikutnya</a>
                    <a href="<?= base_url('jadwaltes/tahap_ini/' . $at['id_santri'] . '/' . $IDjadwal['id_jadwal_tes'] . '/' . $at['id_antrian_jadwal']); ?>" class="btn btn-danger">Tidak, Hanya Tahap Ini.</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <!-- <button class="btn btn-danger" type="submit">Non Aktifkan</button> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>