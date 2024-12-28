<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="<?= base_url('assets/theme_1/') ?>vendor/jquery/jquery.min.js"></script> -->
<script src="<?= base_url('assets/theme_1/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/theme_1/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/theme_1/') ?>js/sb-admin-2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->


<script>
    // $(document).ready(function() {
    //     <?php if ($this->session->flashdata('pesan')): ?>
    //         toastr.success('<?= $this->session->flashdata('pesan'); ?>');
    //     <?php endif; ?>
    // });
    $('.select2').select2();
    // Initialize the carousel
    $('.carousel').carousel({
        interval: 3000, // 3 seconds
        pause: 'hover'
    });
    $(document).ready(function() {
        $('#togglePassword1').on('click', function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#togglePassword2').on('click', function() {
            var passwordField = $('#repeat_password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#passwordLogin').on('click', function() {
            var passwordField = $('#password_walsan');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#prog_jen').change(function() {
            var program_tingkat_id = $(this).val();
            if (program_tingkat_id !== '') {
                $.ajax({
                    url: '<?= base_url('registrasi/getTingkat_byProgram'); ?>',
                    type: 'POST',
                    data: {
                        program_tingkat_id: program_tingkat_id
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        // console.log(response);
                        var len = response.length;
                        $("#tingkat_regis").empty();
                        $("#tingkat_regis").append('<option selected value="">Pilih Tingkat / Jenjang Sekolah</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_tingkat_sekolah'];
                            var name = response[i]['nama_tingkat'];
                            // console.log(name);
                            $('#tingkat_regis').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#tingkat_regis").empty();
                $("#tingkat_regis").append('<option selected value="">Pilih Tingkat / Jenjang Sekolah</option>');
            }
        });

        $('#prov_regis').change(function() {
            var id_prov = $(this).val();
            if (id_prov !== '') {
                $.ajax({
                    url: '<?= base_url('registrasi/getKota_byProv'); ?>',
                    type: 'POST',
                    data: {
                        id_prov: id_prov
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kotakab_regis").empty();
                        $("#kotakab_regis").append('<option selected value="">Pilih Kota/Kabupaten</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kota_kab'];
                            var name = response[i]['nama_kota_kab'];
                            $('#kotakab_regis').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kotakab_regis").empty();
                $("#kotakab_regis").append('<option selected value="">Pilih Kota/Kabupaten</option>');
            }
        });

        $('#kotakab_regis').change(function() {
            var id_kota = $(this).val();
            if (id_kota !== '') {
                $.ajax({
                    url: '<?= base_url('registrasi/getKec_byKota'); ?>',
                    type: 'POST',
                    data: {
                        id_kota: id_kota
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kec_regis").empty();
                        $("#kec_regis").append('<option selected value="">Pilih Kecamatan</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kec'];
                            var name = response[i]['nama_kecamatan'];
                            $('#kec_regis').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kec_regis").empty();
                $("#kec_regis").append('<option selected value="">Pilih Kecamatan</option>');
            }
        });

        $('#kec_regis').change(function() {
            var id_kec = $(this).val();
            if (id_kec !== '') {
                $.ajax({
                    url: '<?= base_url('registrasi/getKel_byKec'); ?>',
                    type: 'POST',
                    data: {
                        id_kec: id_kec
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kel_regis").empty();
                        $("#kel_regis").append('<option selected value="">Pilih Kelurahan</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kel'];
                            var name = response[i]['nama_kelurahan'];
                            $('#kel_regis').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kel_regis").empty();
                $("#kel_regis").append('<option selected value="">Pilih Kelurahan</option>');
            }
        });

    });
</script>

</body>

</html>