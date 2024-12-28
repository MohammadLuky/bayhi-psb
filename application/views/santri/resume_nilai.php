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
                        <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-white">Data Calon Santri | <?= $bio_santri['nama_lengkap']; ?></h6>
                            <a href="<?= base_url('santri/cetak_resume_nilai/' . $bio_santri['id_santri']); ?>" class="btn btn-sm btn-success">
                                <i class="fas fa-print"></i> Cetak Resume
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-4">
                                <table class="table table-no-border">
                                    <tr>
                                        <td>Nama Calon Santri</td>
                                        <td>:</td>
                                        <td><?= $bio_santri['nama_lengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td><?= $bio_santri['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pilihan Program</td>
                                        <td>:</td>
                                        <td><?= $bio_santri['nama_tingkat']; ?> - <?= $bio_santri['nama_program']; ?> - <?= $bio_santri['ket_tapel']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= $bio_santri['alamat']; ?>, Kel. <?= $bio_santri['nama_kelurahan']; ?>, Kec. <?= $bio_santri['nama_kecamatan']; ?>, <?= $bio_santri['nama_kota_kab']; ?>, <?= $bio_santri['nama_provinsi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td>:</td>
                                        <td><?= $bio_santri['asal_sekolah']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead style="background-color: teal;" class="text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Uraian Kegiatan</th>
                                            <th>Nilai & Deskripsi</th>
                                            <th>Nama Penilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($AllPenilaian as $penilaian): ?>
                                            <?php if (empty($penilaian)): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td colspan="3"><code>Data Kosong</code></td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $penilaian['nama_penilaian']; ?></td>
                                                    <td>
                                                        <p>Nilai : <?= $penilaian['nilai']; ?></p>
                                                        <p>Deskripsi : <?= $penilaian['deskripsi_penilaian']; ?></p>
                                                        <p>Hasil : <strong><?= $penilaian['hasil']; ?></strong></p>
                                                    </td>
                                                    <td><?= $penilaian['nama_lengkap_pegawai']; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>Tes Kesehatan</td>
                                            <?php if (empty($AllKesehatan['deskripsi_kesehatan'])): ?>
                                                <td>
                                                    <p><code>Data Kosong</code></p>
                                                </td>
                                                <td>
                                                    <p><code>Data Kosong</code></p>
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                    <p>Deskripsi : <?= $AllKesehatan['deskripsi_kesehatan']; ?></p>
                                                    <p>Hasil : <strong><?= $AllKesehatan['hasil']; ?></strong></p>
                                                </td>
                                                <td><?= $AllKesehatan['nama_lengkap_pegawai']; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>Wawancara Santri Dan Orang Tua</td>
                                            <td>
                                                <ol>
                                                    <?php if (empty($WawancaraOrtuSantri)): ?>
                                                        <code>Data Kosong</code>
                                                    <?php else: ?>
                                                        <li>Catatan Khusus : <?= $WawancaraOrtuSantri['catatan_khusus']; ?></li>
                                                        <li>Motivasi : <?= $WawancaraOrtuSantri['motivasi']; ?></li>
                                                        <li>Kemampuan Beradaptasi : <?= $WawancaraOrtuSantri['kemampuan_beradaptasi']; ?></li>
                                                        <li>Karakter : <?= $WawancaraOrtuSantri['karakter']; ?></li>
                                                        <li>Kedekatan : <?= $WawancaraOrtuSantri['kedekatan']; ?></li>
                                                        <li>Hasil Rekomendasi : <strong><?= $WawancaraOrtuSantri['hasil_rekomendasi']; ?></strong></li>
                                                    <?php endif; ?>
                                                </ol>
                                            </td>
                                            <td>
                                                <ol>
                                                    <?php if (empty($WawancaraOrtuSantri)): ?>
                                                        <code>Data Kosong</code>
                                                    <?php else: ?>
                                                        <li>Interviewer Santri :<?= $WawancaraOrtuSantri['nama_pewawancara_santri']; ?></li>
                                                        <li>Interviewer Orang Tua :<?= $WawancaraOrtuSantri['nama_pewawancara_ortu']; ?></li>
                                                    <?php endif; ?>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php if (empty($WawancaraOrtuSantri)): ?>
                                                <td><?= $no++; ?></td>
                                                <td><code>Data Kosong</code></td>
                                                <td>
                                                    <code>Data Kosong</code>
                                                </td>
                                                <td><code>Data Kosong</code></td>
                                            <?php else: ?>
                                                <td><?= $no++; ?></td>
                                                <td><?= $PembiayaanOrtu['jenis_wawancara']; ?></td>
                                                <td>
                                                    <p>Deskripsi : <?= $PembiayaanOrtu['deskripsi_wawancara']; ?></p>
                                                    <p>Hasil : <strong><?= $PembiayaanOrtu['hasil']; ?></strong></p>
                                                </td>
                                                <td><?= $PembiayaanOrtu['nama_lengkap_pegawai']; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>Tes IQ</td>
                                            <td>Nilai</td>
                                            <td>Hasil</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="2"><strong>Hasil Pleno</strong></td>
                                            <td colspan="2">
                                                <?php if ($bio_santri['program_jenjang_id'] == 2): ?>
                                                    <?php if ($bio_santri['status_santri'] == 3): ?>
                                                        <?php if ($Tahap2QS['status_antrian_santri'] == 0): ?>
                                                            Status : <span class="badge badge-warning">Pending ...</span><br>
                                                            <a href="<?= base_url("santri/lanjut_tahap2/" . $bio_santri['id_santri']) ?>" class="badge badge-success"><i class="fas fa-check"></i> Lanjut Tahap 2</a>
                                                            || <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#ValidasiQStoMI<?= $bio_santri['id_santri']; ?>"><i class="fas fa-window-close"></i> Ditolak</a>
                                                        <?php elseif ($Tahap2QS['status_antrian_santri'] == 7): ?>
                                                            Status : <span class="badge badge-warning">Tahap 2 Sedang Berlangsung</span><br>
                                                            <a href="<?= base_url("santri/diterima/" . $bio_santri['id_santri']) ?>" class="badge badge-success"><i class="fas fa-check"></i> Diterima</a>
                                                            || <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#ValidasiQStoMI<?= $bio_santri['id_santri']; ?>"><i class="fas fa-window-close"></i> Ditolak</a>
                                                        <?php endif; ?>
                                                    <?php elseif ($bio_santri['status_santri'] == 2): ?>
                                                        Status : <span class="badge badge-warning">Pengisian Data</span><br>
                                                    <?php elseif ($bio_santri['status_santri'] == 1): ?>
                                                        <span class="badge badge-success">Diterima</span>
                                                    <?php elseif ($bio_santri['status_santri'] == 99): ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php endif; ?>
                                                <?php elseif ($bio_santri['program_jenjang_id'] == 1): ?>
                                                    <?php if ($bio_santri['status_santri'] == 3): ?>
                                                        Status : <span class="badge badge-warning">Pending ...</span><br>
                                                        <a href="<?= base_url("santri/diterima/" . $bio_santri['id_santri']) ?>" class="badge badge-success"><i class="fas fa-check"></i> Diterima</a>
                                                        || <a href="<?= base_url("santri/ditolak/" . $bio_santri['id_santri']) ?>" class="badge badge-danger"><i class="fas fa-window-close"></i> Ditolak</a>
                                                    <?php elseif ($bio_santri['status_santri'] == 2): ?>
                                                        Status : <span class="badge badge-warning">Pengisian Data</span><br>
                                                    <?php elseif ($bio_santri['status_santri'] == 1): ?>
                                                        <span class="badge badge-success">Diterima</span>
                                                    <?php elseif ($bio_santri['status_santri'] == 99): ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
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


<div class="modal fade" id="ValidasiQStoMI<?= $bio_santri['id_santri']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- <form action="<?= base_url('master/hapus_agama'); ?>" method="post"> -->
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Validasi Calon Santri</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <p><span>Apakah ananda <strong><?= $bio_santri['nama_lengkap']; ?></strong> akan diterima dan bersedia menjadi program <strong><?= $bio_santri['nama_program']; ?> - <?= $bio_santri['ket_tapel']; ?></strong> </span></p>
                        <p>Atau Ananda <strong><?= $bio_santri['nama_lengkap']; ?></strong> Ditolak sebagai Santri Bayt Al-hikmah Tahun Pelajaran <strong><?= $bio_santri['ket_tapel']; ?></strong> ?</span>
                        </p>
                        <!-- <input type="hidden" name="id_santri_validasiQStoMI" id="id_santri_validasiQStoMI" value="<?= $bio_santri['id_santri']; ?>"> -->

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url("santri/masuk_MI/" . $bio_santri['id_santri']) ?>" class="btn btn-success">Masuk MI</a>
                <a href="<?= base_url("santri/ditolak/" . $bio_santri['id_santri']) ?>" class="btn btn-danger" type="submit">Ditolak</a>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
<!-- <?php foreach ($AllAgama as $agama): ?>
<?php endforeach; ?> -->