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
                        <div class="card-header bg-info">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="">Tahun Pelajaran</label> <code>*</code>
                                    <select class="form-control select2 <?= (form_error('tapel_finish_persekolah') != '') ? 'is-invalid' : ''; ?>" name="tapel_finish_persekolah" id="tapel_finish_persekolah">
                                        <option value="">Pilih Tahun Pelajaran</option>
                                        <?php foreach ($AllTapel as $tapel): ?>
                                            <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= form_error('tapel_finish_persekolah'); ?></div>
                                </div>
                                <!-- <div class="d-flex justify-content-end mt-3"> -->
                                <button type="button" class="btn btn-sm btn-primary" id="FilterSantriFinish_pertingkat"><i class="fas fa-filter"></i> Filter</button>
                                <button type="button" class="btn btn-sm btn-danger ml-2" id="ResetSantriFinish_pertingkat"><i class="fas fa-undo"></i> Reset</button>
                                <!-- </div> -->
                            </div>
                            <div class="row">
                                <div id="load_SantriDiterima_pertingkat">

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