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
  <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> versi 4.4 -->

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

  <link rel="stylesheet" href="<?= base_url(); ?>assets/portal_akademik/css/isotope/style.css">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

  <!--- jika ingin merubah apa yang ada diboostrap ini harus dibawahnya css booststrap-->
  <!-- <link rel="stylesheet" href="css/style.css" rel="stylesheet"/> -->
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

          <a class="navbar-brand" href="#"><strong><img src="<?= base_url(); ?>assets/portal_akademik/img/logo.png" alt="..." height="36" style="padding-bottom: 10px"> Teknik Informatika</strong></a>
        </div>
        <nav class="nav navbar-nav navbar-right main_menu">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <!-- <li class="dropdown dropdown-megamenu open">  IF THIS SETTING OPEN THEN ALWAY POP up if yout firt opent-->
              <li class="dropdown dropdown-megamenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akademik <span class="sr-only">(current)</span></a>

                <div class="dropdown-container">
                  <div class="row">
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

                    <div class="col-sm-6 col-md-4">
                      <div class="media">

                        <div class="media-body">
                          <h5>Laboratorium</h5>
                          <ul class="list-links">
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Komputasi</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Data Science</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Penelitian</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Bisnis dan Digital</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Signal dan Image Processing</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Rekayasa Perangkat Lunak</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Rekayasa Multimedia</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Temu Kembali Text dan Dokumen Digital</a></li>
                            <div id="grad1"></div>
                            <li><a href="#">Laboratorium Data Mining</a></li>
                            <div id="grad1"></div>
                          </ul>

                        </div>
                      </div>
                    </div><!-- /col -->

                    <div class="col-sm-6 col-md-4">
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/imgutma.jpg">

                    </div><!-- /col -->

                  </div><!-- /row -->
                </div><!-- /dropdown-container -->

              </li>
              <li class="dropdown dropdown-megamenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Penjaminan Mutu</a>
                <div class="dropdown-container">
                  <div class="row">
                    <div class="col-sm-3 col-md-3">

                      <h5>Dokumen Mutu</h5>
                      <ul class="list-links">
                        <li role="separator" class="divider"></li>
                        <div id="grad1"></div>
                        <li><a href="#">Dokumen Mutu Akademik</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Dokumen Mutu Sarana Prasarana</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Dokumen Mutu Kemahasiswaan</a></li>
                        <div id="grad1"></div>
                      </ul>

                    </div><!-- /col -->

                    <div class="col-sm-6 col-md-4">

                      <h5>Standar Operasion Prosedur</h5>
                      <ul class="list-links">
                        <li role="separator" class="divider"></li>
                        <div id="grad1"></div>
                        <li><a href="#">SOP Akademik</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">SOP Kemahasiswaan</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">SOP Sarana Dan Prasaranan</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">SOP Skripsi</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">SOP Kerja Praktek</a></li>
                        <div id="grad1"></div>
                      </ul>

                    </div><!-- /col -->

                    <div class="col-sm-6 col-md-4">
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/img2.jpg">
                    </div><!-- /col -->

                  </div><!-- /row -->
                </div><!-- /dropdown-container -->
              </li>

              <li class="dropdown dropdown-megamenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Penelitian dan Pengabdian</a>

                <div class="dropdown-container">
                  <div class="row">
                    <div class="col-sm-3 col-md-3">
                      <div id="pageTitle">
                        <h5>Peta Penelitian </h5>
                      </div>
                      <ul class="list-links">
                        <div id="grad1"></div>
                        <li><a href="#">Peta Penelitian Dosen</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Peta Penelitan Mahasiswa</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Rencana Penelitian lima tahuna</a></li>
                        <div id="grad1"></div>
                      </ul>

                    </div><!-- /col -->

                    <div class="col-sm-3 col-md-3">

                      <h5>Karya Penelitian</h5>
                      <ul class="list-links">
                        <div id="grad1"></div>
                        <li><a href="#">Penelitan Multi Disiplin </a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Penliitian MBKM</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Penelitian Inovasi dan Terapan</a></li>
                        <div id="grad1"></div>

                      </ul>

                    </div><!-- /col -->

                    <div class="col-sm-3 col-md-3">

                      <h5>Pengabdian Masyarakat</h5>
                      <ul class="list-links">
                        <div id="grad1"></div>
                        <li><a href="#">Pengabdian Teknologi Inovatif </a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Pengabdian Berkelanjutan</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Pengabidan Terapan</a></li>
                        <div id="grad1"></div>

                      </ul>

                    </div><!-- /col -->

                    <div class="col-sm-3 col-md-3">

                      <img src="<?= base_url(); ?>assets/portal_akademik/img/riset.jpg">

                    </div><!-- /col -->


                  </div><!-- /row -->
                </div><!-- /dropdown-container -->

              </li>
              <li class="dropdown dropdown-megamenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kemahasiswaan</a>

                <div class="dropdown-container">
                  <div class="row">

                    <div class="col-sm-3">

                      <h5>unit kegiatakan mahasiswa (UKM)</h5>
                      <ul class="list-links">
                        <div id="grad1"></div>
                        <li><a href="#">Blue Murder</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Information Technology Center </a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Pramuka</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Data Science Community</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Landing Programming</a></li>
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
                            <div id="grad1"></div>
                            <li><a href="prodi.html">Monitoring Skripsi</a></li>


                          </ul>

                        </div>
                      </div>


                    </div><!-- /col -->

                    <div class="col-sm-3">

                      <h5>Prestasi Mahasiswa</h5>
                      <ul class="list-links">
                        <div id="grad1"></div>
                        <li><a href="#">Prestasi International</a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Prestasi Nasional </a></li>
                        <div id="grad1"></div>
                        <li><a href="#">Prestasi Regional</a></li>
                        <div id="grad1"></div>
                      </ul>


                      <!-- /col -->
                    </div><!-- /col -->

                    <div class="col-sm-3">
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/img1.jpg" alt="">
                    </div><!-- /col -->

                    <div class="col-sm-3">
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/itc.jpg" alt="">
                    </div><!-- /col -->





                  </div><!-- /row -->
                </div><!-- /dropdown-container -->
              </li>
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
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/stake.png">

                    </div><!-- /col -->

                  </div><!-- /row -->
                </div><!-- /dropdown-container -->

              </li>


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
                      <img src="<?= base_url(); ?>assets/portal_akademik/img/img1.jpg">

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