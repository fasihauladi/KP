<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portal Teknik Informatika - Halaman Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-green-light layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo base_url() ?>" class="navbar-brand"><b>Portal-</b>Teknik Informatika</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
        </div>
      </nav>
    </header>
    <div class="content-wrapper">
      <div class="container">
        <div class="login-box">
          <div class="login-box-body">
            <form method="post" action="<?= base_url(); ?>tiflog">
              <?= $this->session->flashdata("message"); ?>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="username" name="username" id="username" value="<?= set_value('username'); ?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <a href="#">Saya lupa kata sandi</a><br>
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>YPP Qamarul Huda Bagu&copy;<?php echo date('Y') ?></strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/portal_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/portal_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/portal_admin/dist/js/demo.js"></script>

  <?php if ($this->session->flashdata('pesanLogin')) : ?>
    <script type="text/javascript">
      alert('<?php echo $this->session->flashdata('pesanLogin'); ?>')
    </script>
  <?php endif ?>
</body>

</html>