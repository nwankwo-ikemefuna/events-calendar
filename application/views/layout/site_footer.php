                </div>
                <!-- /.col-md-12 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white"><?php echo $this->site_name; ?>. <?php echo date('Y'); ?> </p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Datepicker-->
        <script src="<?php echo base_url(); ?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- Bootstrap Timepicker-->
        <script src="<?php echo base_url(); ?>assets/vendor/timepicker/js/bootstrap-timepicker.min.js"></script>

        <!-- Custom calendar script -->
        <script src="<?php echo base_url(); ?>assets/js/calendar.js"></script>


        <script>
            //pass base_url, current date and current controller to javascript
            var base_url = "<?php echo base_url(); ?>";
            var date_today = "<?php echo date('Y/m/d'); ?>";
            var c_controller = "<?php echo $this->c_controller; ?>";
        </script>

    </body>

</html>
