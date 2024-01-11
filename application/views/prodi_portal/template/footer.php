<!--Start of footer-->
<section id="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <div class="copyright">
                    <p>@ 2022 TEKNIK INFORMATIKA <span><a href="">&#9798;</a></span></p>
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

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
    $(document)
        .on('click.bs.dropdown.data-api', '.dropdown', function(e) {
            e.stopPropagation()
        })
</script>