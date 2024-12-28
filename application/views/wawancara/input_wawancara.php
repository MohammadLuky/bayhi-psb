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

            <!-- <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?> -->

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jenis Wawancara</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('item_jenis_wawancara_id') != '') ? 'is-invalid' : ''; ?>" name="item_jenis_wawancara_id" id="item_jenis_wawancara_id">
                                            <option value="">Pilih Jenis Wawancara</option>
                                            <?php foreach ($DataWawancara as $wawancara): ?>
                                                <option value="<?= $wawancara['id_item_jenis_wawancara']; ?>"><?= $wawancara['jenis_wawancara']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('item_jenis_wawancara_id'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jadwal Tes</label> <code>*</code>
                                        <select class="form-control select2 <?= (form_error('jadwal_wawancara_id') != '') ? 'is-invalid' : ''; ?>" name="jadwal_wawancara_id" id="jadwal_wawancara_id">
                                            <option value="">Pilih Jadwal Tes</option>
                                            <?php foreach ($DataJadwal as $jadwal): ?>
                                                <option value="<?= $jadwal['id_jadwal_tes']; ?>"><?= $jadwal['nama_jadwal']; ?> | <?= $jadwal['nama_tahap']; ?> - <?= $jadwal['nama_hari']; ?>, <?= tanggal_indonesia_format2($jadwal['tanggal_tes']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('jadwal_wawancara_id'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success" id="filterInputWawancara">Filter</button>
                            <button class="btn btn-sm btn-danger" id="resetInputWawancara">Reset</button>
                            <button class="btn btn-sm btn-info reload-page" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload Data"><i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="filter_wawancara">

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