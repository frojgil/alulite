<div id="viewlicdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View LIC</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add LIC">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addlicbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add LIC</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="licviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Policy No</th>
                                <th>Policy Amt</th>
                                <th>Policy Premium Amt</th>
                                <th>Remaining Instalment</th>
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

            $("#licviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/lictblview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'policy_no'},
                    {mData: 'pamt'},
                    {mData: 'pcamt'},
                    {mData: 'premaining_inst'},
                    {mData: 'action'}

                ]
            });
            
        });

        function reloadForm() {
            $("#divload").load('lic');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/licview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $("#famtlbl").html("Balance Due");
                        $("#noilbl").html("Remaining Installment");


                        $.each(data.recordset, function (index, obj) {
                            $("#empnotxt").val(obj.emp_no);
                            $("#polnotxt").val(obj.policy_no);
                            $("#polamttxt").val(obj.pamt);
                            $("#polpamttxt").val(obj.pcamt);
                            $("#polopdatetxt").val(obj.po_date);
                            $("#polmdate").val(obj.pm_date);
                            $("#noitxt").val(obj.pmax_inst);
                            $("#idtxt").val(obj.id);
                            $("#viewlicdiv").slideUp();
                            $("#addlicdiv").show();
                        });

                        $("#btnSubmit").val("Update");
                        //$("#viewempdiv").slideUp();
                        //$("#addempdiv").show();
                        //$("#loader").hide();
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
                        url: "../views/licview.php",
                        type: "POST",
                        data: {mode: 'del', id: id},
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
</div>

<div id="addlicdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">LIC</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View LIC">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewlicbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View LIC</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="LicForm" name="LicForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="empno">Emp No</label>
                        <input type="text" class="form-control input-sm" required="required" id="empnotxt" name="empnotxt" placeholder="Emp. No.">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="p1no">Policy No</label>
                        <input type="text" class="form-control input-sm" required="required" id="polnotxt" name="polnotxt" placeholder="Policy No ">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="p1pamt">Policy Amount</label>
                        <input type="text" class="form-control input-sm" required="required" id="polamttxt" name="polamttxt" placeholder="policy amount">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="p1pamt">Policy Premium Amount</label>
                        <input type="text" class="form-control input-sm" id="polpamttxt" name="polpamttxt" placeholder="policy premium amount">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="plopdat">Policy Opening Date</label>
                        <input type="date" class="form-control input-sm" id="polopdatetxt" name="polopdatetxt">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="popdate">Policy Maturity Date</label>
                        <input type="date" class="form-control input-sm" id="polmdate" name="polmdate">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="p1cpno">Total Instalment Number</label>
                        <input type="text" class="form-control input-sm" id="noitxt" name="noitxt" placeholder="Total number of instalment">
                    </div>
                    <input type="hidden" id="idtxt" name="idtxt" />

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
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#addlicbtn').click(function () {
            $("#viewlicdiv").slideUp();
            $("#addlicdiv").show();
            $("#LicForm")[0].reset();
            $("#btnSubmit").val('Save');
            //$("#famtlbl").html("Amount");
            //$("#noilbl").html("No of Installment");
        });

        $('#viewlicbtn').click(function () {
            $("#addlicdiv").slideUp();
            $("#viewlicdiv").show();
        });
        
        function reloadForm() {
            $("#divload").load('lic');
        }
        $("#empnotxt").on('change', function () {
            if ($("#empnotxt").val() != "")
            {
                var empno = $("#empnotxt").val();
                console.log("entered ajax");
                $.ajax({
                    url: "../views/licview.php?mode=empnochk",
                    type: "GET",
                    data: {'empno': empno},
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("entered success");
                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance(data.result);
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        alert(data.result);
                        reloadForm();
                    },
                });

            } else {
                $("#loader").hide();
                $("#errlbl").html("Please enter the employee number");
                $("#errlbl").css('color', 'red');
                var admsg = new SpeechSynthesisUtterance('Please make sure too fill the employee number');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }

        });

        $("#LicForm").on('submit', function (e) {

            e.preventDefault();

            console.log("print enter");
            $("#loader").show();

            if ($("#btnSubmit").val() == "Save") {

                $("#hdaction").val("save");
            } else {

                $("#hdaction").val("update");
            }

            if ($("#empnotxt").val() !== "") {

                $.ajax({
                    url: "../views/licview.php",
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
                        var admsg = new SpeechSynthesisUtterance(data.result);
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        alert('Data added Successfuly');
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

                var admsg = new SpeechSynthesisUtterance('Please make sure too fill the required fields');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }



        });
    });
</script>