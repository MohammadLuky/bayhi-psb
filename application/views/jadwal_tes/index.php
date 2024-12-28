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

            <!-- <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?> -->

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Tambah Jadwal Tes</h6>
                        </div>
                        <form action="<?= base_url('jadwaltes'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Tes</label>
                                            <input type="text" id="nama_jadwal" name="nama_jadwal" class="form-control <?= (form_error('nama_jadwal') != '') ? 'is-invalid' : ''; ?>" placeholder="Nama Tes" autocomplete="off" value="<?= set_value('nama_jadwal'); ?>">
                                            <div class="invalid-feedback"><?= form_error('nama_jadwal'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tahap Tes</label>
                                            <select class="form-control select2 <?= (form_error('tahap_id') != '') ? 'is-invalid' : ''; ?>" name="tahap_id" id="tahap_id">
                                                <option value="">Pilih Tahap Tes</option>
                                                <?php foreach ($AllTahap as $tahap): ?>
                                                    <option value="<?= $tahap['id_tahap']; ?>"><?= $tahap['nama_tahap']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('tahap_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tempat Tes</label>
                                            <input type="text" id="tempat_tes" name="tempat_tes" class="form-control <?= (form_error('tempat_tes') != '') ? 'is-invalid' : ''; ?>" placeholder="Tempat Tes" autocomplete="off" value="<?= set_value('tempat_tes'); ?>">
                                            <div class="invalid-feedback"><?= form_error('tempat_tes'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tahun Pelajaran</label>
                                            <select class="form-control select2 <?= (form_error('tapel_jadwal_id') != '') ? 'is-invalid' : ''; ?>" name="tapel_jadwal_id" id="tapel_jadwal_id">
                                                <option value="">Pilih Tahun Pelajaran</option>
                                                <?php foreach ($Tapel as $t): ?>
                                                    <option value="<?= $t['id_tapel']; ?>"><?= $t['ket_tapel']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('tapel_jadwal_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Hari</label>
                                            <select class="form-control select2 <?= (form_error('nama_hari') != '') ? 'is-invalid' : ''; ?>" name="nama_hari" id="nama_hari">
                                                <option value="">Pilih Hari</option>
                                                <?php foreach ($nama_hari as $hari): ?>
                                                    <option value="<?= $hari; ?>"><?= $hari; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('nama_hari'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Jadwal</label>
                                            <input type="date" id="tanggal_tes" name="tanggal_tes" class="form-control <?= (form_error('tanggal_tes') != '') ? 'is-invalid' : ''; ?>" placeholder="Tanggal Tes" autocomplete="off" value="<?= set_value('tanggal_tes'); ?>">
                                            <div class="invalid-feedback"><?= form_error('tanggal_tes'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Waktu Pelaksanaan</label>
                                            <input type="time" id="waktu_tes" name="waktu_tes" class="form-control <?= (form_error('waktu_tes') != '') ? 'is-invalid' : ''; ?>" placeholder="Tanggal Tes" autocomplete="off" value="<?= set_value('waktu_tes'); ?>">
                                            <div class="invalid-feedback"><?= form_error('waktu_tes'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tes</th>
                                            <!-- <th>Tahun Pelajaran</th> -->
                                            <th>Hari, Tanggal & Waktu</th>
                                            <th>Tempat Tes</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($JadwalTes as $jt): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $jt['nama_jadwal']; ?> (<?= $jt['nama_tahap']; ?>) - <?= $jt['ket_tapel']; ?></td>
                                                <td><?= $jt['nama_hari']; ?>, <?= tanggal_indonesia_format2($jt['tanggal_tes']); ?> - <?= $jt['waktu_tes']; ?> WIB</td>
                                                <td><?= $jt['tempat_tes']; ?></td>
                                                <td>
                                                    <?php if ($jt['status_jadwal'] == 2): ?>
                                                        <span class="badge badge-info">Jadwal Telah Selesai</span>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('jadwaltes/kuota_jadwal/' . $jt['id_jadwal_tes']); ?>" class="btn btn-sm btn-success btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Penuhi Kuota Jadwal"><i class="fas fa-user-plus"></i></a>
                                                        <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Jadwal" data-toggle="modal" data-target="#nonaktifJadwal<?= $jt['id_jadwal_tes']; ?>"><i class="fas fa-times-circle"></i></a>
                                                        <a href="" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Jadwal Selesai" data-toggle="modal" data-target="#JadwalSelesai<?= $jt['id_jadwal_tes']; ?>"><i class="fas fa-check-circle"></i></a>
                                                        <a href="<?= base_url('jadwaltes/daftar_hadir/' . $jt['id_jadwal_tes']); ?>" target="_blank" class="btn btn-sm btn-info btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Daftar Hadir"><i class="fas fa-user-check"></i></a>
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

<!-- Modal Edit -->
<!-- <?php foreach ($JadwalTes as $jt): ?>
    <div class="modal fade" id="detailJadwal<?= $jt['id_jadwal_tes']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pembayaran/edit_jenis_pembayaran'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Detail Jadwal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <th>No</th>
                                        <th>Nama Santri</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Santri Coba</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="id_jadwal_tes" id="id_jadwal_tes" value="<?= $jt['id_jadwal_tes']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?> -->

<!-- Modal Hapus -->
<?php foreach ($JadwalTes as $jt): ?>
    <div class="modal fade" id="nonaktifJadwal<?= $jt['id_jadwal_tes']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('jadwaltes/hapus_jadwal'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Jadwal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $jt['nama_jadwal']; ?></strong></span>
                                <input type="hidden" name="id_jadwal_tes_nonaktif" id="id_jadwal_tes_nonaktif" value="<?= $jt['id_jadwal_tes']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Non Aktif -->
<?php foreach ($JadwalTes as $jt): ?>
    <div class="modal fade" id="JadwalSelesai<?= $jt['id_jadwal_tes']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('jadwaltes/jadwal_selesai'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Data Jadwal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menyelesaikan Jadwal <strong><?= $jt['nama_jadwal']; ?> Pada <?= $jt['nama_hari']; ?>, <?= tanggal_indonesia_format2($jt['tanggal_tes']); ?> </strong></span>
                                <input type="hidden" name="id_jadwal_tes_selesai" id="id_jadwal_tes_selesai" value="<?= $jt['id_jadwal_tes']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-info" type="submit">Ya, Selesai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<!-- End of Content Wrapper -->