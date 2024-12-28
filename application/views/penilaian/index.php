<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('penilaian'); ?>"><?= $title; ?></a></li>
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

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#tambahPenilaian">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Penilaian</th>
                                            <th>Nama Penilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($DataPenilaian as $penilaian): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $penilaian['nama_penilaian']; ?></td>
                                                <?php if (!empty($penilaian['nama_lengkap_pegawai'])): ?>
                                                    <td><?= $penilaian['nama_lengkap_pegawai']; ?></td>
                                                <?php else: ?>
                                                    <td><span class="badge badge-danger">Penilai Belum dipilih.</span></td>
                                                <?php endif; ?>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editPenilaian<?= $penilaian['id_jenis_penilaian']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusPenilaian<?= $penilaian['id_jenis_penilaian']; ?>"><i class="fas fa-times-circle"></i></a>
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

<div class="modal fade" id="tambahPenilaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('penilaian'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah <?= $title; ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama <?= $title; ?></label>
                            <input type="text" class="form-control" id="nama_penilaian" name="nama_penilaian" placeholder="Isilah Nama Penilaian" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($DataPenilaian as $penilaian): ?>
    <div class="modal fade" id="editPenilaian<?= $penilaian['id_jenis_penilaian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('penilaian/edit_penilaian'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit <?= $title; ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><?= $title; ?></label>
                                    <input type="text" id="nama_penilaian_edit" name="nama_penilaian_edit" class="form-control" placeholder="Jenis penilaian" autocomplete="off" value="<?= $penilaian['nama_penilaian']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Penilai</label>
                                    <select class="form-select select2" id="penilai_id" name="penilai_id" aria-label="Default select example">
                                        <option value="">Pilih Penilai</option>
                                        <?php foreach ($penilai as $p): ?>
                                            <?php if ($penilaian['penilai_id'] == $p['id_pegawai_psb']): ?>
                                                <option value="<?= $p['id_pegawai_psb']; ?>" selected><?= $p['nama_lengkap_pegawai']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $p['id_pegawai_psb']; ?>"><?= $p['nama_lengkap_pegawai']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_jenis_penilaian" id="id_jenis_penilaian" value="<?= $penilaian['id_jenis_penilaian']; ?>">
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
<?php foreach ($DataPenilaian as $penilaian): ?>
    <div class="modal fade" id="hapusPenilaian<?= $penilaian['id_jenis_penilaian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('penilaian/hapus_penilaian'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Jenis penilaian</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $penilaian['nama_penilaian']; ?></strong></span>
                                <input type="hidden" name="id_jenis_penilaian_hapus" id="id_jenis_penilaian_hapus" value="<?= $penilaian['id_jenis_penilaian']; ?>">
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