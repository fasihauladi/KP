

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
						<?php if ($this->session->userdata('foto')!=""): ?>
							<img src="<?php echo base_url('upload/'.$this->session->userdata('foto')) ?>" class="user-image" alt="User Image">
						<?php else: ?>
							<?php if ($this->session->userdata('jk')=='L'): ?>
								<img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
							<?php else: ?>
								<img src="<?php echo base_url() ?>assets/dist/img/avatar2.png" class="user-image" alt="User Image">
							<?php endif ?>
						<?php endif ?>
						<span class="hidden-xs text-capitalize"><?php echo $this->session->userdata('nama'); ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<?php if ($this->session->userdata('foto')!=""): ?>
								<img src="<?php echo base_url('upload/'.$this->session->userdata('foto')) ?>" class="img-circle" alt="User Image">
							<?php else: ?>
								<?php if ($this->session->userdata('jk')=='L'): ?>
									<img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
								<?php else: ?>
									<img src="<?php echo base_url() ?>assets/dist/img/avatar2.png" class="img-circle" alt="User Image">
								<?php endif ?>
							<?php endif ?>
							<p class="text-capitalize">
								<?php echo $this->session->userdata('nama'); ?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo base_url('admin/profil') ?>" class="btn btn-default btn-flat">Profil</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat">Log Out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	


</header>

