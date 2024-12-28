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
                                    <a href="<?= base_url('santri/data_orangtua'); ?>" class="btn btn-round btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Orang Tua"><i class="fas fa-users"></i></a>
                                    <a href="<?= base_url('santri/foto_santri'); ?>" class="btn btn-round btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Foto Santri"><i class="fas fa-file-image"></i></a>
                                    <?php if ($bio_santri['kirim_data_santri'] == 0): ?>
                                        <a href="#" class="btn btn-round btn-sm btn-success" data-toggle="modal" data-target="#kirimData"><i class="fas fa-paper-plane"></i>Kirim Data</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('santri/biodata_santri'); ?>" method="post">
                                <div class="row mb-2">
                                    <?php if ($bio_santri['tapel_inden_id'] != 0 && $bio_santri['program_jenjang_id'] != 0 && $bio_santri['daftar_tingkat_id'] != 0): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Program Jenjang Dipilih</label>
                                                <a href="<?= base_url('santri/edit_program_jenjang'); ?>" class="badge badge-warning"><i class="fas fa-edit"></i>Edit</a>
                                                <input type="text" class="form-control" value="<?= $bio_santri['nama_tingkat']; ?> - <?= $bio_santri['nama_program']; ?> - <?= $bio_santri['ket_tapel']; ?>" readonly>
                                                <code>* Klik edit bila Program Jenjang santri berubah atau salah.</code>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Tahun Pelajaran Inden</label> <code>*</code>
                                                <select class="form-control select2 <?= (form_error('tapel_inden_id') != '') ? 'is-invalid' : ''; ?>" name="tapel_inden_id" id="tapel_inden_id">
                                                    <option value="">Pilih Tahun Pelajaran</option>
                                                    <?php foreach ($tahun_pelajaran as $tapel): ?>
                                                        <?php if ($tapel['status_tapel'] == 1): ?>
                                                            <?php if ($bio_santri['tapel_inden_id'] == $tapel['id_tapel']): ?>
                                                                <option value="<?= $tapel['id_tapel']; ?>" selected><?= $tapel['ket_tapel']; ?></option>
                                                            <?php else: ?>
                                                                <option value="<?= $tapel['id_tapel']; ?>"><?= $tapel['ket_tapel']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('tapel_inden_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Program Jenjang</label> <code>*</code>
                                                <select class="form-control select2 <?= (form_error('program_jenjang_id') != '') ? 'is-invalid' : ''; ?>" name="program_jenjang_id" id="program_jenjang_id">
                                                    <option value="">Pilih Program Jenjang</option>
                                                    <?php foreach ($program_jenjang as $pj): ?>
                                                        <?php if ($bio_santri['program_jenjang_id'] == $pj['id_program_jenjang']): ?>
                                                            <option value="<?= $pj['id_program_jenjang']; ?>" selected><?= $pj['nama_program']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $pj['id_program_jenjang']; ?>"><?= $pj['nama_program']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('program_jenjang_id'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Jenjang Sekolah</label> <code>*</code>
                                                <select class="form-control select2 <?= (form_error('daftar_tingkat_id') != '') ? 'is-invalid' : ''; ?>" name="daftar_tingkat_id" id="daftar_tingkat_id">
                                                    <option value="">Pilih Jenjang Sekolah</option>
                                                    <?php foreach ($jenjang_sekolah as $js): ?>
                                                        <?php if ($bio_santri['daftar_tingkat_id'] == $js['id_tingkat_sekolah']): ?>
                                                            <option value="<?= $js['id_tingkat_sekolah']; ?>" selected><?= $js['nama_tingkat']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $js['id_tingkat_sekolah']; ?>"><?= $js['nama_tingkat']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('daftar_tingkat_id'); ?></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NIK Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="NIK Santri" type="number" class="form-control <?= (form_error('nik_santri') != '') ? 'is-invalid' : ''; ?>" id="nik_santri" name="nik_santri" value="<?= $bio_santri['nik_santri']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nik_santri'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">No KK Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="No KK Santri" type="number" class="form-control <?= (form_error('kk_santri') != '') ? 'is-invalid' : ''; ?>" id="kk_santri" name="kk_santri" value="<?= $bio_santri['kk_santri']; ?>">
                                            <div class="invalid-feedback"><?= form_error('kk_santri'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NISN Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="NISN Santri" type="number" class="form-control <?= (form_error('nisn_santri') != '') ? 'is-invalid' : ''; ?>" id="nisn_santri" name="nisn_santri" value="<?= $bio_santri['nisn_santri']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nisn_santri'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="Nama Lengkap Santri" type="text" class="form-control <?= (form_error('nama_lengkap') != '') ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= $bio_santri['nama_lengkap']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nama_lengkap'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Panggilan Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="Nama Panggilan Santri" type="text" class="form-control <?= (form_error('nama_panggilan') != '') ? 'is-invalid' : ''; ?>" id="nama_panggilan" name="nama_panggilan" value="<?= $bio_santri['nama_panggilan']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nama_panggilan'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Agama Santri</label> <code>*</code>
                                            <select class="form-control select2 <?= (form_error('agama_id') != '') ? 'is-invalid' : ''; ?>" name="agama_id" id="agama_id">
                                                <option value="">Pilih Agama</option>
                                                <?php foreach ($agama as $a): ?>
                                                    <?php if ($bio_santri['agama_id'] == $a['id_agama']): ?>
                                                        <option value="<?= $a['id_agama']; ?>" selected><?= $a['nama_agama']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $a['id_agama']; ?>"><?= $a['nama_agama']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('agama_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Jenis Kelamin Santri</label> <code>*</code>
                                            <select class="form-control select2 <?= (form_error('jenis_kelamin_id') != '') ? 'is-invalid' : ''; ?>" name="jenis_kelamin_id" id="jenis_kelamin_id">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <?php foreach ($jenis_kelamin as $jk): ?>
                                                    <?php if ($bio_santri['jenis_kelamin_id'] == $jk['id_jenis_kelamin']): ?>
                                                        <option value="<?= $jk['id_jenis_kelamin']; ?>" selected><?= $jk['jenis_kelamin']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $jk['id_jenis_kelamin']; ?>"><?= $jk['jenis_kelamin']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('jenis_kelamin_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tempat Lahir Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="text" class="form-control <?= (form_error('tempat_lahir') != '') ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= $bio_santri['tempat_lahir']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tempat_lahir'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Lahir Santri</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="date" class="form-control <?= (form_error('tanggal_lahir') != '') ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $bio_santri['tanggal_lahir']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tanggal_lahir'); ?></div>
                                        </div>
                                    </div>

                                    <?php if ($bio_santri['alamat']): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Alamat Santri</label>
                                                <a href="<?= base_url('santri/edit_alamat'); ?>" class="badge badge-warning"><i class="fas fa-edit"></i>Edit</a>
                                                <textarea class="form-control" readonly><?= $bio_santri['alamat']; ?> Kelurahan <?= $bio_santri['nama_kelurahan']; ?> Kecamatan <?= $bio_santri['nama_kecamatan']; ?> <?= $bio_santri['nama_kota_kab']; ?> <?= $bio_santri['nama_provinsi']; ?></textarea>
                                                <code>* Klik edit bila Alamat santri berubah atau salah.</code>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Alamat</label> <code>*</code>
                                                <textarea name="alamat" id="alamat" class="form-control <?= (form_error('alamat') != '') ? 'is-invalid' : ''; ?>"></textarea>
                                                <div class="invalid-feedback"><?= form_error('alamat'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select2 <?= (form_error('prov_santri') != '') ? 'is-invalid' : ''; ?>" name="prov_santri" id="prov_santri">
                                                    <option value="">Pilih Provinsi</option> <code>*</code>
                                                    <?php foreach ($provinsi as $prov): ?>
                                                        <option value="<?= $prov['id_provinsi']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('prov_santri'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select2 <?= (form_error('kotakab_santri') != '') ? 'is-invalid' : ''; ?>" name="kotakab_santri" id="kotakab_santri">
                                                    <option value="">Pilih Kota/Kabupaten</option> <code>*</code>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('kotakab_santri'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select2 <?= (form_error('kec_santri') != '') ? 'is-invalid' : ''; ?>" name="kec_santri" id="kec_santri">
                                                    <option value="">Pilih Kecamatan</option> <code>*</code>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('kec_santri'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select2 <?= (form_error('kel_santri') != '') ? 'is-invalid' : ''; ?>" name="kel_santri" id="kel_santri">
                                                    <option value="">Pilih Kelurahan</option> <code>*</code>
                                                </select>
                                                <div class="invalid-feedback"><?= form_error('kel_santri'); ?></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Kode Pos</label>
                                            <input autocomplete="off" placeholder="" type="number" class="form-control <?= (form_error('kode_pos') != '') ? 'is-invalid' : ''; ?>" id="kode_pos" name="kode_pos" value="<?= $bio_santri['kode_pos']; ?>">
                                            <div class="invalid-feedback"><?= form_error('kode_pos'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nomor HP</label>
                                            <input autocomplete="off" placeholder="" type="number" class="form-control <?= (form_error('no_hp') != '') ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" value="<?= $bio_santri['no_hp']; ?>">
                                            <div class="invalid-feedback"><?= form_error('no_hp'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="email" class="form-control <?= (form_error('email') != '') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $bio_santri['email']; ?>">
                                            <div class="invalid-feedback"><?= form_error('email'); ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <label for="" class="text-sm">Data Pelengkap</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">SKHUN</label>
                                            <input autocomplete="off" placeholder="" type="text" class="form-control <?= (form_error('skhun') != '') ? 'is-invalid' : ''; ?>" id="skhun" name="skhun" value="<?= $bio_santri['skhun']; ?>">
                                            <div class="invalid-feedback"><?= form_error('skhun'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nomor Ijazah</label>
                                            <input autocomplete="off" placeholder="" type="text" class="form-control <?= (form_error('nomor_ijazah') != '') ? 'is-invalid' : ''; ?>" id="nomor_ijazah" name="nomor_ijazah" value="<?= $bio_santri['nomor_ijazah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('nomor_ijazah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Ijazah</label>
                                            <input autocomplete="off" placeholder="" type="date" class="form-control <?= (form_error('tanggal_ijazah') != '') ? 'is-invalid' : ''; ?>" id="tanggal_ijazah" name="tanggal_ijazah" value="<?= $bio_santri['tanggal_ijazah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tanggal_ijazah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Asal Sekolah</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="text" class="form-control <?= (form_error('asal_sekolah') != '') ? 'is-invalid' : ''; ?>" id="asal_sekolah" name="asal_sekolah" value="<?= $bio_santri['asal_sekolah']; ?>">
                                            <div class="invalid-feedback"><?= form_error('asal_sekolah'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Alat Transportasi</label>
                                            <select class="form-control select2 <?= (form_error('alat_transportasi_id') != '') ? 'is-invalid' : ''; ?>" name="alat_transportasi_id" id="alat_transportasi_id">
                                                <option value="">Pilih Alat Transportasi</option>
                                                <?php foreach ($transportasi as $transport): ?>
                                                    <?php if ($bio_santri['alat_transportasi_id'] == $transport['id_transportasi']): ?>
                                                        <option value="<?= $transport['id_transportasi']; ?>" selected><?= $transport['nama_transportasi']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $transport['id_transportasi']; ?>"><?= $transport['nama_transportasi']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('alat_transportasi_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Kebutuhan Khusus</label>
                                            <select class="form-control select2 <?= (form_error('kebutuhan_khusus_id') != '') ? 'is-invalid' : ''; ?>" name="kebutuhan_khusus_id" id="kebutuhan_khusus_id">
                                                <option value="">Pilih Kebutuhan Khusus</option>
                                                <?php foreach ($kebutuhan_khusus as $kebsus): ?>
                                                    <?php if ($bio_santri['kebutuhan_khusus_id'] == $kebsus['id_kebutuhan_khusus']): ?>
                                                        <option value="<?= $kebsus['id_kebutuhan_khusus']; ?>" selected><?= $kebsus['ket_kebutuhan_khusus']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $kebsus['id_kebutuhan_khusus']; ?>"><?= $kebsus['ket_kebutuhan_khusus']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= form_error('kebutuhan_khusus_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Berat Badan (Kg)</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="number" class="form-control <?= (form_error('berat_badan') != '') ? 'is-invalid' : ''; ?>" id="berat_badan" name="berat_badan" value="<?= $bio_santri['berat_badan']; ?>">
                                            <div class="invalid-feedback"><?= form_error('berat_badan'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tinggi Badan (meter)</label> <code>*</code>
                                            <input autocomplete="off" placeholder="" type="number" class="form-control <?= (form_error('tinggi_badan') != '') ? 'is-invalid' : ''; ?>" id="tinggi_badan" name="tinggi_badan" value="<?= $bio_santri['tinggi_badan']; ?>">
                                            <div class="invalid-feedback"><?= form_error('tinggi_badan'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($bio_santri['kirim_data_santri'] != 1): ?>
                                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                                <?php endif; ?>
                            </form>
                            <code class="mt-3">Note : Tanda (*) Harus Diisi.</code>
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
<!-- End of Content Wrapper -->

<div class="modal fade" id="kirimData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('santri/kirim_data'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Kirim Data Santri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <span>Apakah anda yakin akan mengirim data santri <strong><?= $bio_santri['nama_lengkap']; ?></strong></span>?
                        </div>
                    </div>
                    <code>* Bila anda klik kirim, maka data tidak bisa diubah.</code>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>