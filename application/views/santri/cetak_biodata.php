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

<body>
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

                <h4 class="text-center">FORMULIR PENDAFTARAN SANTRI BARU</h4>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-no-border">
                            <tr>
                                <td>Program Jenjang</td>
                                <td class="border-bottom">: <strong><?= strtoupper($bio_santri['nama_program']); ?></strong></td>
                                <td>Nomor Registrasi</td>
                                <td class="border-bottom">: <strong><?= strtoupper($bio_santri['no_registrasi']); ?></strong></td>

                            </tr>
                            <tr>
                                <td>Tahun Pelajaran</td>
                                <td class="border-bottom">: <strong><?= strtoupper($bio_santri['ket_tapel']); ?></strong></td>
                                <td>Tanggal Registrasi</td>
                                <td class="border-bottom">: <strong><?= tanggal_indonesia_format2($bio_santri['tgl_inden']); ?></strong></td>
                            </tr>
                        </table>
                        <hr class="print-hr">
                    </div>
                    <div class="col-sm-12" style="align-content: center;">
                        <table class="table table-no-border">
                            <tr>
                                <td style="width: 30%;">NIK Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nik_santri']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Nomor KK Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['kk_santri']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">NISN Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nisn_santri']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Nama Lengkap Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_lengkap']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Nama Panggilan Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_panggilan']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Agama Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_agama']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Jenis Kelamin Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['jenis_kelamin']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Tempat, Tanggal Lahir Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['tempat_lahir']); ?>, <?= strtoupper($bio_santri['tanggal_lahir']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Alamat Lengkap Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['alamat']); ?>, KELURAHAN <?= strtoupper($bio_santri['nama_kelurahan']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;"></td>
                                <td style="width: 5%;"></td>
                                <td style="width: 65%;" class="border-bottom"><strong>KECAMATAN <?= strtoupper($bio_santri['nama_kecamatan']); ?> <?= strtoupper($bio_santri['nama_kota_kab']); ?> <?= strtoupper($bio_santri['nama_provinsi']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Kode Pos</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['kode_pos']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Nomor HP Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['no_hp']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">E-mail Santri</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['email']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Asal Sekolah</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['asal_sekolah']); ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Berat Badan</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['berat_badan']); ?> kg</strong></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Tinggi Badan</td>
                                <td style="width: 5%;">:</td>
                                <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['tinggi_badan']); ?> meter</strong></td>
                            </tr>
                        </table>
                        <hr class="print-hr">
                        <table class="table table-no-border">
                            <div id="bio-ayah">
                                <h5><strong>Data Ayah</strong></h5>
                                <tr>
                                    <td style="width: 30%;">Nama Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">NIK Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nik_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Tahun Lahir Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['tahun_lahir_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Pendidikan Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pendidikan_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Pekerjaan Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pekerjaan_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Penghasilan Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['penghasilan_ayah']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Penghasilan Ayah Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nohp_ayah']); ?></strong></td>
                                </tr>
                            </div>
                        </table>
                        <hr class="print-hr">
                        <table class="table table-no-border">
                            <div id="bio-ibu">
                                <h5><strong>Data Ibu</strong></h5>
                                <tr>
                                    <td style="width: 30%;">Nama Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">NIK Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nik_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Tahun Lahir Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['tahun_lahir_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Pendidikan Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pendidikan_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Pekerjaan Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pekerjaan_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Penghasilan Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['penghasilan_ibu']); ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Penghasilan Ibu Santri</td>
                                    <td style="width: 5%;">:</td>
                                    <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nohp_ibu']); ?></strong></td>
                                </tr>
                            </div>
                        </table>
                        <table class="table table-no-border">
                            <?php if ($bio_santri['nama_wali']): ?>
                                <hr class="print-hr">
                                <h5><strong>Data Wali</strong></h5>
                                <div id="bio-wali">
                                    <tr>
                                        <td style="width: 30%;">Nama Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nama_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">NIK Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nik_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tahun Lahir Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['tahun_lahir_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Pendidikan Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pendidikan_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Pekerjaan Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['pekerjaan_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Penghasilan Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['penghasilan_wali']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Penghasilan Wali Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 65%;" class="border-bottom"><strong><?= strtoupper($bio_santri['nohp_wali']); ?></strong></td>
                                    </tr>
                                </div>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>