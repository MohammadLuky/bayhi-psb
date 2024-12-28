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

            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white">Tambah <?= $title; ?></h6>
                        </div>
                        <form action="<?= base_url('master/data_tingkat_program'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Program Jenjang</label>
                                            <select class="form-control select2" name="data_pogram_id" id="data_pogram_id">
                                                <option value="">Pilih Program Jenjang</option>
                                                <?php foreach ($DataProgram as $dp): ?>
                                                    <option value="<?= $dp['id_program_jenjang']; ?>"><?= $dp['nama_program']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tingkat Sekolah</label>
                                            <select class="form-control select2" name="data_tingkat_id" id="data_tingkat_id">
                                                <option value="">Pilih Tingkat Sekolah</option>
                                                <?php foreach ($DataTingkat as $dt): ?>
                                                    <option value="<?= $dt['id_tingkat_sekolah']; ?>"><?= $dt['nama_tingkat']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">Data <?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tingkat</th>
                                            <th>Nama Program</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($DataTingProg as $tingprog): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $tingprog['nama_tingkat']; ?></td>
                                                <td><?= $tingprog['nama_program']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editTingkat<?= $tingprog['id_tingkat_sekolah']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusTingkat<?= $tingprog['id_tingkat_sekolah']; ?>"><i class="fas fa-times-circle"></i></a>
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
<?php foreach ($DataTingProg as $tingprog): ?>
    <div class="modal fade" id="editTingkat<?= $tingprog['id_data_tingkat_program']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/edit_tingkat_program'); ?>" method="post">
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
                                    <label for="">Program Jenjang</label>
                                    <select class="form-control select2" name="data_pogram_id_edit" id="data_pogram_id_edit">
                                        <option value="">Pilih Program Jenjang</option>
                                        <?php foreach ($DataProgram as $dp): ?>
                                            <?php if ($tingprog['data_pogram_id'] == $dp['id_program_jenjang']): ?>
                                                <option value="<?= $dp['id_program_jenjang']; ?>" selected><?= $dp['nama_program']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dp['id_program_jenjang']; ?>"><?= $dp['nama_program']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="id_data_tingkat_program" id="id_data_tingkat_program" value="<?= $tingprog['id_data_tingkat_program']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Program Jenjang</label>
                                    <select class="form-control select2" name="data_tingkat_id_edit" id="data_tingkat_id_edit">
                                        <option value="">Pilih Program Jenjang</option>
                                        <?php foreach ($DataTingkat as $dt): ?>
                                            <?php if ($tingprog['data_tingkat_id'] == $dt['id_tingkat_sekolah']): ?>
                                                <option value="<?= $dt['id_tingkat_sekolah']; ?>" selected><?= $dt['nama_tingkat']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dt['id_tingkat_sekolah']; ?>"><?= $dt['nama_tingkat']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
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
<?php foreach ($DataTingProg as $tingprog): ?>
    <div class="modal fade" id="hapusTingkat<?= $tingprog['id_data_tingkat_program']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('master/hapus_tingkat_program'); ?>" method="post">
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
                                <span>Apakah anda yakin akan menghapus data <strong><?= $tingprog['nama_tingkat']; ?> - <?= $tingprog['nama_program']; ?></strong></span>
                                <input type="hidden" name="id_data_tingkat_program_hapus" id="id_data_tingkat_program_hapus" value="<?= $tingprog['id_data_tingkat_program']; ?>">
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