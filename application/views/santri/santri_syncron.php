<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri/data_santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div id="load_Datacasan">
                    <div class="col-md-12">
                        <div class="card mb-2">
                            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6>
                                <a href="<?= base_url('santri/getsync_datasantri'); ?>" class="btn btn-sm btn-light">
                                    <i class="fas fa-sync"></i> Syncron Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="">Tahun Pelajaran</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('tapel_syncCasan') != '') ? 'is-invalid' : ''; ?>" name="tapel_syncCasan" id="tapel_syncCasan">
                                            <option value="">Pilih Tahun Pelajaran</option>
                                            <?php foreach ($TapelAll as $tapel): ?>
                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('tapel_syncCasan'); ?></div>
                                    </div>
                                    <!-- <div class="d-flex justify-content-end mt-3"> -->
                                    <button type="button" class="btn btn-sm btn-primary" id="FilterCasanSync"><i class="fas fa-filter"></i> Filter</button>
                                    <button type="button" class="btn btn-sm btn-danger ml-2" id="ResetCasanSync"><i class="fas fa-undo"></i> Reset</button>
                                    <!-- </div> -->
                                </div>
                                <div class="row">
                                    <div id="loading" style="display: none;">
                                        <div class="spinner"></div>
                                        <p>Loading data...</p>
                                    </div>
                                    <div id="load_CasanSync">

                                    </div>
                                </div>

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

<!-- Modal Ganti Tahun Pelajaran -->
<?php foreach ($AllSantri as $santri): ?>
    <div class="modal fade" id="GantiTapel<?= $santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('santri/ganti_tapel/' . $santri['id_santri']); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Ubah Tahun Pelajaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Tahun Pelajaran Inden</label> <code>*</code>
                                <select class="form-control select2" name="ganti_tapel_id" id="ganti_tapel_id">
                                    <option value="">Pilih Tahun Pelajaran</option>
                                    <?php foreach ($TapelAll as $tapel): ?>
                                        <?php if ($tapel['status_tapel'] == 1): ?>
                                            <?php if ($santri['tapel_inden_id'] == $tapel['id_tapel']): ?>
                                                <option value="<?= $tapel['id_tapel']; ?>" selected><?= $tapel['ket_tapel']; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                            <?php endif; ?>
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

<!-- Modal Melihat Akun -->
<?php foreach ($AllSantri as $santri): ?>
    <div class="modal fade" id="AkunSantri<?= $santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Akun Santri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" value="<?= $santri['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" class="form-control" value="<?= $santri['pass_tampil']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus Data -->
<?php foreach ($AllSantri as $santri): ?>
    <div class="modal fade" id="HapusSantri<?= $santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('santri/hapus_santri/' . $santri['id_santri']); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Santri</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Apakah Anda Yakin Akan Menghapus Data Santri Tersebut ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Ya, Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Mengaktifkan Santri -->
<?php foreach ($AllSantri as $santri): ?>
    <div class="modal fade" id="SantriDiaktifkan<?= $santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('santri/status_santri_aktif/' . $santri['id_santri']); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Aktivasi Santri</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Apakah Anda Yakin Akan Mengubah Data Santri Tersebut menjadi santri Aktif ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Ya, Diaktifkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus Data -->
<?php foreach ($AllSantri as $santri): ?>
    <div class="modal fade" id="HapusSantriPermanent<?= $santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('santri/hapus_permanen_santri/' . $santri['id_santri']); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Hapus Permanen Santri</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Apakah Anda Yakin Akan Menghapus Permanen Data Santri Tersebut ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Ya, Hapus Permanen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>