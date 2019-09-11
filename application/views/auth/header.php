<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Login Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/io-form/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/io-form/') ?>css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/io-form/') ?>css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/io-form/') ?>css/iofrm-theme22.css">
    
    <!-- Sweet Alert -->
    <script src="<?= base_url('assets/vendor/sweetalert/dist/') ?>sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sweetalert/dist/') ?>sweetalert.css">
    <title><?= $title ?></title>
</head>
<body>

<!-- Username Invalid Alert -->
<?php if(isset($err) && $err === 404) : ?>
    <?= "<script>
        swal('Username Invalid', 'If there are problems logging in or new user submission process please contact Ward (Ext. 57242)', 'error')
    </script>"; ?>

<!-- Password Invalid Alert  -->
<?php elseif(isset($err) && $err === 403) : ?>
    <?= "<script>
        swal('Password Invalid', 'If there are problems logging in or new user submission process please contact Ward (Ext. 57242)', 'error')
    </script>"; ?>

<?php endif; ?>