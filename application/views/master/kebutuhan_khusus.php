<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('master/data_pelengkap'); ?>">Data Pelengkap</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('master/kebutuhan_khusus'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                </div>
                <div class="col-lg-2 justify-content-end">
                    <a href="<?= base_url('master/data_pelengkap'); ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Pelengkap"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
            </div>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                                </div>
                                <div class="col-sm-2 justify-content-md-end">
                                    <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#tambahKebsus">
                                        <i class="fas fa-plus-circle"></i> Tambah Data
                                    </a>
                                    <!-- <a href="<?= base_url('master/get_agama_api'); ?>" class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Sync Data Kebutuhan Khusus">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Ket Kebutuhan Khusus</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($Allkebsus as $kebsus): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $kebsus['ket_kebutuhan_khusus']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editKebsus<?= $kebsus['id_kebutuhan_khusus']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusKebsus<?= $kebsus['id_kebutuhan_khusus']; ?>"><i class="fas fa-times-circle"></i></a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahKebsus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('master/kebutuhan_khusus'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Kebutuhan Khusus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Keterangan Kebutuhan Khusus</label>
                            <input type="text" class="form-control" id="ket_kebutuhan_khusus" name="ket_kebutuhan_khusus" placeholder="Isilah Keterangan Kebutuhan Khusus" autocomplete="off">
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
<?php foreach ($Allkebsus as $kebsus): ?>
    <div class="modal fade" id="editKebsus<?= $kebsus['id_kebutuhan_khusus']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/edit_kebutuhan_khusus'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Kebutuhan Khusus</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Keterangan Kebutuhan Khusus</label>
                                <input type="text" class="form-control" id="ket_kebutuhan_khusus_edit" name="ket_kebutuhan_khusus_edit" placeholder="Isilah Kebutuhan Khusus" autocomplete="off" value="<?= $kebsus['ket_kebutuhan_khusus']; ?>">
                                <input type="hidden" name="id_kebutuhan_khusus" id="id_kebutuhan_khusus" value="<?= $kebsus['id_kebutuhan_khusus']; ?>">
                            </div>
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
<?php foreach ($Allkebsus as $kebsus): ?>
    <div class="modal fade" id="hapusKebsus<?= $kebsus['id_kebutuhan_khusus']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/hapus_kebutuhan_khusus'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Kebutuhan Khusus</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $kebsus['ket_kebutuhan_khusus']; ?></strong></span>
                                <input type="hidden" name="id_kebutuhan_khusus_hapus" id="id_kebutuhan_khusus_hapus" value="<?= $kebsus['id_kebutuhan_khusus']; ?>">
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