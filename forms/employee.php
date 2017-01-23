<div id="viewempdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Employee</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add Employee">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addempbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Employee</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="empviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Official Email</th>
                                <th>Personal Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function () {

            //function LoadData(){
            console.log("entered loaddata");

            $("#empviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/empview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'mob'},
                    {mData: 'oemail'},
                    {mData: 'pemail'},
                    {mData: 'action'}

                ]
            });
            //   }
        });
    </script>
</div>

<div id="addempdiv" style="display:none">
    <?php include('../include/dbconfig.php'); ?>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Add Employee</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Employee">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewempbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Employee</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <form role="form" method="POST" id="EmpForm" name="EmpForm" enctype="multipart/form-data">
                <div class="box-body">
                    <!-- place your form controls here -->

                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li id="emptab" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Employee Profile</a></li>
                                <li class=""><a href="#tab_2" id="alwntab" data-toggle="tab" aria-expanded="false"><i class="fa fa-money"></i> Employee Allowence</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box-body">
                                        <div class="form-group col-xs-3">
                                            <label for="empnotxt">Employee No<span id="empnoerr" style="color:red;font-size:10px"></span></label>
                                            <div class="input-group">
                                                <input type="number" required="required" autocomplete="off" class="form-control input-sm" id="empnotxt" name="empnotxt" placeholder="EmpNo">
                                                <span class="input-group-addon" id="refreshempno" style="display:none"><i class="fa fa-refresh fa-spin"></i></span>
                                                <span class="input-group-addon" id="tickempno" style="color:green;display:none"><i class="fa fa-check"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empnametxt">Employee Name</label>
                                            <input type="text" required="required" class="form-control input-sm" id="empnametxt" name="empnametxt" placeholder="Name">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Designation</label>
                                            <select required="required" class="form-control input-sm" id="empdesgcmb" name="empdesgcmb">
                                                <option value="0">-----Select-----</option>
                                                <?php
                                                $qry = "select * from desig_master;";
                                                $result = mysql_query($qry) or die(mysql_error());
                                                while($desig = mysql_fetch_assoc($result))
                                                {
                                                echo '<option   value="'.$desig['desig_id'].'">'.$desig['desig_name'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Department</label>
                                            <select required="required" class="form-control input-sm" id="empdeptcmb" name="empdeptcmb">
                                                <option value="0">-----Select-----</option>
                                                <?php
                                                $qry = "select * from dept;";
                                                $result = mysql_query($qry) or die(mysql_error());
                                                while($dept = mysql_fetch_assoc($result))
                                                {
                                                echo '<option   value="'.$dept['deptid'].'">'.$dept['deptname'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="bptxt">Basic Pay</label>
                                            <input type="text" class="form-control input-sm" id="empbptxt" name="empbptxt" placeholder="Basic Pay">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empagptxt">AGP</label>
                                            <input type="text" class="form-control input-sm" id="empagptxt" name="empagptxt" placeholder="AGP">
                                        </div>
                                        
                                        <div class="form-group col-xs-3">
                                            <label>Date Of Birth</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input required="required" type="date" id="empdob" name="empdob" class="form-control input-sm" >
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Date Of Join</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input required="required" type="date" id="empdoj" name="empdoj" class="form-control input-sm" >
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Date Of Retirment</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input required="required" type="date" id="empdor" name="empdor" class="form-control input-sm" >
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <br>
                                            <label>
                                                GPF
                                                <input type="radio" name="r3" id="empgpfrd" value="gpf" class="gcp">
                                            </label>&nbsp;&nbsp;
                                            <label>
                                                CPS
                                                <input type="radio" name="r3" id="empcpsrd" value="cps" class="gcp">
                                            </label>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empnametxt">GPF / CPS No</label>
                                            <input required="required" type="text" class="form-control input-sm" id="empgpftxt" name="empgpftxt" placeholder="GPF / CPS No" disabled="disabled">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Bank Name</label>
                                            <select required="required" class="form-control input-sm" id="empbnkcmb" name="empbnkcmb">
                                                <option value="1">Indian Bank</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empbankacntxt">Bank A/C No</label>
                                            <input type="text" class="form-control input-sm" id="empbankacntxt" name="empbankacntxt" placeholder="Bank A/C No">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Salary Fund From</label>
                                            <select class="form-control input-sm" id="empsalfundcmb" name="empsalfundcmb">
                                                <option value="1">Distance</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Panchayat</label>
                                            <select class="form-control input-sm" id="emppanchcmb" name="emppanchcmb">
                                                <option value="1">Kottaiyur</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empphonetxt">Landline No</label>
                                            <input type="text" class="form-control input-sm" id="empphonetxt" name="empphonetxt" placeholder="Landline No with STD code">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empmobtxt">Mobile No</label>
                                            <input required="required" type="text" class="form-control input-sm" id="empmobtxt" name="empmobtxt" placeholder="Mobile No">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empoemailtxt">Official Email</label>
                                            <input type="email" class="form-control input-sm" id="empoemailtxt" name="empoemailtxt" placeholder="Official Email">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="emppemailtxt">Personal Email</label>
                                            <input type="email" class="form-control input-sm" id="emppemailtxt" name="emppemailtxt" placeholder="Personal Email">
                                        </div>

                                        <div class="form-group col-xs-3">
                                            <label for="emppantxt">PAN No</label>
                                            <input type="text" class="form-control input-sm" id="emppantxt" name="emppantxt"  placeholder="PAN No">
                                        </div>

                                        <div class="form-group col-xs-3">
                                            <label for="empadartxt">Aadhaar No</label>
                                            <input type="text" class="form-control input-sm" id="empadartxt" name="empadartxt" placeholder="Aadhaar No">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empphoto">Photo</label>
                                            <input type="file" class="form-control input-sm" id="empphoto" name="empphoto">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Quarters Status</label>
                                            <select class="form-control input-sm" id="empquastacmb" name="empquastacmb">
                                                <option value="0">-----Select-----</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Employee Cadre</label>
                                            <select class="form-control input-sm" id="empcadrcmb" name="empcadrcmb">
                                                <option value="0">-----Select-----</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option> 
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="empperaddrta">Permanent Address</label>
                                            <textarea class="form-control input-sm" id="empperaddrta" name="empperaddrta" rows="3" placeholder="Enter ..."></textarea>
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <label for="empresaddrta">Residential Address</label>
                                            <textarea id="empresaddrta" name="empresaddrta" class="form-control input-sm" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                           <div class="form-group col-xs-6">
                                            <br>
                                            <label>
                                                Administrative Staff
                                                <input type="radio" name="emptyperd" id="empasrd" value="1">
                                            </label>&nbsp;&nbsp;
                                            <label>
                                                Teaching
                                                <input type="radio" name="emptyperd" id="empteachrd" value="2">
                                            </label>&nbsp;&nbsp;
                                            <label>
                                                Temporary
                                                <input type="radio" name="emptyperd" id="emptemprd" value="3">
                                            </label>
                                        </div>
                                        <input type="hidden" id="hdsstatus" name="hdsstatus" value="Y">
                                        <div class="form-group col-xs-2">
                                            <label for="empresaddrta">Salary Status</label>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                                                <label class="onoffswitch-label" for="myonoffswitch">
                                                    <span class="onoffswitch-inner" id="spchk"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-4" id="stopsal" style="display:none">
                                            <label for="empsalaryoff">Reason For Stoping Salary</label>
                                            <textarea id="empsalaryoff" name="empsalaryoff" class="form-control input-sm" rows="3" placeholder="please enter the reason ..."></textarea>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="box-body">
                                        <div class="form-group col-xs-3">
                                            <label>Basic Pay</label>
                                            <input type="text"  class="form-control input-sm" id="empbpalwntxt" disabled="disabled">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>AGP</label>
                                            <input type="text"  class="form-control input-sm" id="empagpalwntxt" disabled="disabled">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empotherpaytxt">Other Pay</label>
                                            <input type="text"  class="form-control input-sm" id="empotherpaytxt" name="empotherpaytxt" placeholder="Other Pay">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empdralwntxt">Dearness Allowance</label>
                                            <input type="text" readonly="readonly"  class="form-control input-sm" id="empdralwntxt" name="empdralwntxt" placeholder="DA">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empadatxt">ADA</label>
                                            <input type="text"  class="form-control input-sm" id="empadatxt" name="empadatxt" placeholder="ADA">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empirtxt">IR</label>
                                            <input type="text"  class="form-control input-sm" id="empirtxt" name="empirtxt" placeholder="IR">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="emphratxt">House Rent Allowance</label>
                                            <input type="text" readonly="readonly"  class="form-control input-sm" id="emphratxt" name="emphratxt" placeholder="HRA">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empmatxt">Medical Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="empmatxt" name="empmatxt" placeholder="Medical Allowance">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empccatxt">City Comp Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="empccatxt" name="empccatxt" placeholder="CCA">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empclothtxt">Cloth Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="empclothtxt" name="empclothtxt" placeholder="Cloth Allowance">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empwatxt">Washing Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="empwatxt" name="empwatxt" placeholder="Washing Allowance">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empcatxt">Cash Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="empcatxt" name="empcatxt" placeholder="Cash Allowance">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="emppcatxt">Phy Allowance</label>
                                            <input type="text"  class="form-control input-sm" id="emppcatxt" name="emppcatxt" placeholder="Phy Allowance">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="empwagedytxt">Wage Days</label>
                                            <input type="text"  class="form-control input-sm" id="empwagedytxt" name="empwagedytxt" placeholder="Wage Days">
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div>
                <div class="box-footer">
                    <input type="hidden" id="hdaction" name="hdaction" />
                    <input type="submit" class="btn btn-primary" id="btnSubmit" value="Save" />
                    &nbsp;&nbsp;&nbsp;<label id="loader" style="display:none;color:green"><i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>Saving Record</label>
                    &nbsp;&nbsp;&nbsp;<label id="errlbl" ></label>

                </div>
            </form>

            <!-- form controls end here -->
        </div>
</div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnSubmit").hide();
        $("#alwntab").on('click', function () {
          $("#btnSubmit").show();  
        });
        $("#emptab").on('click', function () {
          $("#btnSubmit").hide();  
        });
      
        $("#empbptxt").on('keyup', function () {
            $("#empbpalwntxt").val($("#empbptxt").val());
        });

        $("#empagptxt").on('keyup', function () {

            $("#empagpalwntxt").val($("#empagptxt").val());
        });
        
        //------------- emp da cal --------------------------------
         $("#alwntab").on('click', function () {
               $.ajax({
                    type: "POST",
                    data: {'mode': 'daratechk'},
                    url: "../views/empmasterview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                       $.each(data.recordset, function (index, obj) {
                        
                        var bp = parseInt($("#empbpalwntxt").val());
                        var gp = parseInt($("#empagpalwntxt").val());
                        var dapay = bp + gp;
                        var da =Math.floor(((bp+gp)*obj.darate/100)/10)*10;
                        $("#empdralwntxt").val(da);
                        if(dapay<5300)
                        {
                        $("#emphratxt").val(240);
                        }
                        else if(dapay>5299 && dapay<6700)
                        {
                        $("#emphratxt").val(300);
                        }
                        else if(dapay>6699 && dapay<8190)
                        {
                        $("#emphratxt").val(360);
                        }
                        else if(dapay>8189 && dapay<9300)
                        {
                        $("#emphratxt").val(440);
                        }
                        else if(dapay>9299 && dapay<10600)
                        {
                        $("#emphratxt").val(540);
                        }
                        else if(dapay>10599 && dapay<11900)
                        {
                        $("#emphratxt").val(640);
                        }
                        else if(dapay>11899 && dapay<13770)
                        {
                        $("#emphratxt").val(760);
                        }
                        else if(dapay>13769 && dapay<14510)
                        {
                        $("#emphratxt").val(880);
                        }
                        else if(dapay>14509 && dapay<16000)
                        {
                        $("#emphratxt").val(1000);
                        }
                        else if(dapay>15999 && dapay<17300)
                        {
                        $("#emphratxt").val(1120);
                        }
                        else if(dapay>17299 && dapay<19530)
                        {
                        $("#emphratxt").val(1240);
                        }
                        else if(dapay>19529 && dapay<20090)
                        {
                        $("#emphratxt").val(1360);
                        }
                        else if(dapay>20089)
                        {
                        $("#emphratxt").val(1400);
                        }
                    });
                    },
                    error: function (jqXHR, textStatus, errorThrow) {
                        $("#errlbl").html("Error While DA Calculating");
                        $("#errlbl").css('color', 'red');
                    }

                });

        });

        // -------------  End employee da cal -------------------------

        // -------------  employee number ajax available check -------------------------

        $("#empnotxt").on('keypress', function () {
            $("#refreshempno").show();
            $("#tickempno").hide();
        });

        $("#empnotxt").on('change', function () {
            if ($("#empnotxt").val() !== "") {



                var empno = $("#empnotxt").val();
                $.ajax({
                    url: "../views/empmasterview.php?mode=empnochk",
                    type: "GET",
                    data: {'empno': empno},
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log(data.result);
                        if (data.status == true) {
                            $("#loader").hide();
                            $("#empnoerr").html(' (Emp No already exists)');
                            $("#empnotxt").val('');
                            $("#empnotxt").css('border-color', 'red');
                            $("#empnoerr").css('color', 'red');
                            $("#empnotxt").focus();
                            var admsg = new SpeechSynthesisUtterance('employee number already exists');
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                        } else
                        {
                            $("#empnoerr").html('');
                            $("#empnotxt").css('border-color', 'green');
                            $("#empnoerr").css('color', 'green');
                            $("#empnoerr").html(' (Emp No available)');
                            $("#refreshempno").hide();
                            $("#tickempno").show();
                            var admsg = new SpeechSynthesisUtterance('employee number is available');
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);


                        }

                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        console.log("Error status" + textStatus + " " + errorThrown);
                        $("#errlbl").html("Error While processing");
                        $("#errlbl").css('color', 'red');
                    }

                });
            }

        });

        // -------------  End employee number ajax available check -------------------------


        // -------------  hidden input  salary status switching value binding function -----

        $("#myonoffswitch").on('click', function () {

            var sstatus = ($("#myonoffswitch").is(':checked') == true) ? "Y" : "N";
            $("#hdsstatus").val(sstatus);

            if ($("#myonoffswitch").is(':checked') != true)
            {
                $("#stopsal").show();
                var admsg = new SpeechSynthesisUtterance('please provide the reason for stopping salary');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            } else
            {
                $("#empsalaryoff").val('');
                $("#stopsal").hide();
            }
        });

        // ------------- End hidden input  salary status switching value binding function -----

        // -------------  Gpf and cps swiching function -----

        $('.gcp').on('click', function () {

            var Ids = $(this).attr('id');
            if (Ids == 'empcpsrd') {

                if ($("#empnotxt").val() == '') {
                    var admsg = new SpeechSynthesisUtterance('Please enter the employee number');
                    admsg.pitch = 0.5;
                    admsg.rate = 1;
                    window.speechSynthesis.speak(admsg);
                    alert("Please enter the employee no.");
                    $("#empcpsrd").attr('checked', false);
                    $('#empgpftxt').attr('disabled', true);
                    $('#empgpftxt').val('');
                } else {

                    $('#empgpftxt').removeAttr('disabled');
                    var empno = $("#empnotxt").val();
                    $('#empgpftxt').val(empno);
                }
            } else {

                $('#empgpftxt').val('');
                $('#empgpftxt').removeAttr('disabled');

            }

        });

        // ------------- End  Gpf and cps swiching function -----

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#EmpForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");

            $("#loader").show();

            if ($("#empnotxt").val() !== "" && $("#empnametxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/empmasterview.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log(data.result);
                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('data added successfuly');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html(data.result);
                        $("#errlbl").css('color', 'green');
                        reloadForm();
                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html("Error While Adding Data");
                        $("#errlbl").css('color', 'red');
                        console.log("Error status" + textStatus + " " + errorThrown);

                    }

                });

            } else {
                $("#loader").hide();
                $("#errlbl").html("Please enter the required fields");
                $("#errlbl").css('color', 'red');
                var admsg = new SpeechSynthesisUtterance('Please make sure too fill the required fields');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }

        });
    });


    function reloadForm() {
        $("#divload").load('employee');
    }


</script>

</div>
<script type="text/javascript">
    $('#addempbtn').click(function () {
        $("#viewempdiv").slideUp();
        $("#addempdiv").show();
        $("#EmpForm")[0].reset();
        $("#btnSubmit").val('Save');
    });

    $('#viewempbtn').click(function () {

        console.log("enetered buton");
        $("#addempdiv").slideUp();
        $("#viewempdiv").show();
    });
</script>
<script type="text/javascript">


    function editAction(id) {

        if (id != "") {

            console.log("ed " + id);

            $.ajax({
                type: "POST",
                data: {'mode': 'edit', 'id': id},
                url: "../views/empmasterview.php",
                crossDomain: true,
                cache: false,
                success: function (data)
                {
                    $.each(data.recordset, function (index, obj) {

                        console.log("ob " + obj.emp_no);
                        $("#empnotxt").val(obj.emp_no);
                        $("#empnametxt").val(obj.empname);
                        $("#empdesgcmb").val(obj.desig_id);
                        $("#empdeptcmb").val(obj.dept_id);
                        $("#empbpcmb").val(obj.basic_pay);
                        $("#empagpcmb").val(obj.grade_pay);
                        $("#empdob").val(obj.dob);
                        $("#empdoj").val(obj.join_date);
                        $("#empdor").val(obj.dor);
                        $("#empbnkcmb").val(obj.bank_id);
                        $("#empbankacntxt").val(obj.bank_ac_no);
                        $("#emppanchcmb").val(obj.panchayath_id);
                        /* 
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);
                         $("#empnametxt").val(obj.empname);*/

                    });


                    $("#btnSubmit").val("Update");
                    $("#viewempdiv").slideUp();
                    $("#addempdiv").show();
                    $("#loader").hide();
                    var admsg = new SpeechSynthesisUtterance('data is ready to edit');
                    admsg.pitch = 0.5;
                    admsg.rate = 1;
                    window.speechSynthesis.speak(admsg);
                },
                error: function (jqXHR, textStatus, errorThrow) {

                    $("#loader").hide();
                    var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                    admsg.pitch = 0.5;
                    admsg.rate = 1;
                    window.speechSynthesis.speak(admsg);
                    $("#errlbl").html("Error While Adding Data");
                    $("#errlbl").css('color', 'red');
                    console.log("Error status" + textStatus + " " + errorThrown);

                }

            });


        }
    }


    function removeRow(id) {


        if (confirm("Are you sure to delete data ?")) {

            if (id != "") {


                $.ajax({
                    url: "../views/empmasterview.php",
                    type: "POST",
                    data: {'mode': 'del', 'id': id},
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log(data.result);
                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('data removed successfuly');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html(data.result);
                        $("#errlbl").css('color', 'green');
                        reloadForm();
                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html("Error While Adding Data");
                        $("#errlbl").css('color', 'red');
                        console.log("Error status" + textStatus + " " + errorThrown);

                    }

                });

            }

        }



    }

</script>
