<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('master/data_pelengkap'); ?>">Data Pelengkap</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('master/kebutuhan_khusus'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                </div>
                <div class="col-lg-2 justify-content-end">
                    <a href="<?= base_url('master/data_pelengkap'); ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Pelengkap"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                                </div>
                                <div class="col-sm-2 justify-content-md-end">
                                    <a href="<?= base_url('master/get_kelurahan_api'); ?>" class="btn btn-sm btn-light">
                                        <i class="fas fa-cloud-download-alt"></i> Syncron Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="LoadData_psb" width="100%" cellspacing="0">
                                    <thead style="background-color: teal;" class="text-white text-center">
                                        <tr>
                                            <th>ID Kecamatan</th>
                                            <th>ID Kelurahan</th>
                                            <th>Nama Kelurahan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $no = 1;
                                        foreach ($Allkelurahan as $kel): ?>
                                            <tr class="text-center">
                                                <!-- <td><?= $no++; ?></td> -->
                                                <td><?= $kel['kec_id']; ?></td>
                                                <td><?= $kel['id_kel']; ?></td>
                                                <td><?= $kel['nama_kelurahan']; ?></td>
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