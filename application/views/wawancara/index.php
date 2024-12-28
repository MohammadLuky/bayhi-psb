<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('wawancara'); ?>"><?= $title; ?></a></li>
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

            <div class="row">
                <div class="col-md-8 mb-2">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Data Tambahan Wawancara</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                                        Input Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Item Wawancara</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('wawancara/item_wawancara'); ?>" class="btn btn-sm btn-primary">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-sm font-weight-bold text-info text-uppercase mb-1">
                                                        Input Data</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Item & Jenis Wawancara</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-4 justify-content-end">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('wawancara/item_jenis_wawancara'); ?>" class="btn btn-sm btn-info">Detail >>></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#tambahWawancara">
                                <i class="fas fa-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Wawancara</th>
                                            <!-- <th>Nama Penilai</th> -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $no = 1;
                                        foreach ($DataWawancara as $wawancara): ?>
                                            <tr class="text-center">
                                                <td><?= $wawancara['id_jenis_wawancara']; ?></td>
                                                <td><?= $wawancara['jenis_wawancara']; ?></td>
                                                <!-- <?php if (!empty($wawancara['nama_lengkap_pegawai'])): ?>
                                                    <td><?= $wawancara['nama_lengkap_pegawai']; ?></td>
                                                <?php else: ?>
                                                    <td><span class="badge badge-danger">Penilai Belum dipilih.</span></td>
                                                <?php endif; ?> -->
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editWawancara<?= $wawancara['id_jenis_wawancara']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusWawancara<?= $wawancara['id_jenis_wawancara']; ?>"><i class="fas fa-times-circle"></i></a>
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

<div class="modal fade" id="tambahWawancara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('wawancara'); ?>" method="post">
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
                            <label for="exampleFormControlInput1" class="form-label"><?= $title; ?></label>
                            <input type="text" class="form-control" id="jenis_wawancara" name="jenis_wawancara" placeholder="Isilah Jenis Wawancara" autocomplete="off">
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
<?php foreach ($DataWawancara as $wawancara): ?>
    <div class="modal fade" id="editWawancara<?= $wawancara['id_jenis_wawancara']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('wawancara/edit_wawancara'); ?>" method="post">
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
                                    <input type="text" id="jenis_wawancara_edit" name="jenis_wawancara_edit" class="form-control" placeholder="Jenis Wawancara" autocomplete="off" value="<?= $wawancara['jenis_wawancara']; ?>">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Penilai</label>
                                    <select class="form-select select2" id="penilai_id" name="penilai_id" aria-label="Default select example">
                                        <option value="">Pilih Penilai</option>
                                        <?php foreach ($penilai as $p): ?>
                                            <?php if ($wawancara['penilai_id'] == $p['id_pegawai_psb']): ?>
                                                <option value="<?= $p['id_pegawai_psb']; ?>" selected><?= $p['nama_lengkap_pegawai']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $p['id_pegawai_psb']; ?>"><?= $p['nama_lengkap_pegawai']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div> -->
                            </div>
                            <input type="hidden" name="id_jenis_wawancara" id="id_jenis_wawancara" value="<?= $wawancara['id_jenis_wawancara']; ?>">
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
<?php foreach ($DataWawancara as $wawancara): ?>
    <div class="modal fade" id="hapusWawancara<?= $wawancara['id_jenis_wawancara']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('wawancara/hapus_wawancara'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Jenis Wawancara</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $wawancara['jenis_wawancara']; ?></strong></span>
                                <input type="hidden" name="id_jenis_wawancara_hapus" id="id_jenis_wawancara_hapus" value="<?= $wawancara['id_jenis_wawancara']; ?>">
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