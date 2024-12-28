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
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jadwal Tes</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('jadwal_santri_diterima') != '') ? 'is-invalid' : ''; ?>" name="jadwal_santri_diterima" id="jadwal_santri_diterima">
                                            <option value="">Pilih Jadwal Tes</option>
                                            <?php foreach ($JadwalTes as $jadwal): ?>
                                                <option value="<?= $jadwal['id_jadwal_tes']; ?>"><?= $jadwal['nama_jadwal']; ?> | <?= $jadwal['nama_tahap']; ?> - <?= $jadwal['nama_hari']; ?>, <?= tanggal_indonesia_format2($jadwal['tanggal_tes']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('jadwal_santri_diterima'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Program Jenjang</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('filter_program_pleno') != '') ? 'is-invalid' : ''; ?>" name="filter_program_pleno" id="filter_program_pleno">
                                            <option value="">Pilih Program Jenjang</option>
                                            <?php foreach ($ProgramJenjang as $program): ?>
                                                <option value="<?= $program['id_program_jenjang']; ?>"><?= $program['nama_program']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('filter_program_pleno'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mb-4" id="FilterJadwalSantriPleno"><i class="fas fa-filter"></i> Filter</button>
                            <button type="button" class="btn btn-sm btn-danger ml-2 mb-4" id="ResetJadwalSantriPleno"><i class="fas fa-undo"></i> Reset</button>
                            <div class="row">
                                <div id="loading" style="display: none;">
                                    <div class="spinner"></div>
                                    <p>Loading data...</p>
                                </div>
                                <div id="RekapPleno_byJadwal">
                                </div>
                                <div id="Santri_byJadwal">
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