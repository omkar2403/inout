        <footer class="footer">
          <div class="container-fluid">
            <nav class="float-left">
              <ul>
                <li><a href="#">Sai Hospital</a></li>
                <li><a href="#">About Us</a></li>
                <!-- <li><a href="#"></a></li> -->
              </ul>
            </nav>
            <div class="copyright float-right">©<script>document.write(new Date().getFullYear())</script>, made with <i class="material-icons">favorite</i> by
              <a href="#" target="_blank">PLAYTECH</a> for a better web.
            </div>
          </div>
        </footer>               
      </div>          
    </div>

    <!-- Core Js -->
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <!-- Main Js -->
    <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <!-- Scroll Bar -->
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> 
    <!-- Plugin for the momentJs  -->
    <script src="assets/js/plugins/moment.min.js"></script> 
    <!--  Plugin for Sweet Alert -->
    <script src="assets/js/plugins/sweetalert2.js"></script> 
    <!-- Forms Validations Plugin -->
    <script src="assets/js/plugins/jquery.validate.min.js"></script> 
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script> 
    <!--  Plugin for Select, full documentation here: silviomoreto.github.io/bootstrap-select -->
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script> 
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script> 
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <!-- <script src="assets/js/plugins/jquery.dataTables.min.js"></script>  -->
    <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="assets/js/plugins/bootstrap-tagsinput.js"></script> 
    <!-- Plugin for Fileupload, full documentation here: www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script> 
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="assets/js/plugins/fullcalendar.min.js"></script> 
    <!-- Vector Map plugin, full documentation here: jvectormap.com/documentation/ -->
    <script src="assets/js/plugins/jquery-jvectormap.js"></script> 
    <!--  Plugin for the Sliders, full documentation here: refreshless.com/nouislider/ -->
    <script src="assets/js/plugins/nouislider.min.js"></script> 
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="assets/js/core/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="assets/js/plugins/arrive.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <!-- <script async="" defer="" src="assets/core/buttons.js"></script> -->
    <!-- Chartist JS -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <!-- <script src="assets/js/material-dashboard.js?v=2.0.2" type="text/javascript"></script> -->
    <script src="assets/js/material-dashboard.min.js?v=2.0.2" type="text/javascript"></script>
    <!-- Sharrre libray -->
    <!-- <script src="assets/demo/jquery.sharrre.js"></script> -->
    <!-- DATE TIME PICKER AND SLIDERS -->
    <script>
      $(document).ready(function(){
        // initialise Datetimepicker and Sliders
        md.initFormExtendedDatetimepickers();
        if($('.slider').length != 0){
          md.initSliders();
        }
      });
    </script>

    <?php
      if($table){
    ?>
        <script>
          $(document).ready(function() {
            $('#datatables').DataTable({
              initComplete: function () {
                    this.api().columns().every( function () {
                      var column = this;
                      var select = $('<select><option value="">Show All</option></select>')
                          .appendTo( $(column.footer()).empty() )
                          .on( 'change', function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );
       
                              column
                                  .search( val ? '^'+val+'$' : '', true, false )
                                  .draw();
                          } );
       
                      column.data().unique().sort().each( function ( d, j ) {
                          select.append( '<option value="'+d+'">'+d+'</option>' )
                      } );
                  } );
              },
              "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
              ],
              dom: 'Bfrtip',
              buttons: [
                
                    {
                        extend: 'copyHtml5',
                        messageTop: printMsg,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                      extend: 'excelHtml5',
                      messageTop: printMsg,
                      exportOptions: {
                          columns: ':visible'
                      }
                    },
                    {
                      extend: 'pdfHtml5',
                      messageTop: printMsg,
                      exportOptions: {
                          columns: ':visible'
                      }
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