<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('master/tapel'); ?>"><?= $title; ?></a></li>
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
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Tambah Tingkat Sekolah</h6>
                        </div>
                        <form action="<?= base_url('master/tingkat_sekolah'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Tingkat</label>
                                            <input type="text" id="nama_tingkat" name="nama_tingkat" class="form-control" placeholder="Nama Tingkat" autocomplete="off" value="<?= set_value('nama_tingkat'); ?>">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Bank Data</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Data Tingkat dan Program</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-4">
                                <a href="<?= base_url('master/data_tingkat_program'); ?>" class="btn btn-sm btn-warning">Detail >>></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
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
                                            <th>Nama Tingkat</th>
                                            <!-- <th>Nama Program</th> -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($Alltingkat as $tingkat): ?>
                                            <tr class="text-center">
                                                <td><?= $tingkat['id_tingkat_sekolah']; ?></td>
                                                <td><?= $tingkat['nama_tingkat']; ?></td>
                                                <!-- <td><?= $tingkat['nama_program']; ?></td> -->
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editTingkat<?= $tingkat['id_tingkat_sekolah']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusTingkat<?= $tingkat['id_tingkat_sekolah']; ?>"><i class="fas fa-times-circle"></i></a>
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
<?php foreach ($Alltingkat as $tingkat): ?>
    <div class="modal fade" id="editTingkat<?= $tingkat['id_tingkat_sekolah']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/edit_tingkat'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Tingkat Sekolah</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tingkat Sekolah</label>
                                <input type="text" class="form-control" id="nama_tingkat_edit" name="nama_tingkat_edit" placeholder="Isilah Tingkat Sekolah" autocomplete="off" value="<?= $tingkat['nama_tingkat']; ?>">
                                <input type="hidden" name="id_tingkat_sekolah" id="id_tingkat_sekolah" value="<?= $tingkat['id_tingkat_sekolah']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Program Jenjang</label>
                                <select class="form-control select2" name="pogram_tingkat_id_edit" id="pogram_tingkat_id_edit">
                                    <option value="">Pilih Program Jenjang</option>
                                    <?php foreach ($progjen as $pj): ?>
                                        <?php if ($tingkat['pogram_tingkat_id'] == $pj['id_program_jenjang']): ?>
                                            <option value="<?= $pj['id_program_jenjang']; ?>" selected><?= $pj['nama_program']; ?></option>
                                        <?php else: ?>
                                            <option value="<?= $pj['id_program_jenjang']; ?>"><?= $pj['nama_program']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
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
<?php foreach ($Alltingkat as $tingkat): ?>
    <div class="modal fade" id="hapusTingkat<?= $tingkat['id_tingkat_sekolah']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/hapus_tingkat'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Tingkat Sekolah</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin akan menghapus data <strong><?= $tingkat['nama_tingkat']; ?></strong></span>
                                <input type="hidden" name="id_tingkat_sekolah_hapus" id="id_tingkat_sekolah_hapus" value="<?= $tingkat['id_tingkat_sekolah']; ?>">
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