<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <div class="mt-3 ml-3 mb-3">
                                <img src="<?= base_url('assets/') ?>theme_1/img/login_admin.svg" alt="" width="430">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-1"><strong>LOGIN ADMIN</strong></h1>
                                    <h1 class="h5 text-gray-900 mb-5">Aplikasi Penerimaan Santri Baru</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" action="<?= base_url('admin') ?>" method="post">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-user"
                                            id="niy_pegawai_login" name="niy_pegawai_login" aria-describedby="emailHelp"
                                            placeholder="NIY Pegawai" value="<?= set_value('niy_pegawai_login'); ?>">
                                        <?= form_error('niy_pegawai_login', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="password_admin" name="password_admin" placeholder="Password" value="<?= set_value('password_admin'); ?>">
                                        <?= form_error('password_admin', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                    </div>
                                    <button type=" submit" class="btn btn-primary btn-user btn-block">
                                        LOGIN
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>