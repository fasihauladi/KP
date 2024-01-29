<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title id="namaTitleHeader">Teknik Informatika</title>

    <!--    Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!--Fontawesom-->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/font-awesome.min.css"> versi 4.4 -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/font-awesome.min.css">
    <!--Animated CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/portal_akademik/css/animate.min.css">

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>assets/portal_akademik/css/bootstrap.min.css" rel="stylesheet">
    <!--Bootstrap Carousel-->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/carousel.css" />

    <!--Main Stylesheet-->
    <link href="<?= base_url(); ?>assets/portal_akademik/css/style.css" rel="stylesheet">
    <!--Responsive Framework-->
    <link href="<?= base_url(); ?>assets/portal_akademik/css/responsive.css" rel="stylesheet">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://skywalkapps.github.io/bootstrap-dropmenu/stylesheets/bootstrap-dropmenu.min.css'>

    <link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap.min.css'>

    <script src="<?= base_url(); ?>assets/portal_akademik/js/jquery-1.12.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/isotope/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!--- jika ingin merubah apa yang ada diboostrap ini harus dibawahnya css booststrap-->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/style.css" rel="stylesheet"/> -->
    <link href="<?= base_url(); ?>assets/portal_akademik/css/style.css?v=1.0" rel="stylesheet" type="text/css" />

</head>

<body data-spy="scroll" data-target="#header">

    <!--Start Hedaer Section-->
    <section id="header">
        <div class="header-area">
            <div class="top_header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 zero_mp">
                            <div class="address">
                                <i class="fa fa-home floatleft"></i>
                                <p>Jl. Raya Telang PO BOX 2 Kamal Box 2, Kamal, BKL,Ind</p>
                            </div>
                        </div>
                        <!--End of col-md-4-->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 zero_mp">
                            <div class="phone">
                                <i class="fa fa-phone floatleft"></i>
                                <p>031-3011147</p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 zero_mp">
                            <div class="phone">
                                <i class="fa fa-envelope floatleft"></i>
                                <p>informatika@trunojoyo.ac.id</p>
                            </div>
                        </div>


                        <!--End of col-md-4-->
                        <div class="col-md-4">
                            <div class="social_icon text-right">
                                <a href=""><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-google-plus"></i></a>
                                <a href=""><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                        <!--End of col-md-4-->
                    </div>
                    <!--End of row-->
                </div>
                <!--End of container-->
            </div>
            <!--End of top header-->

            <!--End of header menu-->
        </div>
        <!--end of header area-->
    </section>
    <!--End of Hedaer Section-->
    <section>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?= base_url(); ?>"><strong><img src="<?= base_url(); ?>assets/images/logo.png" alt="..." height="36" style="padding-bottom: 10px"> Teknik Informatika</strong></a>
                </div>
                <nav class="nav navbar-nav navbar-right main_menu">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <!-- <li class="dropdown dropdown-megamenu open">  IF THIS SETTING OPEN THEN ALWAY POP up if yout firt opent-->
                            <!-- MENU AKADEMIK -->
                            <li class="dropdown dropdown-megamenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akademik <span class="sr-only">(current)</span></a>
                                <div class="dropdown-container">
                                    <div class="row">
                                        <!-- MENU AKADEMIK :: BIDANG MINAT -->
                                        <div class="col-sm-3 col-md-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Bidang Minat</h5>
                                                    <ul class="list-links">
                                                        <?php foreach ($bidangMinatHeader as $bmh) : ?>
                                                            <div id="grad1"></div>
                                                            <li>
                                                                <a href="<?= base_url(); ?>bidang-minat/<?= $bmh->id ?>"><?= ucwords($bmh->namabidminat); ?></a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        <div id="grad1"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /col -->
                                        <!-- MENU AKADEMIK :: LABORATORIUM -->
                                        <div class="col-sm-6 col-md-4">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Laboratorium</h5>
                                                    <ul class="list-links">
                                                        <?php foreach ($labHeader as $lh) : ?>
                                                            <div id="grad1"></div>
                                                            <li>
                                                                <a href="<?= base_url(); ?>laboratorium-teknik-informatika/<?= $lh->kodelab ?>"><?= $lh->namalab ?></a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        <div id="grad1"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /col -->
                                        <div class="col-sm-6 col-md-4">
                                            <img src="<?= base_url(); ?>assets/images/imgutma.jpg">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                            <!-- MENU PENJAMIN MUTU -->
                            <li class="dropdown dropdown-megamenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Penjaminan Mutu</a>
                                <div class="dropdown-container">
                                    <div class="row">
                                        <!-- MENU PENJAMIN MUTU :: DOKUMEN MUTU -->
                                        <div class="col-sm-3 col-md-3">
                                            <h5>Dokumen Mutu</h5>
                                            <ul class="list-links">
                                                <li role="separator" class="divider"></li>

                                                <?php foreach ($dokumenMutuHeader as $dmh) : ?>
                                                    <div id="grad1"></div>
                                                    <li>
                                                        <a href="<?= base_url(); ?>dokumen-mutu/<?= $dmh->id ?>"><?= ucwords($dmh->deskripsi); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                                <div id="grad1"></div>
                                            </ul>
                                        </div><!-- /col -->
                                        <!-- MENU PENJAMIN MUTU :: SOP -->
                                        <div class="col-sm-6 col-md-4">
                                            <h5>Standar Operasion Prosedur</h5>
                                            <ul class="list-links">
                                                <li role="separator" class="divider"></li>

                                                <?php foreach ($sopHeader as $sh) : ?>
                                                    <div id="grad1"></div>
                                                    <li>
                                                        <a href="<?= base_url(); ?>dokumen-sop/<?= $sh->id ?>"><?= ucwords($sh->deskripsi); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                                <div id="grad1"></div>
                                            </ul>
                                        </div><!-- /col -->
                                        <div class="col-sm-6 col-md-4">
                                            <img src="<?= base_url(); ?>assets/images/img2.jpg">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                            <!-- MENU PENELITIAN DAN PENGABDIAN -->
                            <li class="dropdown dropdown-megamenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Penelitian dan Pengabdian</a>
                                <div class="dropdown-container">
                                    <div class="row">
                                        <!-- MENU PENELITIAN DAN PENGABDIAN :: PETA PENELITIAN -->
                                        <div class="col-sm-3 col-md-3">
                                            <div id="pageTitle">
                                                <h5>Peta Penelitian </h5>
                                            </div>
                                            <ul class="list-links">
                                                <div id="grad1"></div>
                                                <li><a href="<?= base_url(); ?>peta-penelitian-dosen">Peta Penelitian Dosen</a></li>
                                                <div id="grad1"></div>
                                                <li><a href="<?= base_url(); ?>peta-penelitian-mahasiswa">Peta Penelitan Mahasiswa</a></li>
                                                <div id="grad1"></div>
                                                <li><a href="#" style="color:red">Rencana Penelitian lima tahunan</a></li>
                                                <div id="grad1"></div>
                                            </ul>
                                        </div><!-- /col -->
                                        <!-- MENU PENELITIAN DAN PENGABDIAN :: KARYA PENELITIAN-->
                                        <div class="col-sm-3 col-md-3">
                                            <h5>Karya Penelitian</h5>
                                            <ul class="list-links">
                                                <?php foreach ($kategoriPenelitianHeader as $kph) : ?>
                                                    <div id="grad1"></div>
                                                    <li>
                                                        <a href="<?= base_url(); ?>kategori-penelitian/<?= $kph->id ?>"><?= $kph->namakatpen ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                                <div id="grad1"></div>
                                            </ul>
                                        </div><!-- /col -->
                                        <!-- MENU PENELITIAN DAN PENGABDIAN :: PENGABDIAN MASYARAKAT -->
                                        <div class="col-sm-3 col-md-3">
                                            <h5>Pengabdian Masyarakat</h5>
                                            <ul class="list-links">
                                                <?php foreach ($kategoriPengabdianHeader as $kph) : ?>
                                                    <div id="grad1"></div>
                                                    <li>
                                                        <a href="<?= base_url(); ?>kategori-pengabdian/<?= $kph->id ?>"><?= $kph->kategori ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                                <div id="grad1"></div>
                                            </ul>
                                        </div><!-- /col -->
                                        <div class="col-sm-3 col-md-3">
                                            <img src="<?= base_url(); ?>assets/images/riset.jpg">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                            <!-- MENU KEMAHASISWAAN -->
                            <li class="dropdown dropdown-megamenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kemahasiswaan</a>
                                <div class="dropdown-container">
                                    <div class="row">
                                        <!-- MENU KEMAHASISWAAN :: UKM & LAYANAN KEMAHASISWAAN-->
                                        <div class="col-sm-3">
                                            <h5>unit kegiatakan mahasiswa (UKM)</h5>
                                            <ul class="list-links">
                                                <?php foreach ($UKMHeader as $uh) : ?>
                                                    <div id="grad1"></div>
                                                    <li>
                                                        <a href="<?= base_url(); ?>unit-kegiatan-mahasiswa/<?= $uh->id ?>"><?= ucwords($uh->nama); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                                <div id="grad1"></div>
                                            </ul>
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Layanan Kemahasiswaan</h5>
                                                    <ul class="list-links">
                                                        <div id="grad1"></div>
                                                        <li><a href="">Pendaftaran Wisuda </a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="prodi.html">Pendaftaran dan Monitoring Skripsi</a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="prodi.html">KRS Onlne</a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="prodi.html">Pendaftaran Cuti</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /col -->
                                        <!-- MENU KEMAHASISWAAN :: PRESTASI MAHASISWA-->
                                        <div class="col-sm-3">
                                            <h5>Prestasi Mahasiswa</h5>
                                            <ul class="list-links">
                                                <div id="grad1"></div>
                                                <li><a href="<?= base_url(); ?>prestasi-mahasiswa/3">Prestasi International</a></li>
                                                <div id="grad1"></div>
                                                <li><a href="<?= base_url(); ?>prestasi-mahasiswa/2">Prestasi Nasional </a></li>
                                                <div id="grad1"></div>
                                                <li><a href="<?= base_url(); ?>prestasi-mahasiswa/1">Prestasi Regional</a></li>
                                                <div id="grad1"></div>
                                            </ul>
                                            <!-- /col -->
                                        </div><!-- /col -->
                                        <div class="col-sm-3">
                                            <img src="<?= base_url(); ?>assets/images/img1.jpg" alt="">
                                        </div><!-- /col -->
                                        <div class="col-sm-3">
                                            <img src="<?= base_url(); ?>assets/images/itc.jpg" alt="">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                            <!-- MENU ?????? -->
                            <li class="dropdown dropdown-megamenu">
                                <div class="dropdown-container">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Tracer study</h5>
                                                    <ul class="list-links">
                                                        <div id="grad1"></div>
                                                        <li><a href="">Tracer studi Online</a></li>
                                                        <div id="grad1"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Sebaran Alumni</h5>
                                                    <ul class="list-links">
                                                        <div id="grad1"></div>
                                                        <li><a href="">Alumni dalam Angka</a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="prodi.html">Stakeholder</a></li>
                                                        <div id="grad1"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /col -->
                                        <div class="col-sm-6 col-md-4">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5>Stakeholder</h5>
                                                    <ul class="list-links">
                                                        <div id="grad1"></div>
                                                        <li><a href="#">Stakeholder Penelitian</a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="#">Stakeholder Pengabdian</a></li>
                                                        <div id="grad1"></div>
                                                        <li><a href="#">Stakeholder Alumni</a></li>
                                                        <div id="grad1"></div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /col -->
                                        <div class="col-sm-6 col-md-4">
                                            <img src="<?= base_url(); ?>assets/images/stake.png">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                            <!-- MENU KONTAK KAMI -->
                            <li class="dropdown dropdown-megamenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kontak kami</a>
                                <div class="dropdown-container">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <h5>Kontak Kami</h5>
                                            <p>Silahkan hubungi kami .</p>
                                            <form>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your Email">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputText1">Text</label>
                                                    <textarea type="password" class="form-control" id="exampleInputText1" placeholder="Your Message" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-default">Submit</button>
                                            </form>
                                        </div><!-- /col -->
                                        <div class="col-sm-6 col-md-8">
                                            <img src="<?= base_url(); ?>assets/images/img1.jpg">
                                        </div><!-- /col -->
                                    </div><!-- /row -->
                                </div><!-- /dropdown-container -->
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div><!-- /.container-fluid -->
        </nav>
    </section>