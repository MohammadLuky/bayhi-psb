<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-1"><strong>LOGIN</strong></h1>
                                    <h1 class="h5 text-gray-900 mb-5">Aplikasi Penerimaan Santri Baru</h1>
                                </div>
                                <?= $this->session->flashdata('pesan_regis'); ?>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="user" action="<?= base_url('auth'); ?>" method="post">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-user <?= (form_error('no_walsan') != '') ? 'is-invalid' : ''; ?>" id="no_walsan" name="no_walsan" aria-describedby="emailHelp" placeholder="Nomor HP Ayah Santri" value="<?= set_value('no_walsan'); ?>">
                                        <div class="invalid-feedback"><?= form_error('no_walsan'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= (form_error('password_walsan') != '') ? 'is-invalid' : ''; ?>" id="password_walsan" name="password_walsan" placeholder="Password">
                                        <i class="fa fa-eye position-absolute" id="passwordLogin" style="cursor: pointer; right: 86px; top: 48%; transform: translateY(-48%);"></i>
                                        <div class="invalid-feedback"><?= form_error('password_walsan'); ?></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        LOGIN
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('admin'); ?>">Login Admin</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <div class="mt-3 mr-3 mb-3">
                                <img src="<?= base_url('assets/') ?>theme_1/img/login.svg" alt="" width="430">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>