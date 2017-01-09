<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Powered By <a href="#">Konfiancesoft</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Alagappa University</a>.</strong> All rights reserved.
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <div class="box-body" >
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Emp NO</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT emp_no,name FROM emp_master";
                        $result = mysql_query($query);
                        While ($person = mysql_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>$person[emp_no]</td>";
                            echo "<td>$person[name]</td>";
                            echo"</tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div><!-- /.box-body -->

        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../dist/js/cloudflare.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.min.js"></script>
<!-- Page script -->
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->

<!-- menu navigation section for deduction -->
<script type="text/javascript">
    function dmenulic() {
        $('#divload').load('lic');
    }
    function dmenuthrift() {
        $('#divload').load('thrift');
    }
    function dmenufest() {
        $('#divload').load('festivaladv');
    }
    function dmenucloth() {
        $('#divload').load('clothadv');
    }
    function dmenuveh() {
        $('#divload').load('vehical');
    }
    function dmenucloth() {
        $('#divload').load('clothadv');
    }
    function dmenunhis() {
        $('#divload').load('nhis');
    }
    function dmenuitax() {
        $('#divload').load('itax');
    }
    function dmenurbbill() {
        $('#divload').load('ebbill');
    }
</script>
<!-- menu navigation section for deduction ends -->


<script>
    $(function () {

        //------------ menu navigation section ---------------
        $('#menuemployee').click(function () {
            $('#divload').load('employee');
        });
        $('#menudeduction').click(function () {
            $('#divload').load('deduction');
        });
        $('#menupanchayat').click(function () {
            $('#divload').load('panchayat');
        });

        $('#menupay').click(function () {
            $('#divload').load('payprocess');
        });
        $('#menugpfloan').click(function () {
            $('#divload').load('pfloan');
        });
        $('#menurateofintrest').click(function () {
            $('#divload').load('pfintrestrate');
        });
        $('#menudarate').click(function () {
            $('#divload').load('darate');
        });
        $('#menuwaterbill').click(function () {
            $('#divload').load('waterrec');
        });
        $('#menupband').click(function () {
            $('#divload').load('payband');
        });
        $('#menudept').click(function () {
            $('#divload').load('dept');
        });

        //------------ menu navigation section End---------------

        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );



        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>

<script>
    $(function () {
        $('#example1').DataTable({
            "searching": true,
            "ordering": false,
            "info": false,
        });
    });
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
