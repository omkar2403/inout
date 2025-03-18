
<footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">
      <ul>
        <li><a href="https://github.com/omkar2403/inout/" target="_blank">In Out Management System</a></li>
        <li><a href="https://www.koha-community.org/" target="_blank">Powered By KOHA Community</a></li>
      </ul>
    </nav>
    <div class="copyright float-right">
      © <script>document.write(new Date().getFullYear())</script>, made with 
      <i class="material-icons" style="color:red;">favorite</i> by 
      <a href="https://omkar2403.github.io/its_me/" target="_blank">Omkar Kakeru</a> for a better web.
    </div>
  </div>
</footer>               
</div>          
</div>

<!-- Core JS -->
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> 
<script src="assets/js/plugins/moment.min.js"></script> 
<script src="assets/js/plugins/sweetalert2.js"></script> 
<script src="assets/js/plugins/jquery.validate.min.js"></script> 
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script> 
<script src="assets/js/plugins/bootstrap-selectpicker.js"></script> 
<script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script> 
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script> 
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script> 
<script src="assets/js/plugins/fullcalendar.min.js"></script> 
<script src="assets/js/plugins/jquery-jvectormap.js"></script> 
<script src="assets/js/plugins/nouislider.min.js"></script> 
<script src="assets/js/core/core.js"></script>
<script src="assets/js/plugins/arrive.min.js"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/material-dashboard.min.js?v=2.0.2" type="text/javascript"></script>

<!-- DateTime Picker and Sliders -->
<script>
  $(document).ready(function(){
    md.initFormExtendedDatetimepickers();
    if ($('.slider').length !== 0) {
      md.initSliders();
    }
  });
</script>

<?php
  // Ensure $table is defined before using it
  if (!empty($table)) {
?>
    <script>
      $(document).ready(function() {
        $('#datatables').DataTable({
          initComplete: function () {
            this.api().columns().every(function () {
              var column = this;
              var select = $('<select><option value="">Show All</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

              column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
            });
          },
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          dom: 'Bfrtip',
          buttons: [
            {
              extend: 'copyHtml5',
              messageTop: printMsg,
              exportOptions: { columns: ':visible' }
            },
            {
              extend: 'excelHtml5',
              messageTop: printMsg,
              exportOptions: { columns: ':visible' }
            },
            {
              extend: 'pdfHtml5',
              messageTop: printMsg,
              exportOptions: { columns: ':visible' }
            },
            'colvis'
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
          },
        });
      });
    </script>
<?php
  }
?>
</body>
</html>
