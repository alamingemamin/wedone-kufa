                <footer class="footer" style="background: #111222;">
                                    <?php echo date('Y');?> © medu. - medu.com All right reserved
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
         <script
         src="http://code.jquery.com/jquery-3.4.1.min.js"
         integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
         crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
         </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js">
        </script>
        <!-- <script src="../../assets/js/jquery.min.js"></script> -->
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/metisMenu.min.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>
        

        <!-- Flot chart -->
        <!-- <script src="../../../plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.crosshair.js"></script>
        <script src="../../../plugins/flot-chart/curvedLines.js"></script>
        <script src="../../../plugins/flot-chart/jquery.flot.axislabels.js"></script>
  -->
        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="../plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <!-- <script src="../../../plugins/jquery-knob/jquery.knob.js"></script> -->

        <!-- Dashboard Init -->
        <!-- <script src="../../assets/pages/jquery.dashboard.init.js"></script> -->

        <!-- App js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>
        
 
        


        <script type="text/javascript">
          $(document).ready(function(){
             $("#table").dataTable();

        $("#click_icon").click(function(){
           $("#icon").toggleClass("fa-eye-slash");
           $("#icon").toggleClass("text-danger");
          var pass = $("#password");
          if (pass.attr("type") == "password") {
            pass.attr("type","text");
          }else{
            pass.attr("type","password");
          }
        });

        $("#click_icon_c").click(function(){
           $("#cicon").toggleClass("fa-eye-slash");
           $("#cicon").toggleClass("text-danger");
          var cpass = $("#cpassword");
          if (cpass.attr("type") == "password") {
            cpass.attr("type","text");
          }else{
            cpass.attr("type","password");
          }
        });


        $("#nclick_icon").click(function(){
           $("#nicon").toggleClass("fa-eye-slash");
           $("#nicon").toggleClass("text-danger");
          var cpass = $("#npassword");
          if (cpass.attr("type") == "password") {
            cpass.attr("type","text");
          }else{
            cpass.attr("type","password");
          }
        });




        $("tr:odd").mouseenter(function(){
          $(this).css('background','#112244');
        });
        
        $("tr:odd").mouseout(function(){
          $(this).css('background','#112233');
        });
       
        $("#user-change-click").click(function(){
          $("#change-user-photo").toggle(1000);
        });
        
        $("#change-banner-click").click(function(){
          $("#change-banner-photo").toggle(1000);
        });

        $("#change-client-click").click(function(){
          $("#change-client-photo").toggle(1000);
        });

         $("#change-project-click").click(function(){
          $("#change-project-photo").toggle(1000);
        });


        $("input[type='radio']").click(function(){
        var radioValue = $("input[name='tfv']:checked").val();
          if(radioValue == 1){
            $("#tfvemail").show(1000);
          }else{
            $("#tfvemail").hide(1000);
          }
        });
      });
    </script>

    </body>

<!-- Mirrored from coderthemes.com/highdmin/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:51:50 GMT -->
</html>