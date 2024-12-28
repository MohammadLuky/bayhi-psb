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

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Tambah Jenis Pembayaran</h6>
                        </div>
                        <form action="<?= base_url('pembayaran/jenis_pembayaran'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Program Jenjang</label>
                                            <select class="form-control select2" name="program_pembayaran_id" id="program_pembayaran_id">
                                                <option value="">Pilih Program Jenjang</option>
                                                <?php foreach ($DataProgram as $program): ?>
                                                    <option value="<?= $program['id_program_jenjang']; ?>"><?= $program['nama_program']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tingkat / Jenjang Sekolah</label>
                                            <select class="form-control select2" name="jenjang_pembayaran_id" id="jenjang_pembayaran_id">
                                                <option value="">Pilih Tingkat / Jenjang Sekolah</option>
                                                <!-- <?php foreach ($DataJenjang as $jenjang): ?>
                                                    <option value="<?= $jenjang['id_tingkat_sekolah']; ?>"><?= $jenjang['nama_tingkat']; ?></option>
                                                <?php endforeach; ?> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tahun Pelajaran</label>
                                            <select class="form-control select2" name="tapel_pembayaran_id" id="tapel_pembayaran_id">
                                                <option value="">Pilih Tahun Pelajaran</option>
                                                <?php foreach ($DataTapel as $tapel): ?>
                                                    <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jenis Pembayaran</label>
                                            <input type="text" id="jenis_pembayaran" name="jenis_pembayaran" class="form-control" placeholder="Jenis Pembayaran" autocomplete="off" value="<?= set_value('jenis_pembayaran'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nominal Pembayaran</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" id="nominal_jenis_pembayaran" name="nominal_jenis_pembayaran" class="form-control nominal-form" placeholder="Nominal Pembayaran" autocomplete="off" value="<?= set_value('nominal_jenis_pembayaran'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Rekening</label>
                                            <input type="number" id="no_rek_pembayaran" name="no_rek_pembayaran" class="form-control" placeholder="No. Rekening" autocomplete="off" value="<?= set_value('no_rek_pembayaran'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Rekening</label>
                                            <input type="text" id="nama_rekening" name="nama_rekening" class="form-control" placeholder="Nama Rekening" autocomplete="off" value="<?= set_value('nama_rekening'); ?>">
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
                                            <th>Jenis Pembayaran</th>
                                            <th>Program Jenjang Tahun Pelajaran</th>
                                            <th>Rekening</th>
                                            <th>Nominal Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($DataPembayaran as $pembayaran): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $pembayaran['nama_jenis_pembayaran']; ?></td>
                                                <td><?= $pembayaran['nama_tingkat']; ?> | <?= $pembayaran['nama_program']; ?> | <?= $pembayaran['ket_tapel']; ?></td>
                                                <td><?= $pembayaran['nama_rekening']; ?> | <?= $pembayaran['no_rek_pembayaran']; ?></td>
                                                <td><?= formatRupiah($pembayaran['nominal_jenis_pembayaran']); ?></td>
                                                <td>
                                                    <?php if ($pembayaran['id_jenis_pembayaran'] == 1): ?>
                                                        <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editPembayaran<?= $pembayaran['id_jenis_pembayaran']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <?php else: ?>
                                                        <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editPembayaran<?= $pembayaran['id_jenis_pembayaran']; ?>"><i class="fas fa-info-circle"></i></a>
                                                        <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusTingkat<?= $pembayaran['id_jenis_pembayaran']; ?>"><i class="fas fa-times-circle"></i></a>
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
<?php foreach ($DataPembayaran as $pembayaran): ?>
    <div class="modal fade" id="editPembayaran<?= $pembayaran['id_jenis_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pembayaran/edit_jenis_pembayaran'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Jenis Pembayaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Program Jenjang</label>
                                    <select class="form-control select2" name="program_pembayaran_id_edit" id="program_pembayaran_id_edit">
                                        <option value="">Pilih Program Jenjang</option>
                                        <?php foreach ($DataProgram as $program): ?>
                                            <?php if ($pembayaran['program_pembayaran_id'] == $program['id_program_jenjang']): ?>
                                                <option value="<?= $program['id_program_jenjang']; ?>" selected><?= $program['nama_program']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $program['id_program_jenjang']; ?>"><?= $program['nama_program']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tingkat / Jenjang Sekolah</label>
                                    <select class="form-control select2" name="jenjang_pembayaran_id_edit" id="jenjang_pembayaran_id_edit">
                                        <option value="">Pilih Tingkat / Jenjang Sekolah</option>
                                        <?php foreach ($DataJenjang as $jenjang): ?>
                                            <?php if ($pembayaran['jenjang_pembayaran_id'] == $program['id_tingkat_sekolah']): ?>
                                                <option value="<?= $jenjang['id_tingkat_sekolah']; ?>" selected><?= $jenjang['nama_tingkat']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $jenjang['id_tingkat_sekolah']; ?>"><?= $jenjang['nama_tingkat']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun Pelajaran</label>
                                    <select class="form-control select2" name="tapel_pembayaran_id_edit" id="tapel_pembayaran_id_edit">
                                        <option value="">Pilih Tahun Pelajaran</option>
                                        <?php foreach ($DataTapel as $tapel): ?>
                                            <?php if ($pembayaran['tapel_pembayaran_id'] == $program['id_tapel']): ?>
                                                <option value="<?= $tapel['id_tapel']; ?>" selected><?= $tapel['ket_tapel']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Pembayaran</label>
                                    <input type="text" id="jenis_pembayaran_edit" name="jenis_pembayaran_edit" class="form-control" placeholder="Jenis Pembayaran" autocomplete="off" value="<?= $pembayaran['nama_jenis_pembayaran']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nominal Pembayaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" id="nominal_jenis_pembayaran_edit" name="nominal_jenis_pembayaran_edit" class="form-control nominal-form" placeholder="Nominal Pembayaran" autocomplete="off" value="<?= $pembayaran['nominal_jenis_pembayaran']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Rekening</label>
                                    <input type="number" id="no_rek_pembayaran_edit" name="no_rek_pembayaran_edit" class="form-control" placeholder="No. Rekening" autocomplete="off" value="<?= $pembayaran['no_rek_pembayaran']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Rekening</label>
                                    <input type="nama" id="nama_rekening_edit" name="nama_rekening_edit" class="form-control" placeholder="No. Rekening" autocomplete="off" value="<?= $pembayaran['nama_rekening']; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="id_jenis_pembayaran" id="id_jenis_pembayaran" value="<?= $pembayaran['id_jenis_pembayaran']; ?>">
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
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($DataPembayaran as $pembayaran): ?>
    <div class="modal fade" id="hapusTingkat<?= $pembayaran['id_jenis_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pembayaran/hapus_jenis_pembayaran'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Jenis Pembayaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $pembayaran['nama_jenis_pembayaran']; ?></strong></span>
                                <input type="hidden" name="id_jenis_pembayaran_hapus" id="id_jenis_pembayaran_hapus" value="<?= $pembayaran['id_jenis_pembayaran']; ?>">
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
<!-- End of Content Wrapper -->