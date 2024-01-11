<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title class="text text-capitalize">TEK-INFORMATIKA - <?php if ($this->uri->segment(1) == "") echo "Beranda"; ?><?php echo $this->uri->segment(2) . ' ' . $this->uri->segment(1) ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
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
	<!-- load JS jquery -->
	<script src="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/portal_admin/bower_components/jquery-ui/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/portal_admin/style.css">
	<!-- tambahan baru untuk datatables -->



	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>

</head>

<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		<!-- header -->
		<?php echo $_header; ?>
		<!-- sidebar -->
		<aside class="main-sidebar">
			<?php echo $_sidebar; ?>
		</aside>
		<!-- content -->
		<div class="content-wrapper">
			<!-- content header -->
			<section class="content-header">
				<h1 class="text-capitalize">
					<?php if ($this->uri->segment(1) != "") echo $this->uri->segment(1);
					else echo "Beranda"; ?>
					<small><?php if ($this->uri->segment(2) == "" && $this->uri->segment(1) != "") echo "tampil";
							else echo $this->uri->segment(2); ?></small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
					<?php if ($this->uri->segment(1) != "") : ?>
						<li class="active"><a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $this->uri->segment(1) ?></a></li>
						<li class="active"><?php if ($this->uri->segment(2) == "") echo "tampil";
											else echo $this->uri->segment(2); ?></li>
					<?php endif ?>


				</ol>
			</section>
			<!-- main content -->
			<section class="content">
				<?php echo $_content; ?>
			</section>
		</div>
		<!-- footer -->
		<?php echo $_footer; ?>
	</div>
	<?php echo  $_js; ?>
	<?php if ($this->session->flashdata('pesan')) : ?>
		<script type="text/javascript">
			alert('<?php echo $this->session->flashdata('pesan'); ?>')
		</script>
	<?php endif ?>
</body>

</html>