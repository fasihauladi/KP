<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title class="text text-capitalize">TEK-INFORMATIKA</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery-ui/jquery-ui.theme.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/select2/dist/css/select2.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/Ionicons/css/ionicons.min.css">

    <!-- adminLTE dan skin -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/dist/css/skins/_all-skins.min.css">
    <!-- datetimepicker dan daterangepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- font google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link href="<?php echo base_url() ?>assets/portal_admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">


    <!-- icheck untuk radio dan chekbox -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/plugins/iCheck/all.css">
    <!-- img hover -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/portal_admin/image-hover.css'); ?>">
    <!-- sweetalert2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/style.css"> -->
    <!-- tambahan baru untuk datatables -->







</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <!-- header -->
        <header class="main-header">

            <!-- logo -->
            <a href="<?php echo base_url() ?>" class="logo">
                <span class="logo-mini"><b>Portal</b></span>
                <span class="logo-lg"><b>Portal</b>Informatika</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- user -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if ($this->session->userdata('foto_user') != "") : ?>
                                    <img src="<?php echo base_url('assets/gambarDB/user/' . $this->session->userdata('foto_user')) ?>" class="user-image" alt="User Image">
                                <?php else : ?>
                                    <?php if ($this->session->userdata('jk_user') == 'Laki-laki') : ?>
                                        <img src="<?php echo base_url() ?>assets/images/avatar5.png" class="user-image" alt="User Image">
                                    <?php else : ?>
                                        <img src="<?php echo base_url() ?>assets/images/avatar2.png" class="user-image" alt="User Image">
                                    <?php endif ?>
                                <?php endif ?>
                                <span class="hidden-xs text-capitalize"><?php echo $this->session->userdata('nama_user'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?php if ($this->session->userdata('foto_user') != "") : ?>
                                        <img src="<?php echo base_url('assets/gambarDB/user/' . $this->session->userdata('foto_user')) ?>" class="img-circle" alt="User Image">
                                    <?php else : ?>
                                        <?php if ($this->session->userdata('jk_user') == 'Laki-laki') : ?>
                                            <img src="<?php echo base_url() ?>assets/images/avatar5.png" class="img-circle" alt="User Image">
                                        <?php else : ?>
                                            <img src="<?php echo base_url() ?>assets/images/avatar2.png" class="img-circle" alt="User Image">
                                        <?php endif ?>
                                    <?php endif ?>
                                    <p class="text-capitalize">
                                        <?php echo $this->session->userdata('nama_user'); ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('beluuuum') ?>" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('tiflog/logout') ?>" class="btn btn-default btn-flat">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>



        </header>