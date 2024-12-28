<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                                </div>
                                <div class="col-md-2 justify-content-end">
                                    <a href="<?= base_url('santri/biodata_santri'); ?>" class="btn btn-round btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Biodata Santri"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('santri/data_orangtua'); ?>" method="post">
                                <div class="row mb-2">
                                    <label for="" class="h4">Data Ayah</label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Ayah <code>*</code></label>
                                            <input autocomplete="off" placeholder="Nama Ayah" type="text" class="form-control <?= (form_error('nama_ayah') != '') ? 'is-invalid' : ''; ?>" id="nama_ayah" name="nama_ayah" value="<?= $bio_santri['nama_ayah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nama_ayah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NIK Ayah <code>*</code></label>
                                            <input autocomplete="off" placeholder="NIK Ayah" type="number" class="form-control <?= (form_error('nik_ayah') != '') ? 'is-invalid' : ''; ?>" id="nik_ayah" name="nik_ayah" value="<?= $bio_santri['nik_ayah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nik_ayah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tahun Lahir Ayah <code>*</code></label>
                                            <input autocomplete="off" placeholder="Tahun Lahir Ayah" type="number" class="form-control <?= (form_error('tahun_lahir_ayah') != '') ? 'is-invalid' : ''; ?>" id="tahun_lahir_ayah" name="tahun_lahir_ayah" value="<?= $bio_santri['tahun_lahir_ayah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tahun_lahir_ayah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nomor HP Ayah <code>*</code></label>
                                            <input autocomplete="off" placeholder="Nomor HP Ayah" type="number" class="form-control <?= (form_error('nohp_ayah') != '') ? 'is-invalid' : ''; ?>" id="nohp_ayah" name="nohp_ayah" value="<?= $bio_santri['nohp_ayah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nohp_ayah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pendidikan Ayah <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('pendidikan_ayah_id') != '') ? 'is-invalid' : ''; ?>" name="pendidikan_ayah_id" id="pendidikan_ayah_id">
                                                <option value="">Pilih Pendidikan Ayah</option>
                                                <?php foreach ($pendidikan_ortu as $po): ?>
                                                    <?php if ($bio_santri['pendidikan_ayah_id'] == $po['id_pendidikan_ortu']): ?>
                                                        <option value="<?= $po['id_pendidikan_ortu']; ?>" selected><?= $po['nama_pendidikan_ortu']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_pendidikan_ortu']; ?>"><?= $po['nama_pendidikan_ortu']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('pendidikan_ayah_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pekerjaan Ayah <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('pekerjaan_ayah_id') != '') ? 'is-invalid' : ''; ?>" name="pekerjaan_ayah_id" id="pekerjaan_ayah_id">
                                                <option value="">Pilih Pekerjaan Ayah</option>
                                                <?php foreach ($pekerjaan_ortu as $po): ?>
                                                    <?php if ($bio_santri['pekerjaan_ayah_id'] == $po['id_pekerjaan_ortu']): ?>
                                                        <option value="<?= $po['id_pekerjaan_ortu']; ?>" selected><?= $po['jenis_pekerjaan']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_pekerjaan_ortu']; ?>"><?= $po['jenis_pekerjaan']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('pekerjaan_ayah_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Penghasilan Ayah <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('penghasilan_ayah_id') != '') ? 'is-invalid' : ''; ?>" name="penghasilan_ayah_id" id="penghasilan_ayah_id">
                                                <option value="">Pilih Penghasilan Ayah</option>
                                                <?php foreach ($penghasilan_ortu as $po): ?>
                                                    <?php if ($bio_santri['penghasilan_ayah_id'] == $po['id_penghasilan_ortu']): ?>
                                                        <option value="<?= $po['id_penghasilan_ortu']; ?>" selected><?= $po['range_penghasilan']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_penghasilan_ortu']; ?>"><?= $po['range_penghasilan']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('penghasilan_ayah_id'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="h4">Data Ibu</label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Ibu <code>*</code></label>
                                            <input autocomplete="off" placeholder="Nama Ibu" type="text" class="form-control <?= (form_error('nama_ibu') != '') ? 'is-invalid' : ''; ?>" id="nama_ibu" name="nama_ibu" value="<?= $bio_santri['nama_ibu']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nama_ibu'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NIK Ibu <code>*</code></label>
                                            <input autocomplete="off" placeholder="NIK Ibu" type="number" class="form-control <?= (form_error('nik_ibu') != '') ? 'is-invalid' : ''; ?>" id="nik_ibu" name="nik_ibu" value="<?= $bio_santri['nik_ibu']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nik_ibu'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tahun Lahir Ibu <code>*</code></label>
                                            <input autocomplete="off" placeholder="Tahun Lahir Ibu" type="number" class="form-control <?= (form_error('tahun_lahir_ibu') != '') ? 'is-invalid' : ''; ?>" id="tahun_lahir_ibu" name="tahun_lahir_ibu" value="<?= $bio_santri['tahun_lahir_ibu']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tahun_lahir_ibu'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nomor HP Ibu <code>*</code></label>
                                            <input autocomplete="off" placeholder="Nomor HP Ibu" type="number" class="form-control <?= (form_error('nohp_ibu') != '') ? 'is-invalid' : ''; ?>" id="nohp_ibu" name="nohp_ibu" value="<?= $bio_santri['nohp_ibu']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nohp_ibu'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pendidikan Ibu <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('pendidikan_ibu_id') != '') ? 'is-invalid' : ''; ?>" name="pendidikan_ibu_id" id="pendidikan_ibu_id">
                                                <option value="">Pilih Pendidikan Ibu</option>
                                                <?php foreach ($pendidikan_ortu as $po): ?>
                                                    <?php if ($bio_santri['pendidikan_ibu_id'] == $po['id_pendidikan_ortu']): ?>
                                                        <option value="<?= $po['id_pendidikan_ortu']; ?>" selected><?= $po['nama_pendidikan_ortu']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_pendidikan_ortu']; ?>"><?= $po['nama_pendidikan_ortu']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('pendidikan_ibu_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pekerjaan Ibu <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('pekerjaan_ibu_id') != '') ? 'is-invalid' : ''; ?>" name="pekerjaan_ibu_id" id="pekerjaan_ibu_id">
                                                <option value="">Pilih Pekerjaan Ibu</option>
                                                <?php foreach ($pekerjaan_ortu as $po): ?>
                                                    <?php if ($bio_santri['pekerjaan_ibu_id'] == $po['id_pekerjaan_ortu']): ?>
                                                        <option value="<?= $po['id_pekerjaan_ortu']; ?>" selected><?= $po['jenis_pekerjaan']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_pekerjaan_ortu']; ?>"><?= $po['jenis_pekerjaan']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('pekerjaan_ibu_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Penghasilan Ibu <code>*</code></label>
                                            <select class="form-control select2 <?= (form_error('penghasilan_ibu_id') != '') ? 'is-invalid' : ''; ?>" name="penghasilan_ibu_id" id="penghasilan_ibu_id">
                                                <option value="">Pilih Penghasilan Ibu</option>
                                                <?php foreach ($penghasilan_ortu as $po): ?>
                                                    <?php if ($bio_santri['penghasilan_ibu_id'] == $po['id_penghasilan_ortu']): ?>
                                                        <option value="<?= $po['id_penghasilan_ortu']; ?>" selected><?= $po['range_penghasilan']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $po['id_penghasilan_ortu']; ?>"><?= $po['range_penghasilan']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('penghasilan_ibu_id'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck" value="1">
                                        <label class="custom-control-label" for="customCheck">Apakah santri mempunyai Wali ?</label>
                                    </div>
                                    <code>*ceklist bila santri mempunyai wali.</code>
                                </div>
                                <div id="DataWali" style="display: none;">
                                    <div class="row mb-2">
                                        <label for="" class="h4">Data Wali</label>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Nama Wali</label>
                                                <input autocomplete="off" placeholder="Nama Wali" type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= $bio_santri['nama_wali']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">NIK Wali</label>
                                                <input autocomplete="off" placeholder="NIK Wali" type="number" class="form-control" id="nik_wali" name="nik_wali" value="<?= $bio_santri['nik_wali']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Tahun Lahir Wali</label>
                                                <input autocomplete="off" placeholder="Tahun Lahir Wali" type="number" class="form-control ''; ?>" id="tahun_lahir_wali" name="tahun_lahir_wali" value="<?= $bio_santri['tahun_lahir_wali']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nomor HP Wali</label>
                                                <input autocomplete="off" placeholder="Nomor HP Wali" type="number" class="form-control" id="nohp_wali" name="nohp_wali" value="<?= $bio_santri['nohp_wali']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Pendidikan Wali</label>
                                                <select class="form-control select2" name="pendidikan_wali_id" id="pendidikan_wali_id">
                                                    <option value="">Pilih Pendidikan Wali</option>
                                                    <?php foreach ($pendidikan_ortu as $po): ?>
                                                        <?php if ($bio_santri['pendidikan_wali_id'] == $po['id_pendidikan_ortu']): ?>
                                                            <option value="<?= $po['id_pendidikan_ortu']; ?>" selected><?= $po['nama_pendidikan_ortu']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $po['id_pendidikan_ortu']; ?>"><?= $po['nama_pendidikan_ortu']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Pekerjaan Wali</label>
                                                <select class="form-control select2" name="pekerjaan_wali_id" id="pekerjaan_wali_id">
                                                    <option value="">Pilih Pekerjaan Wali</option>
                                                    <?php foreach ($pekerjaan_ortu as $po): ?>
                                                        <?php if ($bio_santri['pekerjaan_wali_id'] == $po['id_pekerjaan_ortu']): ?>
                                                            <option value="<?= $po['id_pekerjaan_ortu']; ?>" selected><?= $po['jenis_pekerjaan']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $po['id_pekerjaan_ortu']; ?>"><?= $po['jenis_pekerjaan']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Penghasilan Wali</label>
                                                <select class="form-control select2>" name="penghasilan_wali_id" id="penghasilan_wali_id">
                                                    <option value="">Pilih Penghasilan Wali</option>
                                                    <?php foreach ($penghasilan_ortu as $po): ?>
                                                        <?php if ($bio_santri['penghasilan_wali_id'] == $po['id_penghasilan_ortu']): ?>
                                                            <option value="<?= $po['id_penghasilan_ortu']; ?>" selected><?= $po['range_penghasilan']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $po['id_penghasilan_ortu']; ?>"><?= $po['range_penghasilan']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($bio_santri['kirim_data_santri'] != 1): ?>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                <?php endif; ?>
                            </form>
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
<!-- End of Content Wrapper -->r