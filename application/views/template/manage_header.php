<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/') ?>bayhi.ico" type="image/x-icon" />

    <title><?= $title; ?> | PSB Bayhi</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/theme_1/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?= base_url('assets/theme_1/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/theme_1/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #content-wrapper {
            padding-top: 100px;
            margin-left: 215px;
        }

        @media (max-width: 768px) {
            #content-wrapper {
                margin-left: 106px;
            }
        }

        @media (max-width: 576px) {
            #content-wrapper {
                margin-left: 100px;
            }
        }

        #accordionSidebar {
            padding-top: 85px;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;
        }

        /* Custom scrollbar for sidebar */
        #accordionSidebar::-webkit-scrollbar {
            width: 8px;
            /* Lebar scrollbar */
        }

        #accordionSidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Warna background scrollbar */
            border-radius: 10px;
        }

        #accordionSidebar::-webkit-scrollbar-thumb {
            /* background: #4e73df; */
            background: #3F494B;
            /* Warna scroll thumb (penanda) */
            border-radius: 10px;
        }

        #accordionSidebar::-webkit-scrollbar-thumb:hover {
            background: #9F9F9F;
            /* background: #2e59d9; */
            /* Warna scroll thumb saat hover */
        }

        html,
        body {
            overflow-x: hidden;
        }

        .topbar .topbar-brand {
            height: 4.375rem;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: .05rem;
            z-index: 1
        }

        .topbar .topbar-brand .topbar-brand-icon i {
            font-size: 2rem
        }

        .topbar .topbar-brand .topbar-brand-text {
            display: none
        }

        .topbar hr.topbar-divider {
            margin: 0 1rem 1rem
        }

        .topbar .topbar-brand .topbar-brand-icon i {
            font-size: 2rem
        }

        .topbar .topbar-brand .topbar-brand-text {
            display: inline
        }

        .topbar-brand .topbar-brand-icon i {
            font-size: 2rem
        }

        .topbar-brand .topbar-brand-text {
            display: none
        }

        .topbar-light .topbar-brand {
            color: #6e707e
        }

        .topbar-dark .topbar-brand {
            color: #fff
        }

        /* CSS untuk Select2 Single */
        .select2-container .select2-selection--single {
            height: 38px;
            border-radius: 0.35rem;
            border: 1px solid #d1d3e2;
            padding: 6px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 25px;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection {
            height: calc(1.5em + 0.75rem + 2px) !important;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .input-group-prepend .input-group-text {
            background-color: #f8f9fa;
        }

        .input-group-text {
            border-right: none;
        }

        /* .form-control { */
        .nominal-form {
            text-align: right;
            /* Align text to the right for better number visibility */
        }

        .table-no-border td,
        .table-no-border th {
            border: none;
            /* Menghilangkan border */
            padding: 10px 20px;
            /* Mengatur padding untuk jarak antar elemen */
        }

        .table-no-border {
            width: 100%;
            /* Membuat tabel 100% lebar */
        }

        #loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #555;
            font-size: 18px;
            z-index: 1000;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #3498db;
            /* Warna animasi */
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        /* Animasi berputar */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">