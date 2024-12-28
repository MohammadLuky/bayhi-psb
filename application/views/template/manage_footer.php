    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutWalsan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Keluar Aplikasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan keluar dari aplikasi PSB Bayt Alhikmah ?</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Keluar Aplikasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan keluar dari aplikasi PSB Bayt Alhikmah ?</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('admin/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="<?= base_url('assets/theme_1/') ?>vendor/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/theme_1/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/theme_1/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/theme_1/') ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('assets/theme_1/') ?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/theme_1/') ?>js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('assets/theme_1/') ?>js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Page level plugins -->
    <script src="<?= base_url('assets/theme_1/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/theme_1/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?= base_url('assets/theme_1/') ?>vendor/jquery-tabledit-master/jquery.tabledit.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#LoadData_psb').DataTable();
            $('#LoadData_psb1').DataTable();
        });
        $('.select2').select2();
        $('.select2-multiple').select2();

        $('.reload-page').on('click', function(e) {
            location.reload(false); // Reload halaman tanpa tab berputar
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $(document).ready(function() {
            <?php if ($this->session->flashdata('pesan')): ?>
                toastr.success('<?= $this->session->flashdata('pesan'); ?>');
            <?php endif; ?>
        });

        function formatRupiah(value) {
            var numberString = value.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                remainder = split[0].length % 3,
                rupiah = split[0].substr(0, remainder),
                thousands = split[0].substr(remainder).match(/\d{3}/gi);

            if (thousands) {
                separator = remainder ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        $(document).ready(function() {
            function resizeSidebar() {
                var windowHeight = $(window).height();
                $('#accordionSidebar').css('height', windowHeight + 'px');
            }
            resizeSidebar();

            $(window).resize(function() {
                resizeSidebar();
            });
        });

        function copyToClipboard(elementId) {
            var textToCopy = document.getElementById(elementId).innerText;

            navigator.clipboard.writeText(textToCopy).then(function() {
                toastr.success('Nomor rekening berhasil disalin ke clipboard!');
            }).catch(function(error) {
                toastr.error('Gagal menyalin nomor rekening.');
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#nominal_jenis_pembayaran').on('keyup', function() {
                var input = $(this).val();

                var formattedInput = formatRupiah(input);
                $(this).val(formattedInput);
            });
            $('form').on('submit', function() {
                var originalValue = $('#nominal_jenis_pembayaran').val().replace(/\./g, '');
                $('#nominal_jenis_pembayaran').val(originalValue);
            });

            var dbValue = $('#nominal_jenis_pembayaran_edit').val();
            if (dbValue) {
                $('#nominal_jenis_pembayaran_edit').val(formatRupiah(dbValue));
            }
            $('#nominal_jenis_pembayaran_edit').on('keyup', function() {
                var input = $(this).val();

                var formattedInput = formatRupiah(input);
                $(this).val(formattedInput);
            });
            $('form').on('submit', function() {
                var originalValue = $('#nominal_jenis_pembayaran_edit').val().replace(/\./g, '');
                $('#nominal_jenis_pembayaran_edit').val(originalValue);
            });

            $('#nominal_bayar').on('keyup', function() {
                var input = $(this).val();

                var formattedInput = formatRupiah(input);
                $(this).val(formattedInput);
            });
            $('#nominal_bayar').on('keyup', function() {
                var input = $(this).val();
                var originalValue = $('#nominal_bayar').val().replace(/\./g, '');
                $('#bayar_nominal').val(originalValue);
            });

            $('#nominal_bayar_panitia').on('keyup', function() {
                var input = $(this).val();

                var formattedInput = formatRupiah(input);
                $(this).val(formattedInput);
            });
            $('#nominal_bayar_panitia').on('keyup', function() {
                var input = $(this).val();
                var originalValue = $('#nominal_bayar_panitia').val().replace(/\./g, '');
                $('#bayar_nominal_panitia').val(originalValue);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-tapel').click(function() {
                $('#editTapel').modal('show');
                var id_tapel = $(this).data('id');
                var ket_tapel = $(this).data('tapel');

                $('#id_tapel').val(id_tapel);
                $('#ket_tapel_edit').val(ket_tapel);
            });
        });

        $('#program_pembayaran_id').change(function() {
            var program_tingkat_id = $(this).val();
            if (program_tingkat_id !== '') {
                $.ajax({
                    url: '<?= base_url('pembayaran/getTingkat_byProgram'); ?>',
                    type: 'POST',
                    data: {
                        program_tingkat_id: program_tingkat_id
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        // console.log(response);
                        var len = response.length;
                        $("#jenjang_pembayaran_id").empty();
                        $("#jenjang_pembayaran_id").append('<option selected value="">Pilih Tingkat / Jenjang Sekolah</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_tingkat_sekolah'];
                            var name = response[i]['nama_tingkat'];
                            // console.log(name);
                            $('#jenjang_pembayaran_id').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#jenjang_pembayaran_id").empty();
                $("#jenjang_pembayaran_id").append('<option selected value="">Pilih Tingkat / Jenjang Sekolah</option>');
            }
        });

        $('#prov_santri').change(function() {
            var id_prov = $(this).val();
            if (id_prov !== '') {
                $.ajax({
                    url: '<?= base_url('santri/getKota_byProv'); ?>',
                    type: 'POST',
                    data: {
                        id_prov: id_prov
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kotakab_santri").empty();
                        $("#kotakab_santri").append('<option selected value="">Pilih Kota/Kabupaten</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kota_kab'];
                            var name = response[i]['nama_kota_kab'];
                            $('#kotakab_santri').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kotakab_santri").empty();
                $("#kotakab_santri").append('<option selected value="">Pilih Kota/Kabupaten</option>');
            }
        });

        $('#kotakab_santri').change(function() {
            var id_kota = $(this).val();
            if (id_kota !== '') {
                $.ajax({
                    url: '<?= base_url('santri/getKec_byKota'); ?>',
                    type: 'POST',
                    data: {
                        id_kota: id_kota
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kec_santri").empty();
                        $("#kec_santri").append('<option selected value="">Pilih Kecamatan</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kec'];
                            var name = response[i]['nama_kecamatan'];
                            $('#kec_santri').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kec_santri").empty();
                $("#kec_santri").append('<option selected value="">Pilih Kecamatan</option>');
            }
        });

        $('#kec_santri').change(function() {
            var id_kec = $(this).val();
            if (id_kec !== '') {
                $.ajax({
                    url: '<?= base_url('santri/getKel_byKec'); ?>',
                    type: 'POST',
                    data: {
                        id_kec: id_kec
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        var len = response.length;
                        $("#kel_santri").empty();
                        $("#kel_santri").append('<option selected value="">Pilih Kelurahan</option>');
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_kel'];
                            var name = response[i]['nama_kelurahan'];
                            $('#kel_santri').append('<option value="' + id + '">' + name + '</option>');
                        }
                    }
                });
            } else {
                $("#kel_santri").empty();
                $("#kel_santri").append('<option selected value="">Pilih Kelurahan</option>');
            }
        });

        $(document).ready(function() {

            $('#customCheck').change(function() {
                if ($(this).is(':checked')) {
                    $('#DataWali').slideDown();
                } else {
                    $('#DataWali').slideUp();
                }
            });
        });

        $(document).ready(function() {
            // Inisialisasi Select2 di dalam modal saat modal ditampilkan
            $('#editPenilaian').on('shown.bs.modal', function() {
                $('#penilai_id').select2({
                    dropdownParent: $('#editPenilaian')
                });
            });
        });

        $('#filterInputNilai').click(function() {
            var jenis_penilaian_id = $('#jenis_penilaian_id').val();
            var jadwal_penilaian_id = $('#jadwal_penilaian_id').val();

            if (jenis_penilaian_id === '' || jadwal_penilaian_id === '') {
                toastr.error('Anda harus memilih Jenis Penilaian dan Jadwal Penilaian.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('penilaian/filter_penilaian') ?>",
                method: "POST",
                data: {
                    jenis_penilaian_id: jenis_penilaian_id,
                    jadwal_penilaian_id: jadwal_penilaian_id
                },
                success: function(response) {
                    $('#filter_penilaian').html(response);
                    $('#loading').hide();
                    activateTableEdit();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#resetInputNilai').click(function() {
            $('#jenis_penilaian_id').val('').trigger('change');
            $('#jadwal_penilaian_id').val('').trigger('change');
            $('#filter_penilaian').html(''); // Kosongkan card setelah reset
        });

        function activateTableEdit() {
            $('#editable_table').Tabledit({
                url: '<?= base_url('penilaian/update_penilaian') ?>',
                columns: {
                    identifier: [1, 'id_hasil_penilaian'],
                    editable: [
                        [3, 'nilai'],
                        [4, 'deskripsi_penilaian'],
                        [5, 'hasil_nilai'],
                    ]
                },
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-primary',
                        html: '<span class="fas fa-edit"></span>',
                        action: 'edit'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: '<span class="fas fa-save"></span>'
                    },
                },
                onDraw: function() {
                    // Bind keyup event to 'nilai' column to ensure only integers are input
                    $('td:nth-child(3) input').on('keyup', function() {
                        this.value = this.value.replace(/[^0-9]/g, ''); // Hanya angka yang boleh
                    });
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    // toastr.error(data.message);
                    if (data.success === true) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

        $('#filterInputWawancara').click(function() {
            var item_jenis_wawancara_id = $('#item_jenis_wawancara_id').val();
            var jadwal_wawancara_id = $('#jadwal_wawancara_id').val();

            // console.log(item_jenis_wawancara_id);

            if (item_jenis_wawancara_id === '' || jadwal_wawancara_id === '') {
                toastr.error('Anda harus memilih Jenis Wawancara dan Jadwal Wawancara.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('wawancara/filter_wawancara') ?>",
                method: "POST",
                data: {
                    item_jenis_wawancara_id: item_jenis_wawancara_id,
                    jadwal_wawancara_id: jadwal_wawancara_id
                },
                success: function(response) {
                    $('#filter_wawancara').html(response);
                    $('#loading').hide();
                    TabelWawancaraInput();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#resetInputWawancara').click(function() {
            $('#item_jenis_wawancara_id').val('').trigger('change');
            $('#jadwal_wawancara_id').val('').trigger('change');
            $('#filter_wawancara').html(''); // Kosongkan card setelah reset
        });

        function TabelWawancaraInput() {


            $('#InputWawancara_tabel').Tabledit({
                url: '<?= base_url('wawancara/update_wawancara') ?>',
                columns: {
                    identifier: [1, 'id_hasil_wawancara'],
                    editable: [
                        [3, 'deskripsi_wawancara'],
                        [4, 'hasil']
                    ]
                },
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-primary',
                        html: '<span class="fas fa-edit"></span>',
                        action: 'edit'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: '<span class="fas fa-save"></span>'
                    },
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    // toastr.error(data.message);

                    if (data.success === true) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                        // if (data.message === 'Anda tidak memiliki izin untuk mengedit data ini.') {
                        //     $('.btn-edit').prop('disabled', true); // Disable tombol edit
                        // }
                    }
                }
            });
        }

        $('#filterInputKesehatan').click(function() {
            var jadwal_kesehatan_id = $('#jadwal_kesehatan_id').val();

            if (jadwal_kesehatan_id === '') {
                toastr.error('Anda harus memilih Jadwal Tes Kesehatan.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('kesehatan/filter_kesehatan') ?>",
                method: "POST",
                data: {
                    jadwal_kesehatan_id: jadwal_kesehatan_id
                },
                success: function(response) {
                    $('#filter_kesehatan').html(response);
                    $('#loading').hide();
                    tableTesKesehatan();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#resetInputKesehatan').click(function() {
            $('#jadwal_kesehatan_id').val('').trigger('change');
            $('#filter_kesehatan').html(''); // Kosongkan card setelah reset
        });

        function tableTesKesehatan() {
            $('#tesKesehatan_table').Tabledit({
                url: '<?= base_url('kesehatan/update_kesehatan') ?>',
                columns: {
                    identifier: [1, 'id_hasil_kesehatan'],
                    editable: [
                        [3, 'deskripsi_kesehatan'],
                        [4, 'hasil'],
                    ]
                },
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-primary',
                        html: '<span class="fas fa-edit"></span>',
                        action: 'edit'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: '<span class="fas fa-save"></span>'
                    },
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    // toastr.error(data.message);
                    if (data.success === true) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

        // Data Seluruh Santri
        $('#filterDataCasan').click(function() {
            var filter_tapel_casan = $('#filter_tapel_casan').val();

            if (filter_tapel_casan === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_dataSantri') ?>",
                method: "POST",
                data: {
                    filter_tapel_casan: filter_tapel_casan
                },
                success: function(response) {
                    $('#load_Datacasan').html(response);
                    $('#loading').hide();
                    tableFilterCasan();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#resetDataCasan').click(function() {
            $('#filter_tapel_casan').val('').trigger('change');
            $('#load_Datacasan').html('');
        });

        function tableFilterCasan() {
            $('#table_Datacasan').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        // Data Santri Per Sekolah
        $('#filterCasanPerSekolah').click(function() {
            var filterData_santri_tingkat = $('#filterData_santri_tingkat').val();

            if (filterData_santri_tingkat === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_dataSantriSekolah') ?>",
                method: "POST",
                data: {
                    filterData_santri_tingkat: filterData_santri_tingkat
                },
                success: function(response) {
                    $('#load_CasanPerSekolah').html(response);
                    $('#loading').hide();
                    tableFilterCasan_Persekolah();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#resetCasanPerSekolah').click(function() {
            $('#filterData_santri_tingkat').val('').trigger('change');
            $('#load_CasanPerSekolah').html('');
        });

        function tableFilterCasan_Persekolah() {
            $('#Casan_perSekolah').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        $('#FilterJadwalSantriPleno').click(function() {
            var jadwal_santri_diterima = $('#jadwal_santri_diterima').val();
            var filter_program_pleno = $('#filter_program_pleno').val();

            if (jadwal_santri_diterima === '') {
                toastr.error('Anda harus memilih Jadwal Tes.');
                return false;
            }
            if (filter_program_pleno === '') {
                toastr.error('Anda harus memilih Program Tes.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_rekapPlenobyJadwal') ?>",
                method: "POST",
                data: {
                    jadwal_santri_diterima: jadwal_santri_diterima,
                    filter_program_pleno: filter_program_pleno
                },
                success: function(response) {
                    $('#RekapPleno_byJadwal').html(response);
                    $('#loading').hide();
                    TabelSantriByJadwal();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });

            $.ajax({
                url: "<?= base_url('santri/load_prosesterimasantri') ?>",
                method: "POST",
                data: {
                    jadwal_santri_diterima: jadwal_santri_diterima,
                    filter_program_pleno: filter_program_pleno
                },
                success: function(response) {
                    $('#Santri_byJadwal').html(response);
                    $('#loading').hide();
                    TabelSantriByJadwal();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#ResetJadwalSantriPleno').click(function() {
            $('#jadwal_santri_diterima').val('').trigger('change');
            $('#filter_program_pleno').val('').trigger('change');
            $('#Santri_byJadwal').html('');
            $('#RekapPleno_byJadwal').html('');
        });

        function TabelSantriByJadwal() {
            $('#tableSantri_byJadwal').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        // Data Diterima
        $('#FilterSantriFinish').click(function() {
            var tapel_santri_finish = $('#tapel_santri_finish').val();

            if (tapel_santri_finish === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_SantriFinish') ?>",
                method: "POST",
                data: {
                    tapel_santri_finish: tapel_santri_finish
                },
                success: function(response) {
                    $('#load_SantriDiterima').html(response);
                    $('#loading').hide();
                    TabelSantriDiterima();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#ResetSantriFinish').click(function() {
            $('#tapel_santri_finish').val('').trigger('change');
            $('#load_SantriDiterima').html('');
        });

        function TabelSantriDiterima() {
            $('#table_SantriDiterima').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        // Data Diterima Per Sekolah
        $('#FilterSantriFinish_pertingkat').click(function() {
            var tapel_finish_persekolah = $('#tapel_finish_persekolah').val();

            if (tapel_finish_persekolah === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_SantriFinish') ?>",
                method: "POST",
                data: {
                    tapel_finish_persekolah: tapel_finish_persekolah
                },
                success: function(response) {
                    $('#load_SantriDiterima_pertingkat').html(response);
                    $('#loading').hide();
                    TabelSantriDiterima();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#ResetSantriFinish_pertingkat').click(function() {
            $('#tapel_finish_persekolah').val('').trigger('change');
            $('#load_SantriDiterima_pertingkat').html('');
        });

        function TabelSantriDiterima() {
            $('#table_SantriDiterima_pertingkat').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        // $('#tapel_santri_diterima').change(function() {
        //     var tapel_id = $(this).val();

        //     if (tapel_id) {
        //         $.ajax({
        //             url: "<?= base_url('santri/get_tapel_santri_diterima'); ?>",
        //             type: "POST",
        //             data: {
        //                 tapel_id: tapel_id
        //             },
        //             dataType: "json",
        //             success: function(response) {
        //                 $.each(response, function(index, value) {
        //                     $('#santri_diterima').append('<option value="' + value.id_santri + '">' + value.nama_lengkap + '</option>');
        //                 });
        //             },
        //             error: function(xhr, status, error) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     }

        // });

        // $('#simpanSantriDiterima').click(function() {
        //     var selectedSantri = $('#santri_diterima').val();
        //     var tapel_id = $('#tapel_santri_diterima').val();
        //     var aksi = $('#aksi_penerimaan').val();

        //     if (selectedSantri.length > 0 && tapel_id && aksi) {
        //         $.ajax({
        //             url: "<?= base_url('santri/simpanSantri_Diterima'); ?>",
        //             type: "POST",
        //             data: {
        //                 aksi: aksi,
        //                 santri_diterima: selectedSantri
        //             },
        //             success: function(response) {
        //                 toastr.success('Data berhasil disimpan.');
        //             },
        //             error: function(xhr, status, error) {
        //                 toastr.error('Gagal menyimpan data.');
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     } else {
        //         toastr.error('Pilih Tahun Pelajaran dan Nama Santri.');
        //     }
        // });

        $('#FilterSantriFinish').click(function() {
            var tapel_santri_finish = $('#tapel_santri_finish').val();

            if (tapel_santri_finish === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_dataSantri') ?>",
                method: "POST",
                data: {
                    tapel_santri_finish: tapel_santri_finish
                },
                success: function(response) {
                    $('#load_SantriFinish').html(response);
                    $('#loading').hide();
                    tableFilterCasan_Finish();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#ResetSantriFinish').click(function() {
            $('#tapel_santri_finish').val('').trigger('change');
            $('#load_SantriFinish').html('');
        });

        function tableFilterCasan_Finish() {
            $('#table_Datacasan').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }

        $('#FilterCasanSync').click(function() {
            var tapel_syncCasan = $('#tapel_syncCasan').val();

            if (tapel_syncCasan === '') {
                toastr.error('Anda harus memilih Tahun Pelajaran.');
                return false;
            }

            $('#loading').show();

            $.ajax({
                url: "<?= base_url('santri/load_CasanSync') ?>",
                method: "POST",
                data: {
                    tapel_syncCasan: tapel_syncCasan
                },
                success: function(response) {
                    $('#load_CasanSync').html(response);
                    $('#loading').hide();
                    tableFilterCasan_Finish();
                },
                error: function() {
                    $('#loading').hide();
                    toastr.error('Terjadi kesalahan saat memuat data.');
                }
            });
        });

        $('#ResetCasanSync').click(function() {
            $('#tapel_syncCasan').val('').trigger('change');
            $('#load_CasanSync').html('');
        });

        function tableFilterCasan_Finish() {
            $('#table_CasanSync').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "destroy": true
            });
        }
    </script>

    </body>

    </html>