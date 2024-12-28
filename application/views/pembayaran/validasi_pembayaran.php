<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('pembayaran/jenis_pembayaran'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Santri</th>
                                            <th>Asal Sekolah</th>
                                            <th>Alamat Santri</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataValidasiBayar as $validasi): ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><?= $validasi['nama_lengkap']; ?></td>
                                                <td><?= $validasi['asal_sekolah']; ?></td>
                                                <td><?= $validasi['alamat']; ?> Kelurahan <?= $validasi['nama_kelurahan']; ?> Kecamatan <?= $validasi['nama_kecamatan']; ?> <?= $validasi['nama_kota_kab']; ?></td>
                                                <td>
                                                    <?php if ($validasi['status_pembayaran'] != 1): ?>
                                                        <a href="" class="btn btn-sm btn-info btn-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data" data-toggle="modal" data-target="#validasiPembayaran<?= $validasi['id_pembayaran']; ?>"><i class="fas fa-info-circle"></i></a>
                                                    <?php else: ?>
                                                        <span class="badge badge-success">Telah divalidasi.</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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

<!-- Modal Hapus -->
<?php foreach ($dataValidasiBayar as $validasi): ?>
    <div class="modal fade" id="validasiPembayaran<?= $validasi['id_pembayaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?= base_url('pembayaran/okevalidasi'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Data Validasi Pembayaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <span>Apakah anda yakin menerima pembayaran <strong><?= $validasi['nama_lengkap']; ?>?</strong></span>
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h6 class="m-0 font-weight-bold text-white">Data Pembayaran Santri</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <table class="mb-2 table table-bordered">
                                                    <tr>
                                                        <td><strong>Nama</strong></td>
                                                        <td>:</td>
                                                        <td><?= $validasi['nama_lengkap']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tanggal Bayar</strong></td>
                                                        <td>:</td>
                                                        <td><?= date('d-m-Y', strtotime($validasi['tanggal_bayar'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Jumlah Pembayaran</strong></td>
                                                        <td>:</td>
                                                        <td><?= formatRupiah($validasi['nominal_dibayar']); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <img src="<?= base_url('assets/file_upload_pembayaran/' . $validasi['file_bukti_pembayaran']); ?>" alt="" width="200" height="400">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_pembayaran_validasi" id="id_pembayaran_validasi" value="<?= $validasi['id_pembayaran']; ?>">
                            </div>
                        </div>
                        <span><code>* Peringatan! Bila anda klik Validasi maka data tidak akan bisa diubah. Terimakasih.</code></span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Validasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<!-- End of Content Wrapper -->