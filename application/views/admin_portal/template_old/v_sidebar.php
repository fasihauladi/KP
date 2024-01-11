	<section class="sidebar">
		<!-- user -->
		<div class="user-panel">
			<div class="pull-left image">
				<?php if ($this->session->userdata('foto')!=""): ?>
					<img src="<?php echo base_url('upload/'.$this->session->userdata('foto')) ?>" class="img-circle" alt="User Image">
					<?php else: ?>
						<?php if ($this->session->userdata('jk')=='L'): ?>
							<img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
							<?php else: ?>
								<img src="<?php echo base_url() ?>assets/dist/img/avatar2.png" class="img-circle" alt="User Image">
							<?php endif ?>
						<?php endif ?>
					</div>
					<div class="pull-left info">
						<p class="text-capitalize"><?php echo $this->session->userdata('nama'); ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<!-- search -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>

				<!-- menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MENU UTAMA</li>
					<!-- menu beranda -->
					<li class="<?php if($this->uri->segment(1)=="" || $this->uri->segment(1)=='home') echo 'active'; ?>">
						<a href="<?php echo base_url() ?>">
							<i class="fa fa-dashboard"></i> <span>Beranda</span>
						</a>
					</li>
					<!-- santri -->
					<li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Akademik</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							
							<li <li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
								<a href="#">
								<i class="fa fa-users"></i>
								<span>Prodi</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
								</a>
								<ul class="treeview-menu">
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Prodi') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Visi-Misi</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Peta') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Peta Penelitian</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Minat') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Bidang Minat</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Dosen/') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Dosen</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Beritapro/') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Seputar Prodi</span>
										</a>
									</li>
									
								</ul>
							</li>
							
							<li <li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
								<a href="#">
								<i class="fa fa-users"></i>
								<span>Laboratorium</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
								</a>
								<ul class="treeview-menu">
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Lab/') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Profile Laboratorium</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Labkarya/') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Karya Laboratorium</span>
										</a>
									</li>
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('lab/') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Seputar Laboratorium</span>
										</a>
									</li>
									
									
								</ul>
							</li>
							
							<li <li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
								<a href="#">
								<i class="fa fa-users"></i>
								<span>Beasiswa</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
								</a>
								<ul class="treeview-menu">
									<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
										<a href="<?php echo base_url('Webstatis/infromasibeasiswa') ?>">
										<i class="fa fa-minus" aria-hidden="true"></i> <span>Jalur Beasiswa</span>
										</a>
									</li>
									
									
									
									
								</ul>
							</li>
						</ul>
					</li>
						
				</li>
					<!-- kelas -->
				<li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Penjaminan Mutu</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
					<ul class="treeview-menu">
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
									<i class="fa fa-graduation-cap"></i> <span>Dokumen Mutu</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
									<i class="fa fa-graduation-cap"></i> <span>SOP</span>
								</a>
							</li>
							
					</ul>
				</li>
				
				<li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Penelitian dan Pengabdian</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
					<ul class="treeview-menu">
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Peta Penelitian</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Rencana Penelitian</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Karya Penelitian</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Seputar Pengabdian</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Macam  Pengabdian</span>
								</a>
							</li>
							
							
					</ul>
				</li>
				
				<li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Kemahasiswaan</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('Webstatis/Ukm') ?>">
								<i class="fa fa-graduation-cap"></i> <span>UKM</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('Webstatis/Layanan') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Layanan Kemahasiswaan</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Karya Mahasiswa</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Prestasi Mahasiswa</span>
								</a>
							</li>
							
							
							
						</ul>
					
				</li>
				
				<li class="treeview <?php if($this->uri->segment(1)=="santri_baru" || $this->uri->segment(1)=="santri_aktif") echo 'active'; ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Alumni dan Stakeholder</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
					<ul class="treeview-menu">
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Data Alumni</span>
								</a>
							</li>
							<li class="<?php if($this->uri->segment(1)=="santri_baru") echo "active" ?>">
								<a href="<?php echo base_url('lab/') ?>">
								<i class="fa fa-graduation-cap"></i> <span>Stakeholder</span>
								</a>
							</li>
							
					</ul>
				</li>
					
					

					
					

				
			</section>
