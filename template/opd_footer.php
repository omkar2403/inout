      </div>
    </div>

    <script src="assets/opd/jquery-1.10.2.js"></script>
    <script src="assets/opd/bootstrap.min.js"></script>
    <script src="assets/opd/bootstrap-select.js"></script>
    <script>
      $(document).ready(function(){
        // initialise Datetimepicker and Sliders
        md.initFormExtendedDatetimepickers();
        if($('.slider').length != 0){
          md.initSliders();
        }
      });
    </script>
  </body>
</html>