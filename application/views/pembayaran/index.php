<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('pembayaran'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <?php if ($santri_bayar['status_pembayaran'] != 0): ?>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow">
                            <div class="card-header bg-success">
                                <h6 class="m-0 font-weight-bold text-white">Informasi</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">
                                    <h4 class="alert-heading">Konfirmasi Pembayaran Telah Berhasil!</h4>
                                    <p>Terimakasih telah melakukan pembayaran <strong><?= $pembayaran_psb['nama_jenis_pembayaran'];?></strong>. Mohon bersabar dan ditunggu. Validasi pembayaran masih dalam proses. Selalu cek informasi terupdate PSB di portal ini :).</p>
                                    <!-- <hr>
                                    <p class="mb-0">Terimakasih atas perhatiannya.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">PENTING!</h4>
                            <p>Segera lakukan pembayaran <?= $pembayaran_psb['nama_jenis_pembayaran'];?> dengan rincian sebagai berikut :</p>
                            <!-- jumlah nominal Rp. <?= $pembayaran_psb['nominal_jenis_pembayaran'];?> ke rekening <?= $pembayaran_psb['no_rek_pembayaran'];?>. Selanjutnya anda dapat mengisi Biodata Santri. -->
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped table-light">
                                    <tr>
                                        <td>Jumlah Nominal</td>
                                        <td>: <?= formatRupiah($pembayaran_psb['nominal_jenis_pembayaran']);?></td>
                                    </tr>
                                    <tr>
                                        <td>Atas Nama</td>
                                        <td>: <?= $pembayaran_psb['nama_rekening'];?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Rekening</td>
                                        <td>: <span id="norek_pembayaran"><?= $pembayaran_psb['no_rek_pembayaran'];?></span> | <button class="btn btn-sm btn-warning" onclick="copyToClipboard('norek_pembayaran')">copy</button></td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <p class="mb-0">Terimakasih atas perhatiannya.</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="col-sm-8">
                        <div class="card shadow">
                            <div class="card-header bg-primary">
                                <h6 class="m-0 font-weight-bold text-white">Konfirmasi Pembayaran</h6>
                            </div>
                            <form action="<?= base_url('pembayaran'); ?>" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center mb-4">
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Informasi!</h4>
                                                <p>Ukuran file upload harus kurang dari 500 Kb dan jenis file yang diupload yaitu jpg/png/jpeg/gambar.</p>
                                                <hr>
                                                <p class="mb-0">Terimakasih atas perhatiannya.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Nominal Pembayaran</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control nominal-form <?= (form_error('nominal_bayar') != '') ? 'is-invalid' : ''; ?>" id="nominal_bayar" name="nominal_bayar" placeholder="Tulis nominal pembayaran" autocomplete="off" value="<?= set_value('nominal_bayar'); ?>">
                                                    <div class="invalid-feedback"><?= form_error('nominal_bayar'); ?></div>
                                                </div>
                                                <input type="hidden" name="bayar_nominal" id="bayar_nominal" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <label for="exampleFormControlInput1" class="form-label">Pilih file Pembayaran</label>
                                            <input class="form-control" type="file" id="file_bukti_pembayaran" name="file_bukti_pembayaran" accept=".jpg,.jpeg,.png">
                                            <code class="text-danger">* Bentuk file harus gambar. (.jpg/.png)</code>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-round">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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