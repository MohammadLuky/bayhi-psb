<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri/foto_santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row mb-4">
                <div class="col-sm-3">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">Foto Santri</h6>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <img src="<?= base_url('assets/file_foto/' . $bio_santri['foto_santri']); ?>" alt="" width="200" height="300">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">Upload Foto Santri</h6>
                        </div>
                        <form action="<?= base_url('santri/upload_foto_santri'); ?>" method="post" enctype="multipart/form-data">
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
                                    <div class="col-sm-12">
                                        <label for="exampleFormControlInput1" class="form-label">Pilih Foto Santri</label>
                                        <input class="form-control" type="file" id="file_foto_santri" name="file_foto_santri" accept=".jpg,.jpeg,.png">
                                        <code class="text-danger">* Bentuk file harus gambar. (.jpg/.png)</code>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-round">Simpan</button>
                            </div>
                        </form>
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