                <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                <a
                  class="text-primary"
                  href="http://www.iamabdus.com/"
                  target="_blank"
                  >Abdus</a
                >.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>

    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/jekyll-search.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/charts/Chart.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script>
  jQuery(document).ready(function() {
    jQuery('input[name="dateRange"]').daterangepicker({
    autoUpdateInput: false,
    singleDatePicker: true,
    locale: {
      cancelLabel: 'Clear'
    }
  });
    jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
      jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
    });
    jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
      jQuery(this).val('');
    });
  });
</script>
<script src="<?php echo base_url('public/') ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/js/sleek.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="<?php echo base_url('public/') ?>assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script>
  jQuery(document).ready(function() {
    jQuery('#basic-data-table').DataTable({
      "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });
  });
</script>
<script src="<?php echo base_url('public/assets/js/event.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
  </script>

</body>

</html>