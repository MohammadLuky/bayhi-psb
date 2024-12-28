<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('wawancara/item_jenis_wawancara'); ?>"><?= $title; ?></a></li>
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
                        <form action="<?= base_url('wawancara/item_jenis_wawancara'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Jenis Wawancara</label>
                                            <select class="form-control select2" name="data_jenis_wawancara_id" id="data_jenis_wawancara_id">
                                                <option value="">Pilih Jenis Wawancara</option>
                                                <?php foreach ($DataWawancara as $wawancara): ?>
                                                    <option value="<?= $wawancara['id_jenis_wawancara']; ?>"><?= $wawancara['jenis_wawancara']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Item Wawancara</label>
                                            <select class="form-control select2" name="data_item_wawancara_id" id="data_item_wawancara_id">
                                                <option value="">Pilih Item Wawancara</option>
                                                <?php foreach ($DataItemWawancara as $item): ?>
                                                    <option value="<?= $item['id_item_wawancara']; ?>"><?= $item['item_wawancara']; ?></option>
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
                                            <th>Jenis Wawancara</th>
                                            <th>Item Wawancara</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($ItemJenisWawancara as $ijw): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $ijw['jenis_wawancara']; ?></td>
                                                <td><?= $ijw['item_wawancara']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-toggle="modal" data-target="#editItemJenisWawancara<?= $ijw['id_item_jenis_wawancara']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-toggle="modal" data-target="#hapusItemJenisWawancara<?= $ijw['id_item_jenis_wawancara']; ?>"><i class="fas fa-times-circle"></i></a>
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
<?php foreach ($ItemJenisWawancara as $ijw): ?>
    <div class="modal fade" id="editItemJenisWawancara<?= $ijw['id_item_jenis_wawancara']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('wawancara/edit_item_jenis_wawancara'); ?>" method="post">
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
                                <input type="hidden" name="id_item_jenis_wawancara" id="id_item_jenis_wawancara" value="<?= $ijw['id_item_jenis_wawancara']; ?>">
                                <div class="form-group">
                                    <label for="">Jenis Wawancara</label>
                                    <select class="form-control select2" name="data_jenis_wawancara_id_edit" id="data_jenis_wawancara_id_edit">
                                        <option value="">Pilih Jenis Wawancara</option>
                                        <?php foreach ($DataWawancara as $wawancara): ?>
                                            <?php if ($wawancara['id_jenis_wawancara'] == $ijw['data_jenis_wawancara_id']): ?>
                                                <option value="<?= $wawancara['id_jenis_wawancara']; ?>" selected><?= $wawancara['jenis_wawancara']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $wawancara['id_jenis_wawancara']; ?>"><?= $wawancara['jenis_wawancara']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Item Wawancara</label>
                                    <select class="form-control select2" name="data_item_wawancara_id_edit" id="data_item_wawancara_id_edit">
                                        <option value="">Pilih Item Wawancara</option>
                                        <?php foreach ($DataItemWawancara as $item): ?>
                                            <?php if ($item['id_item_wawancara'] == $ijw['data_item_wawancara_id']): ?>
                                                <option value="<?= $item['id_item_wawancara']; ?>" selected><?= $item['item_wawancara']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $item['id_item_wawancara']; ?>"><?= $item['item_wawancara']; ?></option>
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
<?php foreach ($ItemJenisWawancara as $ijw): ?>
    <div class="modal fade" id="hapusItemJenisWawancara<?= $ijw['id_item_jenis_wawancara']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('wawancara/hapus_item_jenis_wawancara'); ?>" method="post">
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
                                <span>Apakah anda yakin akan menghapus data <strong><?= $ijw['jenis_wawancara']; ?> - <?= $ijw['item_wawancara']; ?></strong></span>
                                <input type="hidden" name="id_item_jenis_wawancara_hapus" id="id_item_jenis_wawancara_hapus" value="<?= $ijw['id_item_jenis_wawancara']; ?>">
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