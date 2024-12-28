<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= base_url('assets/') ?>bayhi.ico" type="image/x-icon" />

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/theme_1/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
    <link href="<?= base_url('assets/theme_1/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .select.form-control-user option {
            color: #000;
            /* Pastikan warnanya terlihat */
        }

        .select2-container .select2-selection--single {
            height: 38px;
            /* Sama seperti input di SB Admin 2 */
            border-radius: 0.35rem;
            border: 1px solid #d1d3e2;
            padding: 6px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 25px;
            /* Menyesuaikan dengan tinggi input */
        }

        .invalid-feedback {
            display: none;
            color: red;
        }
    </style>

</head>

<body style="background-image: url('<?= base_url('assets/theme_1/') ?>img/bg_bayhi.jpg');">