<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('pengguna'); ?>"><?= $title; ?></a></li>
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
                            <h6 class="m-0 font-weight-bold text-white">Tambah Pegawai</h6>
                        </div>
                        <form action="<?= base_url('pengguna'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No. HP Pegawai</label>
                                            <input type="text" id="niy_pegawai" name="niy_pegawai" class="form-control" placeholder="No HP Pegawai" autocomplete="off" value="<?= set_value('niy_pegawai'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap Pegawai</label>
                                            <input type="text" id="nama_lengkap_pegawai" name="nama_lengkap_pegawai" class="form-control" placeholder="Nama Lengkap Pegawai" autocomplete="off" value="<?= set_value('nama_lengkap_pegawai'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="">Pilih Role Pegawai</label>
                                            <select class="form-select select2" id="role_id" name="role_id" aria-label="Default select example">
                                                <option value="">Pilih Role</option>
                                                <?php foreach ($role as $r): ?>
                                                    <option value="<?= $r['id_role']; ?>"><?= $r['ket_role']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                                            <th>NIY Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>Role</th>
                                            <th>Unit Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($AllPegawai as $pegawai): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $pegawai['niy_pegawai']; ?></td>
                                                <td><?= $pegawai['nama_lengkap_pegawai']; ?></td>
                                                <td><?= $pegawai['ket_role']; ?></td>
                                                <?php if ($pegawai['role_id'] == 2): ?>
                                                    <?php if ($pegawai['unit_tugas_id'] != 0): ?>
                                                        <td><?= $pegawai['nama_tingkat']; ?></td>
                                                    <?php else: ?>
                                                        <td><span class="badge badge-danger">Belum Dipilih Unit Tugas</span></td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td><span class="badge badge-danger">Tidak Ada Unit Tugas</span></td>
                                                <?php endif; ?>
                                                <td>
                                                    <?php if ($pegawai['role_id'] == 2): ?>
                                                        <a href="" class="btn btn-sm btn-success btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih Unit Tugas" data-toggle="modal" data-target="#EditUnitTugas<?= $pegawai['id_pegawai_psb']; ?>"><i class="fas fa-check-circle"></i></a>
                                                    <?php endif; ?>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role" data-toggle="modal" data-target="#editRole<?= $pegawai['id_pegawai_psb']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusTingkat<?= $pegawai['id_pegawai_psb']; ?>"><i class="fas fa-times-circle"></i></a>
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
<?php foreach ($AllPegawai as $pegawai): ?>
    <div class="modal fade" id="editRole<?= $pegawai['id_pegawai_psb']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pengguna/edit_role_pegawai'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Role Pengguna</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" value="<?= $pegawai['username']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" value="<?= $pegawai['pass_tampil']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Role Pegawai</label>
                                    <select class="form-select select2" id="role_id_edit" name="role_id_edit" aria-label="Default select example">
                                        <option value="">Pilih Role</option>
                                        <?php foreach ($role as $r): ?>
                                            <?php if ($pegawai['role_id'] == $r['id_role']): ?>
                                                <option value="<?= $r['id_role']; ?>" selected><?= $r['ket_role']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $r['id_role']; ?>"><?= $r['ket_role']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="pegawai_psb_id" id="pegawai_psb_id" value="<?= $pegawai['id_pegawai_psb']; ?>">
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

<!-- Modal Edit Unit Tugas -->
<?php foreach ($AllPegawai as $pegawai): ?>
    <div class="modal fade" id="EditUnitTugas<?= $pegawai['id_pegawai_psb']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pengguna/edit_unit_tugas'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Tingkat Sekolah</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Unit Tugas</label>
                                <select class="form-select select2" id="unit_tugas_edit" name="unit_tugas_edit" aria-label="Default select example">
                                    <option value="">Pilih Unit Tugas</option>
                                    <?php foreach ($tingkat as $t): ?>
                                        <?php if ($pegawai['unit_tugas_id'] == $t['id_tingkat_sekolah']): ?>
                                            <option value="<?= $t['id_tingkat_sekolah']; ?>" selected><?= $t['nama_tingkat']; ?></option>
                                        <?php else: ?>
                                            <option value="<?= $t['id_tingkat_sekolah']; ?>"><?= $t['nama_tingkat']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" name="pegawai_id_tingkat" id="pegawai_id_tingkat" value="<?= $pegawai['id_pegawai_psb']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($AllPegawai as $pegawai): ?>
    <div class="modal fade" id="hapusTingkat<?= $pegawai['id_pegawai_psb']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('pengguna/hapus_pengguna'); ?>" method="post">
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
                                <span>Apakah anda yakin akan menghapus data <strong><?= $pegawai['nama_lengkap_pegawai']; ?></strong></span>
                                <input type="hidden" name="id_pegawai_psb_hapus" id="id_pegawai_psb_hapus" value="<?= $pegawai['id_pegawai_psb']; ?>">
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