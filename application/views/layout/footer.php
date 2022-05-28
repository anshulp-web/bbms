<!-- jquery vendor -->
<script src="<?php echo base_url() ?>assets/js/lib/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="<?php echo base_url() ?>assets/js/lib/menubar/sidebar.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->

<script src="<?php echo base_url() ?>assets/js/lib/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
<!-- bootstrap -->

<script src="<?php echo base_url() ?>assets/js/lib/calendar-2/moment.latest.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/calendar-2/pignose.init.js"></script>


<script src="<?php echo base_url() ?>assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/weather/weather-init.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/circle-progress/circle-progress.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/circle-progress/circle-progress-init.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/chartist/chartist.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/sparklinechart/sparkline.init.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
<!-- scripit init-->
<script src="<?php echo base_url() ?>assets/js/dashboard2.js"></script>
<!-- jquery validation plugin cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }
</script>
</body>

</html>