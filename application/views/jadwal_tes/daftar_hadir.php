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
        }
    </style>
</head>

<body>

    <!-- <div class="container mt-4"> -->
    <div class="col-lg-12" style="padding: 10px;">
        <div class="card">
            <div class="card-body">
                <div class="kop-container">
                    <!-- Logo -->
                    <div class="logo">
                        <img src="<?= base_url('assets/') ?>bayhi.ico" alt="Logo">
                    </div>

                    <!-- Kop Surat (Teks di sebelah kanan) -->
                    <div class="kop-text">
                        <h4>Yayasan Bayt Al-hikmah</h4>
                        <p>Jl. Patiunus Gg. Pesantren Krampyangan Bugul Kidul HP. 0821 3916 8000</p>
                        <p>Website: www.baytalhikmah.net e-mail: baytalhikmahofficial@gmail.com Kode Pos 67127</p>
                        <h5>KOTA PASURUAN</h5>
                    </div>
                </div>

                <hr class="print-hr">

                <div class="col-md-6 mb-2">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama Tes</td>
                            <td>: <?= strtoupper($getJdwalTes['nama_tahap']); ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Pelajaran</td>
                            <td>: <?= strtoupper($getJdwalTes['ket_tapel']); ?></td>
                        </tr>
                        <tr>
                            <td>Hari, Tanggal</td>
                            <td>: <?= strtoupper($getJdwalTes['nama_hari']); ?>, <?= tanggal_indonesia_format2($getJdwalTes['tanggal_tes']); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="row table-dafdir">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center align-middle" style="background-color: lightgreen;">
                            <th width="5%">NO</th>
                            <th width="15%">NAMA SANTRI</th>
                            <th width="10%">JENIS KELAMIN</th>
                            <!-- <th width="10%">NAMA ORANG TUA</th> -->
                            <th width="25%">ALAMAT LENGKAP</th>
                            <th width="10%">ASAL SEKOLAH</th>
                            <th width="10%">PROGRAM JENJANG</th>
                            <th width="15%" colspan="2">Tanda Tangan</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $nottd = 1;
                            $zigzag = true;
                            foreach ($AntrianTes_perjadwal as $ap): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $no++; ?></td>
                                    <td class="align-middle"><?= strtoupper($ap['nama_lengkap']); ?></td>
                                    <td class="align-middle"><?= strtoupper($ap['jenis_kelamin']); ?></td>
                                    <!-- <td><?= strtoupper($ap['nama_ayah']); ?> | <?= strtoupper($ap['nama_ibu']); ?></td> -->
                                    <td class="align-middle"><?= strtoupper($ap['alamat']); ?> KEL. <?= $ap['nama_kelurahan']; ?>, KEC. <?= $ap['nama_kecamatan']; ?>, <?= $ap['nama_kota_kab']; ?>, <?= $ap['nama_provinsi']; ?></td>
                                    <td class="align-middle"><?= strtoupper($ap['asal_sekolah']); ?></td>
                                    <td class="align-middle"><?= strtoupper($ap['asal_sekolah']); ?></td>
                                    <?php if ($zigzag): ?>
                                        <td class="align-middle"><?= $nottd++; ?></td>
                                        <td></td> <!-- Kosongkan kolom untuk zigzag -->
                                    <?php else: ?>
                                        <td></td> <!-- Kosongkan kolom untuk zigzag -->
                                        <td class="align-middle"><?= $nottd++; ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php
                                $zigzag = !$zigzag;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>