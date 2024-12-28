<!-- Content of your navbar -->
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow fixed-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="text-white fa fa-bars"></i>
    </button>

    <!-- Sidebar - Brand -->
    <a class="topbar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <!-- <div class="topbar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <img class="topbar-brand-icon" src="<?= base_url('assets/') ?>bayhi.ico" alt="Logo" width="38px">
        <div class="topbar-brand-text text-white mx-3">PSB Bayhi</div>
    </a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($this->session->userdata('role_id') != 5): ?>
                    <span class="mr-2 d-none d-lg-inline text-white small"><?= $panitia['nama_lengkap_pegawai']; ?></span>
                    <img class="img-profile rounded-circle" src="<?= base_url('assets/file_foto/' . $panitia['foto_pegawai']); ?>">
                <?php else: ?>
                    <span class="mr-2 d-none d-lg-inline text-white small"><?= $walsan['nama_lengkap']; ?></span>
                    <img class="img-profile rounded-circle" src="<?= base_url('assets/file_foto/' . $walsan['foto_santri']); ?>">
                <?php endif; ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Setting Akun
                </a>
                <div class="dropdown-divider"></div> -->
                <?php if ($this->session->userdata('role_id') != 5): ?>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                <?php else: ?>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutWalsan">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                <?php endif; ?>

            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= current_url() == base_url('dashboard') ? "active" : '' ?> ">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Menu Admin -->
    <?php if ($this->session->userdata('role_id') == 1): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Administrator
        </div>
        <li class="nav-item <?= current_url() == base_url('pengguna') || current_url() == base_url('master/tapel') || current_url() == base_url('master/program_jenjang') || current_url() == base_url('master/data_tahap') || current_url() == base_url('master/tingkat_sekolah') || current_url() == base_url('master/data_pelengkap') || current_url() == base_url('penilaian') || current_url() == base_url('wawancara') ? 'active' : ''; ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#DataMaster" aria-expanded="true"
                aria-controls="DataMaster">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
            <div id="DataMaster" class="collapse <?= current_url() == base_url('pengguna') || current_url() == base_url('master/tapel') || current_url() == base_url('master/program_jenjang') || current_url() == base_url('master/data_tahap') || current_url() == base_url('master/tingkat_sekolah') || current_url() == base_url('master/data_pelengkap') || current_url() == base_url('penilaian') || current_url() == base_url('wawancara') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= current_url() == base_url('pengguna') ? "active" : '' ?>" href="<?= base_url('pengguna'); ?>">
                        <i class="fas fa-tasks"></i> Data Pengguna
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('master/tapel') ? "active" : '' ?>" href="<?= base_url('master/tapel'); ?>">
                        <i class="fas fa-tasks"></i> Tahun Pelajaran
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('master/program_jenjang') ? "active" : '' ?>" href="<?= base_url('master/program_jenjang'); ?>">
                        <i class="fas fa-tasks"></i> Program Jenjang
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('master/tingkat_sekolah') ? "active" : '' ?>" href="<?= base_url('master/tingkat_sekolah'); ?>">
                        <i class="fas fa-tasks"></i> Tingkat Sekolah
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('master/data_tahap') ? "active" : '' ?>" href="<?= base_url('master/data_tahap'); ?>">
                        <i class="fas fa-tasks"></i> Data Tahap
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('master/data_pelengkap') ? "active" : '' ?>" href="<?= base_url('master/data_pelengkap'); ?>">
                        <i class="fas fa-tasks"></i> Pelengkap Data Santri
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('penilaian') ? "active" : '' ?>" href="<?= base_url('penilaian'); ?>">
                        <i class="fas fa-tasks"></i> Jenis Penilaian
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('wawancara') ? "active" : '' ?>" href="<?= base_url('wawancara'); ?>">
                        <i class="fas fa-tasks"></i> Jenis Wawancara
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item <?= current_url() == base_url('santri/sync_psbhosting') || current_url() == base_url('penilaian/sync_nilaiesantri') || current_url() == base_url('wawancara/sync_wawancara_ekonseling') ? 'active' : ''; ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#DataSyncron" aria-expanded="true"
                aria-controls="DataSyncron">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Sinkronisasi</span>
            </a>
            <div id="DataSyncron" class="collapse <?= current_url() == base_url('santri/sync_psbhosting') || current_url() == base_url('penilaian/sync_nilaiesantri') || current_url() == base_url('wawancara/sync_wawancara_ekonseling') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= current_url() == base_url('santri/sync_psbhosting') ? "active" : '' ?>" href="<?= base_url('santri/sync_psbhosting'); ?>">
                        <i class="fas fa-tasks"></i> Data Santri
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('penilaian/sync_nilaiesantri') ? "active" : '' ?>" href="<?= base_url('penilaian/sync_nilaiesantri'); ?>">
                        <i class="fas fa-tasks"></i> Data Penilaian
                    </a>
                    <a class="collapse-item <?= current_url() == base_url('wawancara/sync_wawancara_ekonseling') ? "active" : '' ?>" href="<?= base_url('wawancara/sync_wawancara_ekonseling'); ?>">
                        <i class="fas fa-tasks"></i> Data Wawancara
                    </a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Menu Admin TU -->
    <?php if ($this->session->userdata('role_id') == 2): ?>
        <div class="sidebar-heading">
            Menu Admin TU
        </div>
        <li class="nav-item <?= current_url() == base_url('santri/DataSantri_bySekolah') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('santri/DataSantri_bySekolah'); ?>">
                <i class="fas fa-user-friends"></i>
                <span>Data Santri</span>
            </a>
        </li>
        <li class="nav-item <?= current_url() == base_url('santri/santri_diterima_pertingkat') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('santri/santri_diterima_pertingkat'); ?>">
                <i class="fas fa-user-check"></i>
                <span>Santri Diterima</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu Admin PSB -->
    <?php if ($this->session->userdata('role_id') == 3): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Admin PSB
        </div>
        <li class="nav-item <?= current_url() == base_url('jadwaltes') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('jadwaltes'); ?>">
                <i class="fas fa-user-clock"></i>
                <span>Input Jadwal</span>
            </a>
        </li>
        <li class="nav-item <?= current_url() == base_url('santri/data_santri') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('santri/data_santri'); ?>">
                <i class="fas fa-user-friends"></i>
                <span>Data Calon Santri</span>
            </a>
        </li>
        <li class="nav-item <?= current_url() == base_url('santri/santri_diterima') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('santri/santri_diterima'); ?>">
                <i class="fas fa-user-check"></i>
                <span>Santri Diterima</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu Keuangan -->
    <?php if ($this->session->userdata('role_id') == 4): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Keuangan
        </div>

        <li class="nav-item <?= current_url() == base_url('pembayaran/jenis_pembayaran') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('pembayaran/jenis_pembayaran'); ?>">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Jenis Pembayaran</span>
            </a>
        </li>

        <li class="nav-item <?= current_url() == base_url('pembayaran/validasi_pembayaran') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('pembayaran/validasi_pembayaran'); ?>">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Validasi Pembayaran</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu Wali Santri / Santri -->
    <?php if ($this->session->userdata('role_id') == 5): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Santri
        </div>
        <?php if ($santri_bayar['status_pembayaran'] != 1): ?>
            <li class="nav-item <?= current_url() == base_url('pembayaran') ? "active" : '' ?> ">
                <a class="nav-link" href="<?= base_url('pembayaran'); ?>">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Konfirmasi Pembayaran</span>
                </a>
            </li>
        <?php else: ?>
            <li class="nav-item <?= current_url() == base_url('santri/biodata_santri') ? "active" : '' ?> ">
                <a class="nav-link" href="<?= base_url('santri/biodata_santri'); ?>">
                    <i class="fas fa-child"></i>
                    <span>Biodata Santri</span>
                </a>
            </li>
            <li class="nav-item <?= current_url() == base_url('santri/jadwal_tes') ? "active" : '' ?> ">
                <a class="nav-link" href="<?= base_url('santri/jadwal_tes'); ?>">
                    <i class="fas fa-user-clock"></i>
                    <span>Jadwal Tes</span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Menu Interviewer -->
    <?php if ($this->session->userdata('role_id') == 6): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Interviewer
        </div>
        <li class="nav-item <?= current_url() == base_url('wawancara/input_wawancara') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('wawancara/input_wawancara'); ?>">
                <i class="fas fa-feather-alt"></i>
                <span>Input Interview</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu Penilai -->
    <?php if ($this->session->userdata('role_id') == 7): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Penilai
        </div>
        <li class="nav-item <?= current_url() == base_url('penilaian/input_penilaian') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('penilaian/input_penilaian'); ?>">
                <i class="fas fa-feather-alt"></i>
                <span>Input Penilaian</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu Kesehatan -->
    <?php if ($this->session->userdata('role_id') == 8): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Kesehatan
        </div>
        <li class="nav-item <?= current_url() == base_url('kesehatan') ? "active" : '' ?> ">
            <a class="nav-link" href="<?= base_url('kesehatan'); ?>">
                <i class="fas fa-feather-alt"></i>
                <span>Input Kesehatan</span>
            </a>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->