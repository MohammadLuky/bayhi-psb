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

            <!-- <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-danger">
                            <h6 class="m-0 font-weight-bold text-white">Tambah <?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tahun Pelajaran</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('tapel_santri_diterima') != '') ? 'is-invalid' : ''; ?>" name="tapel_santri_diterima" id="tapel_santri_diterima">
                                            <option value="">Pilih Tahun Pelajaran</option>
                                            <?php foreach ($AllTapel as $tapel): ?>
                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('tapel_santri_diterima'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nama Santri Yang Diterima</label>
                                        <select class="form-control select2-multiple <?= (form_error('santri_diterima') != '') ? 'is-invalid' : ''; ?>" name="santri_diterima[]" id="santri_diterima" multiple="multiple">
                                            <option value="">Pilih Calon Santri</option>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('santri_diterima'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Aksi Penerimaan</label>
                                        <select class="form-control select2 <?= (form_error('aksi_penerimaan') != '') ? 'is-invalid' : ''; ?>" name="aksi_penerimaan" id="aksi_penerimaan">
                                            <option value="">Pilih Calon Santri</option>
                                            <option value="1">Diterima</option>
                                            <option value="99">Ditolak</option>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('aksi_penerimaan'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-sm btn-success" id="AddSantriDiterima"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-info">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="">Tahun Pelajaran</label> <code>*</code>
                                    <select class="form-control select2 <?= (form_error('tapel_santri_finish') != '') ? 'is-invalid' : ''; ?>" name="tapel_santri_finish" id="tapel_santri_finish">
                                        <option value="">Pilih Tahun Pelajaran</option>
                                        <?php foreach ($AllTapel as $tapel): ?>
                                            <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= form_error('tapel_santri_finish'); ?></div>
                                </div>
                                <!-- <div class="d-flex justify-content-end mt-3"> -->
                                <button type="button" class="btn btn-sm btn-primary" id="FilterSantriFinish"><i class="fas fa-filter"></i> Filter</button>
                                <button type="button" class="btn btn-sm btn-danger ml-2" id="ResetSantriFinish"><i class="fas fa-undo"></i> Reset</button>
                                <!-- </div> -->
                            </div>
                            <div class="row">
                                <div id="load_SantriDiterima">

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