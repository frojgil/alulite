<div id="viewfestdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Festival Advance</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add Festival Advance">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addfestbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Festival Advance</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="festviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Remaining Due</th>
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

            $("#festviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/festview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'balance_due'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('festivaladv');
        }


        function editAction(id) {

            if (id != "") {


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/festadvview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $("#famtlbl").html("Balance Due");
                        $("#noilbl").html("Remaining Installment");


                        $.each(data.recordset, function (index, obj) {

                            console.log("ob " + obj.emp_no);
                            $("#empnotxt").val(obj.emp_no);
                            $("#famttxt").val(obj.balance_due);
                            $("#noitxt").val(obj.remaining_inst);
                            $("#finstamttxt").val(obj.inst_amt);
                            $("#tdate").val(obj.to_date);
                            $("#fdate").val(obj.from_date);
                            $("#viewfestdiv").slideUp();
                            $("#addfestdiv").show();
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
                        url: "../views/festadvview.php",
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



<div id="addfestdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Festival Advance</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Festival Advance">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewfestbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Festival Advance</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="FestForm" name="FestForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="empno">Emp No</label>
                        <input type="text" required="required" class="form-control input-sm" name="empnotxt" id="empnotxt" placeholder="Emp. No.">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="famt" id="famtlbl">Amount</label>
                        <input type="text" required="required" class="form-control input-sm" name="famttxt" id="famttxt" placeholder="Advance Amount">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="finstamt" id="famtlbl">Installment Amount</label>
                        <input type="text" required="required" class="form-control input-sm" name="finstamttxt" id="finstamttxt" placeholder="Installment Amount">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="noi" id="noilbl">No of Installments</label>
                        <input type="text" required="required" class="form-control input-sm" name="noitxt" id="noitxt" value="10" placeholder="No of Installments">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="date" id="fdt">From</label>
                        <input type="date" required="required" class="form-control input-sm" name="fdate" id="fdate">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="date" id="tdt">To</label>
                        <input type="Date" required="required" class="form-control input-sm" name="tdate" id="tdate">
                    </div> 
                    

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

        $('#addfestbtn').click(function () {
            $("#viewfestdiv").slideUp();
            $("#addfestdiv").show();
            $("#FestForm")[0].reset();
            $("#btnSubmit").val('Save');
            $("#famtlbl").html("Amount");
            $("#noilbl").html("No of Installment");
        });

        $('#viewfestbtn').click(function () {

            console.log("enetered buton");
            $("#addfestdiv").slideUp();
            $("#viewfestdiv").show();
        });
        $("#FestForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");

            $("#loader").show();

            if ($("#empnotxt").val() !== "" && $("#famttxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/festadvview.php",
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
                        alert("Data Added Successfuly");
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
</script>
