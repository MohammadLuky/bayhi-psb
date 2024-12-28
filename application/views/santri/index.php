<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('santri'); ?>"><?= $title; ?></a></li>
            </ol>
        </nav>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h6 class="m-0 font-weight-bold text-white"><?= $title; ?></h6>
                    </div>
                    <div class="card-body">
                        <!-- <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">NISN Santri</label>
                                    <input type="text" class="form-control" id="" name="" value="" >
                                </div>
                            </div>
                        </div> -->
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
<!-- End of Content Wrapper -->r