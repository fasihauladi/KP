<!-- sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- user -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if ($this->session->userdata('foto_user') != "") : ?>
                    <img src="<?php echo base_url('assets/gambarDB/user/' . $this->session->userdata('foto_user')) ?>" class="img-circle" alt="User Image">
                <?php else : ?>
                    <?php if ($this->session->userdata('jk_user') == 'Laki-laki') : ?>
                        <img src="<?php echo base_url() ?>assets/images/avatar5.png" class="img-circle" alt="User Image">
                    <?php else : ?>
                        <img src="<?php echo base_url() ?>assets/images/avatar2.png" class="img-circle" alt="User Image">
                    <?php endif ?>
                <?php endif ?>
            </div>
            <div class="pull-left info">
                <p class="text-capitalize"><?php echo $this->session->userdata('nama_user'); ?></p>
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
        <!-- MENU SUPER ADMIN -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU UTAMA</li>
            <!-- menu beranda -->
            <li class="<?php if (!$this->uri->segment(2)) echo 'active'; ?>">
                <a href="<?= base_url(); ?>superadmin">
                    <i class="fa fa-dashboard"></i> <span>Beranda</span>
                </a>
            </li>

            <!-- menu user -->
            <?php $arrMenuUser = ['admin', 'mahasiswa']; ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuUser)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    <span>User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu user :: admin -->
                    <li class="<?php if ($this->uri->segment(2) == "admin") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/admin">
                            <i class="fa fa-id-badge"></i> <span>Admin</span>
                        </a>
                    </li>
                    <!-- menu user :: mahasiswa -->
                    <li class="<?php if ($this->uri->segment(2) == "mahasiswa") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/mahasiswa">
                            <i class="fa fa-vcard"></i> <span>Mahasiswa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- menu akademik -->
            <?php
            $arrSubMenuProdi = ['visi-misi-prodi', 'bidang-minat', 'dosen', 'seputar-prodi'];
            $arrSubMenuLaboratorium = ['profil-laboratorium', 'kategori-laboratorium', 'karya-laboratorium', 'seputar-laboratorium'];
            $arrSubMenuBeasiswa = ['jalur-beasiswa'];
            $arrMenuAkademik = array_merge($arrSubMenuProdi, $arrSubMenuLaboratorium, $arrSubMenuBeasiswa);
            ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuAkademik)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>Akademik</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu akademik :: prodi -->
                    <li class="treeview <?php if (in_array($this->uri->segment(2), $arrSubMenuProdi)) echo 'active'; ?>">
                        <a href="#">
                            <i class="fa fa-building"></i>
                            <span>Prodi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <!-- menu akademik :: prodi :: visi misi -->
                            <li class="<?php if ($this->uri->segment(2) == "visi-misi-prodi") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/visi-misi-prodi">
                                    <i class="fa fa-binoculars"></i> <span>Visi Misi</span>
                                </a>
                            </li>
                            <!-- menu akademik :: prodi :: bidang minat -->
                            <li class="<?php if ($this->uri->segment(2) == "bidang-minat") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/bidang-minat">
                                    <i class="fa fa-mouse-pointer"></i> <span>Bidang Minat</span>
                                </a>
                            </li>
                            <!-- menu akademik :: prodi :: dosen -->
                            <li class="<?php if ($this->uri->segment(2) == "dosen") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/dosen">
                                    <i class="fa fa-user"></i> <span>Dosen</span>
                                </a>
                            </li>
                            <!-- menu akademik :: prodi :: seputar prodi -->
                            <li class="<?php if ($this->uri->segment(2) == "seputar-prodi") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/seputar-prodi">
                                    <i class="fa fa-newspaper-o"></i> <span>Seputar Prodi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- menu akademik :: laboratorium -->
                    <li class="treeview <?php if (in_array($this->uri->segment(2), $arrSubMenuLaboratorium)) echo 'active'; ?>">
                        <a href="#">
                            <i class="fa fa-window-restore"></i>
                            <span>Laboratorium</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <!-- menu akademik :: laboratorium :: profil laboratorium -->
                            <li class="<?php if ($this->uri->segment(2) == "profil-laboratorium") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/profil-laboratorium">
                                    <i class="fa fa-flask"></i> <span>Profil Laboratorium</span>
                                </a>
                            </li>
                            <!-- menu akademik :: laboratorium :: kategori laboratorium -->
                            <li class="<?php if ($this->uri->segment(2) == "kategori-laboratorium") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/kategori-laboratorium">
                                    <i class="fa fa-list"></i> <span>Kategori Laboratorium</span>
                                </a>
                            </li>
                            <!-- menu akademik :: laboratorium :: karya laboratorium -->
                            <li class="<?php if ($this->uri->segment(2) == "karya-laboratorium") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/karya-laboratorium">
                                    <i class="fa fa-star"></i> <span>Karya Laboratorium</span>
                                </a>
                            </li>
                            <!-- menu akademik :: laboratorium :: seputar laboratorium -->
                            <li class="<?php if ($this->uri->segment(2) == "seputar-laboratorium") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/seputar-laboratorium">
                                    <i class="fa fa-newspaper-o"></i> <span>Seputar Laboratorium</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- menu akademik :: beasiswa -->
                    <li class="treeview <?php if (in_array($this->uri->segment(2), $arrSubMenuBeasiswa)) echo 'active'; ?>">
                        <a href="#">
                            <i class="fa fa-chain-broken"></i>
                            <span>Beasiswa</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <!-- menu akademik :: beasiswa :: jalur beasiswa -->
                            <li class="<?php if ($this->uri->segment(2) == "jalur-beasiswa") echo 'active'; ?>">
                                <a href="<?= base_url(); ?>superadmin/jalur-beasiswa">
                                    <i class="fa fa-money"></i> <span>Jalur Beasiswa</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- menu penjamin mutu -->
            <?php $arrMenuPenjaminMutu = ['dokumen-mutu', 'standar-operasional-prosedur']; ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuPenjaminMutu)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Penjaminan Mutu</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu penjamin mutu :: dokumen mutu -->
                    <li class="<?php if ($this->uri->segment(2) == "dokumen-mutu") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/dokumen-mutu">
                            <i class="fa fa-copy"></i> <span>Dokumen Mutu</span>
                        </a>
                    </li>
                    <!-- menu penjamin mutu :: SOP -->
                    <li class="<?php if ($this->uri->segment(2) == "standar-operasional-prosedur") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/standar-operasional-prosedur">
                            <i class="fa fa-file"></i> <span>SOP</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- menu penelitian dan pengabdian -->
            <?php $arrMenuPenelitian = ['peta-penelitian', 'karya-penelitian', 'kategori-penelitian', 'karya-pengabdian', 'macam-pengabdian', 'seputar-pengabdian']; ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuPenelitian)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Penelitian dan Pengabdian</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu penelitian dan pengabdian :: peta penelitian -->
                    <li class="<?php if ($this->uri->segment(2) == "peta-penelitian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/peta-penelitian">
                            <i class="fa fa-map"></i> <span>Peta Penelitian</span>
                        </a>
                    </li>
                    <!-- menu penelitian dan pengabdian :: karya penelitian -->
                    <li class="<?php if ($this->uri->segment(2) == "karya-penelitian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/karya-penelitian">
                            <i class="fa fa-star"></i> <span>Karya Penelitian</span>
                        </a>
                    </li>
                    <!-- menu penelitian dan pengabdian :: kategori penelitian -->
                    <li class="<?php if ($this->uri->segment(2) == "kategori-penelitian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/kategori-penelitian">
                            <i class="fa fa-list"></i> <span>Kategori Penelitian</span>
                        </a>
                    </li>
                    <!-- menu penelitian dan pengabdian :: karya pengabdian -->
                    <li class="<?php if ($this->uri->segment(2) == "karya-pengabdian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/karya-pengabdian">
                            <i class="fa fa-star"></i> <span>Karya Pengabdian</span>
                        </a>
                    </li>
                    <!-- menu penelitian dan pengabdian :: macam pengabdian -->
                    <li class="<?php if ($this->uri->segment(2) == "macam-pengabdian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/macam-pengabdian">
                            <i class="fa fa-graduation-cap"></i> <span>Macam Pengabdian</span>
                        </a>
                    </li>
                    <!-- menu penelitian dan pengabdian :: seputar pengabdian -->
                    <li class="<?php if ($this->uri->segment(2) == "seputar-pengabdian") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/seputar-pengabdian">
                            <i class="fa fa-newspaper-o"></i> <span>Seputar Pengabdian</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- menu kemahasiswaaan -->
            <?php $arrMenuKemahasiswaan = ['unit-kegiatan-mahasiswa', 'seputar-ukm', 'prestasi-mahasiswa']; ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuKemahasiswaan)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>Kemahasiswaan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu kemahasiswaan :: UKM -->
                    <li class="<?php if ($this->uri->segment(2) == "unit-kegiatan-mahasiswa") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/unit-kegiatan-mahasiswa">
                            <i class="fa fa-users"></i> <span>UKM</span>
                        </a>
                    </li>
                    <!-- menu kemahasiswaan :: seputar UKM -->
                    <li class="<?php if ($this->uri->segment(2) == "seputar-ukm") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/seputar-ukm">
                            <i class="fa fa-newspaper-o"></i> <span>Seputar UKM</span>
                        </a>
                    </li>
                    <!-- menu kemahasiswaan :: prestasi mahasiswa -->
                    <li class="<?php if ($this->uri->segment(2) == "prestasi-mahasiswa") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/prestasi-mahasiswa">
                            <i class="fa fa-trophy"></i> <span>Prestasi Mahasiswa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- menu alumni dan stakeholder -->
            <?php $arrMenuStakeholder = ['data-alumni', 'pengurus', 'kategori-jabatan']; ?>
            <li class="treeview <?php if (in_array($this->uri->segment(2), $arrMenuStakeholder)) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>Alumni dan Stakeholder</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- menu alumni dan stakeholder :: data alumni -->
                    <li class="<?php if ($this->uri->segment(2) == "data-alumni") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/data-alumni">
                            <i class="fa fa-table"></i> <span>Data Alumni</span>
                        </a>
                    </li>
                    <!-- menu alumni dan stakeholder :: pengurus -->
                    <li class="<?php if ($this->uri->segment(2) == "pengurus") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/pengurus">
                            <i class="fa fa-users"></i> <span>Pengurus</span>
                        </a>
                    </li>
                    <!-- menu alumni dan stakeholder :: kategori jabatan -->
                    <li class="<?php if ($this->uri->segment(2) == "kategori-jabatan") echo 'active'; ?>">
                        <a href="<?= base_url(); ?>superadmin/kategori-jabatan">
                            <i class="fa fa-list"></i> <span>Kategori Jabatan</span>
                        </a>
                    </li>
                </ul>
            </li>
    </section>

</aside>