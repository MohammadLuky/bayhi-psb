<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <div class="mt-3 mb-3 ml-3">
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#imageCarousel" data-slide-to="1"></li>
                                <!-- <li data-target="#imageCarousel" data-slide-to="2"></li>
                                <li data-target="#imageCarousel" data-slide-to="3"></li> -->
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="http://36.95.178.42:8080/esantri/dist/img/absen/1.jpg" class="d-block w-100" alt="Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="http://36.95.178.42:8080/esantri/dist/img/absen/2.jpg" class="d-block w-100" alt="Image 2">
                                </div>
                                <!-- <div class="carousel-item">
                                    <img src="http://36.95.178.42:8080/esantri/dist/img/absen/3.jpg" class="d-block w-100" alt="Image 3">
                                </div>
                                <div class="carousel-item">
                                    <img src="http://36.95.178.42:8080/esantri/dist/img/absen/4.jpg" class="d-block w-100" alt="Image 4">
                                </div> -->
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2"> <strong>Form Pendaftaran Penerimaan Santri Baru</strong></h1>
                            <h1 class="h5 text-gray-900 mb-4">Pondok Pesantren Bayt Alhikmah - Pasuruan</h1>
                        </div>
                        <form class="user" action="<?= base_url('registrasi'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('prog_jen') != '') ? 'is-invalid' : ''; ?>" name="prog_jen" id="prog_jen">
                                            <option value="">Pilih Program Jenjang</option>
                                            <?php foreach ($progjen as $pj): ?>
                                                <option value="<?= $pj['id_program_jenjang']; ?>"><?= $pj['nama_program']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('prog_jen'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('tingkat_regis') != '') ? 'is-invalid' : ''; ?>" name="tingkat_regis" id="tingkat_regis">
                                            <option value="">Pilih Tingkat / Jenjang Sekolah</option>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('tingkat_regis'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control select2 <?= (form_error('tapel_regis') != '') ? 'is-invalid' : ''; ?>" name="tapel_regis" id="tapel_regis">
                                    <option value="">Pilih Tahun Pelajaran</option>
                                    <?php foreach ($tapel as $tp): ?>
                                        <option value="<?= $tp['id_tapel']; ?>"><?= $tp['ket_tapel']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= form_error('tapel_regis'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= (form_error('nama_santri_regis') != '') ? 'is-invalid' : ''; ?>" id="nama_santri_regis" name="nama_santri_regis" placeholder="Nama Lengkap Santri" autocomplete="off" value="<?= set_value('nama_santri_regis'); ?>">
                                <div class="invalid-feedback"><?= form_error('nama_santri_regis'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control <?= (form_error('no_telp_regis') != '') ? 'is-invalid' : ''; ?>" id="no_telp_regis" name="no_telp_regis" placeholder="Nomor Telepon Ayah Santri" autocomplete="off" value="<?= set_value('no_telp_regis'); ?>">
                                <div class=" invalid-feedback"><?= form_error('no_telp_regis'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= (form_error('alamat_regis') != '') ? 'is-invalid' : ''; ?>" id="alamat_regis" name="alamat_regis" placeholder="Alamat KTP, Contoh : Jl. Panglima Sudirman Gg.1 RT 1 RW 1" autocomplete="off" value="<?= set_value('alamat_regis'); ?>">
                                <div class=" invalid-feedback"><?= form_error('alamat_regis'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('prov_regis') != '') ? 'is-invalid' : ''; ?>" name="prov_regis" id="prov_regis">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($provinsi as $prov): ?>
                                                <option value="<?= $prov['id_provinsi']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('prov_regis'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('kotakab_regis') != '') ? 'is-invalid' : ''; ?>" name="kotakab_regis" id="kotakab_regis">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('kotakab_regis'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('kec_regis') != '') ? 'is-invalid' : ''; ?>" name="kec_regis" id="kec_regis">
                                            <option value="">Pilih Kecamatan</option>
                                            <!-- <?php foreach ($tapel as $tp): ?>
                                                <option value="<?= $tp['id_tapel']; ?>"><?= $tp['ket_tapel']; ?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('kec_regis'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2 <?= (form_error('kel_regis') != '') ? 'is-invalid' : ''; ?>" name="kel_regis" id="kel_regis">
                                            <option value="">Pilih Kelurahan</option>
                                            <!-- <?php foreach ($tapel as $tp): ?>
                                                <option value="<?= $tp['id_tapel']; ?>"><?= $tp['ket_tapel']; ?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                        <div class="invalid-feedback"><?= form_error('kel_regis'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= (form_error('asal_sekolah_regis') != '') ? 'is-invalid' : ''; ?>" id="asal_sekolah_regis" name="asal_sekolah_regis" placeholder="Asal Sekolah" autocomplete="off" value="<?= set_value('asal_sekolah_regis'); ?>">
                                <div class=" invalid-feedback"><?= form_error('asal_sekolah_regis'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control <?= (form_error('password') != '') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password Akun.">
                                    <i class="fa fa-eye position-absolute" id="togglePassword1" style="cursor: pointer; right: 25px; top: 50%; transform: translateY(-50%);"></i>
                                    <div class="invalid-feedback"><?= form_error('password'); ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control <?= (form_error('repeat_password') != '') ? 'is-invalid' : ''; ?>" id="repeat_password" name="repeat_password" placeholder="Ulangi Password.">
                                    <i class="fa fa-eye position-absolute" id="togglePassword2" style="cursor: pointer; right: 25px; top: 50%; transform: translateY(-50%);"></i>
                                    <div class="invalid-feedback"><?= form_error('repeat_password'); ?></div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <strong>DAFTAR</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>