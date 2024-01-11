<!--Start berita prodi terbaru-->
<section id="slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $aktifPertama = 'active'; ?>
            <?php foreach ($beritaProdiTerbaru as $bpt) : ?>
                <div class="item <?= $aktifPertama; ?>">
                    <div class="slider_overlay">
                        <img src="<?= base_url(); ?>assets/gambarDB/berita/prodi/<?= $bpt->foto ?>" alt="...">
                        <div class="carousel-caption">
                            <div class="slider_text">
                                <h2><?= $bpt->judul; ?></h2>
                                <!-- <?= $bpt->content; ?> -->
                                <br>
                                <a href="<?= base_url(); ?>berita-prodi/<?= $bpt->id; ?>" class="custom_btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $aktifPertama = ''; ?>
            <?php endforeach; ?>


            <!-- <div class="item active">
                <div class="slider_overlay">
                    <img src="<?= base_url(); ?>assets/portal_akademik/img/imgutm.jpg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">
                            <h3>Membangun</h3>
                            <h2>Budaya Teknologi Informasi</h2>
                            <p>Berperadaban dan Berkelanjutan .</p>
                            <a href="" class="custom_btn">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="slider_overlay">
                    <img src="<?= base_url(); ?>assets/portal_akademik/img/img2.jpg" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">
                            <h3>Protect</h3>
                            <h2>nature the environment</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="" class="custom_btn">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="slider_overlay">
                    <img src="<?= base_url(); ?>assets/portal_akademik/img/img4.png" alt="...">
                    <div class="carousel-caption">
                        <div class="slider_text">
                            <h3>Protect</h3>
                            <h2>nature the environment</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="" class="custom_btn">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
        <!--End of Carousel Inner-->
    </div>
</section>
<!--end berita prodi terbaru-->


<!--Start of welcome section-->
<section id="welcome">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wel_header">
                    <h2>Selamat Datang <h2 color="red">di Teknik Informatika UTM</h2>
                    </h2>
                    <p>Our Green Fire Organization is one of the non profit organization near you. Get our services like</p>
                </div>
            </div>
        </div>
        <!--End of row-->
        <div class="row">
            <div class="col-md-4">
                <div class="item">
                    <div class="single_item">
                        <div class="item_list">
                            <div class="welcome_icon">
                                <i class="fa fa-sitemap" aria-hidden="true"></i>
                            </div>
                            <h4>Profile</h4>
                            <!-- <p>Lorem ipsum dolor sit amet, eu qui modo expetendis reformidans ex sit set appetere sententiae seo eum in simul homero.</p> -->
                            <p><?= substr($prodiTif->profile, 0, 200); ?> ...</p>
                            <a href="<?= base_url(); ?>prodi-teknik-informatika/1" class="sarana-link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-3-->
            <div class="col-md-4">
                <div class="item">
                    <div class="single_item">
                        <div class="item_list">
                            <div class="welcome_icon">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                            </div>
                            <h4>Visi Misi</h4>
                            <!-- <p>Lorem ipsum dolor sit amet, eu qui modo expetendis reformidans ex sit set appetere sententiae seo eum in simul homero.</p> -->
                            <p><?= substr($prodiTif->visimisi, 0, 200); ?> ...</p>
                            <a href="<?= base_url(); ?>prodi-teknik-informatika/2" class="sarana-link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-3-->
            <div class="col-md-4">
                <div class="item">
                    <div class="single_item">
                        <div class="item_list">
                            <div class="welcome_icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <h4>Dosen</h4>
                            <p>Dosen adalah gelar akademis dan jabatan di perguruan tinggi atau institusi pendidikan tinggi lainnya. Dosen memiliki tanggung jawab utama dalam memberikan pengajaran, melakukan penelitian, dan memberikan ...</p>
                            <a href="<?= base_url(); ?>prodi-teknik-informatika/3" class="sarana-link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-3-->
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--end of welcome section-->


<!--Start of volunteer-->
<section id="volunteer">
    <div class="container">
        <div class="row vol_area">
            <div class="col-md-8">
                <div class="volunteer_content">
                    <h3>Menjadi <span>Mahasiswa Berprestasi</span></h3>
                    <p>Join Our Team And Help the world. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
            </div>
            <!--End of col-md-8-->
            <div class="col-md-3 col-md-offset-1">
                <div class="join_us">
                    <a href="" class="vol_cust_btn">bergabung kami</a>
                </div>
            </div>
            <!--End of col-md-3-->
        </div>
        <!--End of row and vol_area-->
    </div>
    <!--End of container-->
</section>
<!--end of volunteer-->


<!--Start of portfolio-->
<section id="portfolio" class="text-center">
    <div class="col-md-12">
        <div class="portfolio_title">
            <h2>PROYEK PENELITIAN KAMI</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
        </div>
    </div>
    <!--End of col-md-2-->
    <div class="colum">
        <div class="container">
            <div class="row">
                <form action="/">
                    <ul id="portfolio_menu" class="menu portfolio_custom_menu">

                        <?php
                        $dataFilterKaryaPenelitian = ['.blue', '.red', '.green', '.yellow', '.black'];
                        $dataNoteClass = ['note blue', 'note red', 'note green', 'note yellow', 'note black'];
                        ?>

                        <li>
                            <button data-filter="*" class="my_btn btn_active">Show All</button>
                        </li>
                        <?php foreach ($kategoriPenelitian as $kp) : ?>
                            <?php
                            $i = 0;
                            $dataFilternya = ' ';
                            foreach ($limaKaryaPenelitian as $lkp) {
                                if ($lkp->namakatpen == $kp->namakatpen) {
                                    if ($dataFilternya == ' ') {
                                        $dataFilternya = $dataFilterKaryaPenelitian[$i];
                                    } else {
                                        $dataFilternya = $dataFilternya .  ', ' . $dataFilterKaryaPenelitian[$i];
                                    }
                                }
                                $i++;
                            }
                            ?>
                            <li>
                                <button data-filter="<?= $dataFilternya; ?>" class="my_btn"><?= $kp->namakatpen ?></button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!--End of portfolio_menu-->
                </form>
                <!--End of Form-->
            </div>
            <!--End of row-->
        </div>
        <!--End of container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="notes">
                        <?php $i = 0; ?>
                        <?php foreach ($limaKaryaPenelitian as $lkp) : ?>
                            <div class="<?= $dataNoteClass[$i] ?>">
                                <div class="img_overlay">
                                    <p> <a href="<?= base_url(); ?>karya-penelitian/<?= $lkp->id; ?>"><?= $lkp->namasubkatpen ?></a></p>
                                </div>
                                <img src="<?= base_url(); ?>assets/gambarDB/karya/penelitian/<?= $lkp->foto ?>" alt="">
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                    <!--End of notes-->
                </div>
                <!--End of col-lg-12-->
            </div>
            <!--End of row-->
        </div>
        <!--End of container-->
    </div>
    <!--End of colum-->
</section>
<!--end of portfolio-->







<!--Start of counter-->
<section id="counter">
    <div class="counter_img_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="counter_header">
                        <h2>BIDANG MINAT Keilmuan</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <!--End of col-md-12-->
            </div>
            <!--End of row-->
            <div class="row">
                <?php foreach ($bidangMinat as $bm) : ?>
                    <div class="col-md-3">
                        <div class="counter_item text-center">
                            <div class="sigle_counter_item">
                                <img src="<?= base_url(); ?>assets/gambarDB/bidminat/<?= $bm->foto ?>" alt="">
                                <div class="counter_text">
                                    <p><?= $bm->namabidminat ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--End of row-->
        </div>
        <!--End of container-->
    </div>
</section>
<!--end of counter-->



<!--start of event-->
<section id="event">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="event_header text-center">
                    <h2>Kegiatan-kegiatan TEknik Informatika</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <!--End of row-->
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 zero_mp">
                        <div class="event_item">
                            <div class="event_img">
                                <img src="img/tree_cut_1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 zero_mp">
                        <div class="event_item">
                            <div class="event_text text-center">
                                <a href="">
                                    <h4>One Tree Thousand Hope</h4>
                                </a>
                                <h6>15-16 May in Dhaka</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adip scing elit. Lorem ipsum dolor sit amet,consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="" class="event_btn">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of row-->
                <div class="row">
                    <div class="col-md-6 zero_mp">
                        <div class="event_item">
                            <div class="event_text text-center">
                                <a href="">
                                    <h4>One Tree Thousand Hope</h4>
                                </a>
                                <h6>15-16 May in Dhaka</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adip scing elit. Lorem ipsum dolor sit amet,consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="" class="event_btn">read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 zero_mp">
                        <div class="event_item">
                            <div class="event_img">
                                <img src="img/tree_cut_2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of row-->
            </div>
            <!--End of col-md-8-->
            <div class="col-md-4">
                <div class="event_news">
                    <div class="event_single_item fix">
                        <div class="event_news_img floatleft">
                            <img src="img/tree_cut_3.jpg" alt="">
                        </div>
                        <div class="event_news_text">
                            <a href="#">
                                <h4>Let’s plant 200 tree each...</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="event_news">
                    <div class="event_single_item fix">
                        <div class="event_news_img floatleft">
                            <img src="img/tree_cut_4.jpg" alt="">
                        </div>
                        <div class="event_news_text">
                            <a href="#">
                                <h4>Keep your house envirome..</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="event_news">
                    <div class="event_single_item fix">
                        <div class="event_news_img floatleft">
                            <img src="img/tree_cut_3.jpg" alt="">
                        </div>
                        <div class="event_news_text">
                            <a href="#">
                                <h4>Urgent Clothe Needed Needed</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="event_news">
                    <div class="event_single_item fix">
                        <div class="event_news_img floatleft">
                            <img src="img/tree_cut_4.jpg" alt="">
                        </div>
                        <div class="event_news_text">
                            <a href="#">
                                <h4>One Tree Thousand Hope</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="event_news">
                    <div class="event_single_item fix">
                        <div class="event_news_img floatleft">
                            <img src="img/tree_cut_3.jpg" alt="">
                        </div>
                        <div class="event_news_text">
                            <a href="#">
                                <h4>One Tree Thousand Hope</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-4-->
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--end of event-->



<!--Start of testimonial-->
<section id="testimonial">
    <div class="testimonial_overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial_header text-center">
                        <h2>Apa Kata Alumni</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!--End of row-->
            <section id="carousel">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                                <!-- Carousel indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                                </ol>
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="active item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="profile-circle">
                                                    <img src="img/tree_cut_3.jpg" alt="">
                                                </div>
                                                <div class="testimonial_content">
                                                    <i class="fa fa-quote-left"></i>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                                </div>
                                                <div class="testimonial_author">
                                                    <h5>Sadequr Rahman Sojib</h5>
                                                    <p>CEO, Fourder</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-circle">
                                                    <img src="img/tree_cut_3.jpg" alt="">
                                                </div>
                                                <div class="testimonial_content">
                                                    <i class="fa fa-quote-left"></i>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                                </div>
                                                <div class="testimonial_author">
                                                    <h5>Sadequr Rahman Sojib</h5>
                                                    <p>CEO, Fourder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End of item with active-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="profile-circle">
                                                    <img src="img/tree_cut_3.jpg" alt="">
                                                </div>
                                                <div class="testimonial_content">
                                                    <i class="fa fa-quote-left"></i>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                                </div>
                                                <div class="testimonial_author">
                                                    <h5>Sadequr Rahman Sojib</h5>
                                                    <p>CEO, Fourder</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-circle">
                                                    <img src="img/tree_cut_3.jpg" alt="">
                                                </div>
                                                <div class="testimonial_content">
                                                    <i class="fa fa-quote-left"></i>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                                </div>
                                                <div class="testimonial_author">
                                                    <h5>Sadequr Rahman Sojib</h5>
                                                    <p>CEO, Fourder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--ENd of item-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End of row-->
                </div>
                <!--End of container-->
            </section>
            <!--End of carousel-->
        </div>
    </div>
    <!--End of container-->
</section>
<!--end of testimonial-->



<!--Start of blog-->
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest_blog text-center">
                    <h2>KARYA PENELITIAN MAHASISWA</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo cum libero vitae quos eaque commodi.</p>
                </div>
            </div>
        </div>
        <!--End of row-->
        <div class="row">
            <div class="col-md-4">
                <div class="blog_news">
                    <div class="single_blog_item">
                        <div class="blog_img">
                            <img src="img/climate_effect.jpg" alt="">
                        </div>
                        <div class="blog_content">
                            <a href="">
                                <h3>Climate change is affecting bird migration</h3>
                            </a>
                            <div class="expert">
                                <div class="left-side text-left">
                                    <p class="left_side">
                                        <span class="clock"><i class="fa fa-clock-o"></i></span>
                                        <span class="time">Aug 19, 2016</span>
                                        <a href=""><span class="admin"><i class="fa fa-user"></i> Admin</span></a>
                                    </p>
                                    <p class="right_side text-right">
                                        <a href=""><span class="right_msg text-right"><i class="fa fa-comments-o"></i></span>
                                            <span class="count">0</span></a>
                                    </p>
                                </div>
                            </div>

                            <p class="blog_news_content">Lorem ipsum dolor sit amet, consectetur adipscing elit. Lorem ipsum dolor sit amet, conse ctetur adipiscing elit. consectetur Lorem ipsum dolor sitamet, conse ctetur adipiscing elit. </p>
                            <a href="" class="blog_link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-4-->
            <div class="col-md-4">
                <div class="blog_news">
                    <div class="single_blog_item">
                        <div class="blog_img">
                            <img src="img/air_pollutuon.jpg" alt="">
                        </div>
                        <div class="blog_content">
                            <a href="">
                                <h3>How to avoid indoor air pollution?</h3>
                            </a>
                            <div class="expert">
                                <div class="left-side text-left">
                                    <p class="left_side">
                                        <span class="clock"><i class="fa fa-clock-o"></i></span>
                                        <span class="time">Aug 19, 2016</span>
                                        <a href=""><span class="admin"><i class="fa fa-user"></i> Admin</span></a>
                                    </p>
                                    <p class="right_side text-right">
                                        <a href=""><span class="right_msg text-right"><i class="fa fa-comments-o"></i></span>
                                            <span class="count">0</span></a>
                                    </p>
                                </div>
                            </div>

                            <p class="blog_news_content">Lorem ipsum dolor sit amet, consectetur adipscing elit. Lorem ipsum dolor sit amet, conse ctetur adipiscing elit. consectetur Lorem ipsum dolor sitamet, conse ctetur adipiscing elit. </p>
                            <a href="" class="blog_link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-4-->
            <div class="col-md-4">
                <div class="blog_news">
                    <div class="single_blog_item">
                        <div class="blog_img">
                            <img src="img/threat_bear.jpg" alt="">
                        </div>
                        <div class="blog_content">
                            <a href="">
                                <h3>Threat to Yellowstone’s grizzly bears.</h3>
                            </a>
                            <div class="expert">
                                <div class="left-side text-left">
                                    <p class="left_side">
                                        <span class="clock"><i class="fa fa-clock-o"></i></span>
                                        <span class="time">Aug 19, 2016</span>
                                        <a href=""><span class="admin"><i class="fa fa-user"></i> Admin</span></a>
                                    </p>
                                    <p class="right_side text-right">
                                        <a href=""><span class="right_msg text-right"><i class="fa fa-comments-o"></i></span>
                                            <span class="count">0</span></a>
                                    </p>
                                </div>
                            </div>

                            <p class="blog_news_content">Lorem ipsum dolor sit amet, consectetur adipscing elit. Lorem ipsum dolor sit amet, conse ctetur adipiscing elit. consectetur Lorem ipsum dolor sitamet, conse ctetur adipiscing elit. </p>
                            <a href="" class="blog_link">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-4-->
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!-- end of blog-->



<!--Start of Purches-->
<section id="purches">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="purches_title">Kerja Sama Instansi</h2>
            </div>
            <div class="col-md-2 col-md-offset-4">
                <a href="#" class="purches_btn">Lebih detail</a>

            </div>
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--End of purches-->



<!--Start of Market-->
<section id="market">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="market_area text-center">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="market_logo">
                                <a href=""><img src="img/audiojungle.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="market_logo">
                                <a href=""><img src="img/codecanyon.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="market_logo">
                                <a href=""><img src="img/graphicriver.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="market_logo">
                                <a href=""><img src="img/audiojungle.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <!--End of row-->
                </div>
                <!--End of market Area-->
            </div>
            <!--End of col-md-12-->
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--End of market-->



<!--Start of contact-->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="colmd-12">
                <div class="contact_area text-center">
                    <h3>Lokasi Kami</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <!--End of row-->
        <div class="row">
            <div class="col-md-6">
                <div class="office">
                    <div class="title">
                        <h5>kantor kami</h5>
                    </div>
                    <div class="office_location">
                        <div class="address">
                            <i class="fa fa-map-marker"><span>L. RAYA TELANG PO BOX 2 KAMAL BOX 2, KAMAL, BKL,IND</span></i>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"><span>031-301-141</span></i>
                        </div>
                        <div class="email">
                            <i class="fa fa-envelope"><span>informatika@trunojoyo.ac.id</span></i>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="msg">
                    <div class="msg_title">
                        <h5>Hubungi Kami</h5>
                    </div>
                    <div class="form_area">
                        <!-- CONTACT FORM -->
                        <div class="contact-form wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">
                            <div id="message"></div>
                            <form action="scripts/contact.php" class="form-horizontal contact-1" role="form" name="contactform" id="contactform">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="subject" class="form-control" id="subject" placeholder="Subject *">
                                        <div class="text_area">
                                            <textarea name="contact-message" id="msg" class="form-control" cols="30" rows="8" placeholder="Message"></textarea>
                                        </div>
                                        <button type="submit" class="btn custom-btn" data-loading-text="Loading...">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of col-md-6-->
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--End of contact-->






<?php $this->load->view("prodi_portal/template/footer"); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#namaTitleHeader').html('Teknik Informatika');
    });
</script>
</body>

</html>