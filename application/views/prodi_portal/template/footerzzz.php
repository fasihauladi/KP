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





<!--Start of footer-->
<section id="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <div class="copyright">
                    <p>@ 2022 - Teknik Informatika <span><a href="">;</a></span></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="designer">
                    <p>TEKNIK <a href="#">INFORMATIKA</a></p>
                </div>
            </div>
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--End of footer-->



<!--Scroll to top-->
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!--End of Scroll to top-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>-->

<!--Counter UP Waypoint-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/waypoints.min.js"></script>
<!--Counter UP-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/jquery.counterup.min.js"></script>

<script>
    //for counter up
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
</script>

<!--Gmaps-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/gmaps.min.js"></script>
<script type="text/javascript">
    var map;
    $(document).ready(function() {
        map = new GMaps({
            el: '#map',
            lat: 23.6911078,
            lng: 90.5112799,
            zoomControl: true,
            zoomControlOpt: {
                style: 'SMALL',
                position: 'LEFT_BOTTOM'
            },
            panControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            overviewMapControl: false,
            scrollwheel: false,
        });


        map.addMarker({
            lat: 23.6911078,
            lng: 90.5112799,
            title: 'Office',
            details: {
                database_id: 42,
                author: 'Foysal'
            },
            click: function(e) {
                if (console.log)
                    console.log(e);
                alert('You clicked in this marker');
            },
            mouseover: function(e) {
                if (console.log)
                    console.log(e);
            }
        });
    });
</script>

<!-- datatables-->



<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->


<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap.min.js"></script>

<!-- end datatabbles -->

<!--Google Maps API-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjxvF9oTfcziZWw--3phPVx1ztAsyhXL4"></script>


<!--Isotope-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/isotope/min/scripts-min.js"></script>
<script src="<?= base_url(); ?>assets/portal_akademik/js/isotope/cells-by-row.js"></script>
<script src="<?= base_url(); ?>assets/portal_akademik/js/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/portal_akademik/js/isotope/packery-mode.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/portal_akademik/js/isotope/scripts.js"></script>


<!--Back To Top-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/backtotop.js"></script>


<!--JQuery Click to Scroll down with Menu-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/jquery.localScroll.min.js"></script>
<script src="<?= base_url(); ?>assets/portal_akademik/js/jquery.scrollTo.min.js"></script>
<!--WOW With Animation-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/wow.min.js"></script>
<!--WOW Activated-->
<script>
    new WOW().init();
</script>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?= base_url(); ?>assets/portal_akademik/js/bootstrap.min.js"></script>
<!-- Custom JavaScript-->
<script src="<?= base_url(); ?>assets/portal_akademik/js/main.js"></script>


<script src='http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.1/holder.min.js'></script>
<script>
    $(document).ready(function() {
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideDown("400");
                $(this).toggleClass('open');
            }
        );
    });
</script>