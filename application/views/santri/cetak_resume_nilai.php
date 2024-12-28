<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/') ?>bayhi.ico" type="image/x-icon" />
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .kop-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            padding: 10px;
            margin-bottom: 5px;
        }

        .logo img {
            width: 100px;
            margin-left: 35px;
        }

        .kop-text {
            text-align: center;
            width: 100%;
            margin-left: -267px;
        }

        .kop-text h4,
        .kop-text p {
            margin: 0;
            line-height: 1.5;
        }

        .table-dafdir {
            padding-left: 15px;
            padding-right: 15px;
        }

        @media print {
            .print-hr {
                border: 1px solid #000;
                /* Gaya garis saat print */
                margin: 20px 0;
                /* Jarak di antara elemen */
            }

            body {
                zoom: 80%;
                /* Skala 80% saat print */
            }

            .logo img {
                width: 100px;
                margin-left: 0px;
            }

            .kop-text {
                text-align: center;
                width: 100%;
                margin-left: -10px;
            }
        }

        .table-no-border td,
        .table-no-border th {
            border: none;
            /* Menghilangkan border */
            padding: 10px 20px;
            /* Mengatur padding untuk jarak antar elemen */
        }

        .table-no-border {
            width: 100%;
            /* Membuat tabel 100% lebar */
        }

        .border-bottom {
            border-bottom: 4px solid #000;
            /* Ganti 2px dengan ketebalan yang diinginkan */
        }
    </style>
</head>

<body onload="window.print()">
    <div class="col-lg-12" style="padding: 10px;">
        <div class="card">
            <div class="card-body">
                <div class="kop-container">
                    <div class="logo">
                        <img src="<?= base_url('assets/') ?>bayhi.ico" alt="Logo">
                    </div>

                    <div class="kop-text">
                        <h4>Yayasan Bayt Al-hikmah</h4>
                        <p>Jl. Patiunus Gg. Pesantren Krampyangan Bugul Kidul HP. 0821 3916 8000</p>
                        <p>Website: www.baytalhikmah.net e-mail: baytalhikmahofficial@gmail.com Kode Pos 67127</p>
                        <h5>KOTA PASURUAN</h5>
                    </div>
                </div>

                <hr class="print-hr">

                <h4 class="text-center mb-4">HASIL RESUME CALON SANTRI BARU</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
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
                                        <thead>
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>