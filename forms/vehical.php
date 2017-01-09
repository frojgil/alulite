<div id="viewvehicaldiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Vehical Loan</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add Vehical Loan">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addvehicalbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehical Loan</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="vehicalviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Remaining Due</th>
                                <th>Remaining Intrest Due</th>
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

            $("#vehicalviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/vehicalview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'bvloanamt'},
                    {mData: 'ibvloanamt'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('vehical');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/vehicaladvview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $.each(data.recordset, function (index, obj) {

                            console.log("ob " + obj.emp_no);
                            $("#empnotxt").val(obj.emp_no);
                            $("#vlnotxt").val(obj.loan_no);
                            $("#vamttxt").val(obj.bvloanamt);
                            $("#noitxt").val(obj.vlremaining_inst);
                            $("#ivamttxt").val(obj.ibvloanamt);
                            $("#inoitxt").val(obj.ivlremaining_inst);
                            $("#viewvehicaldiv").slideUp();
                            $("#addvehicaldiv").show();
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
                        url: "../views/vehicaladvview.php",
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

<div id="addvehicaldiv" style="display:none">
<section class="content">
<div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Vehicle Loan</h3>
                   <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Vehical Loan">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewvehicalbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehical Loan</button>
                    </div>
                </div><!-- /.box-header -->
              <!-- place your form controls here -->
                    <form role="form" method="POST" name="VehicalForm" id="VehicalForm">
                  <div class="box-body">
                      <div class="form-group col-xs-3">
                      <label for="empno">Emp No</label>
                      <input type="text" class="form-control input-sm" id="empnotxt" name="empnotxt" placeholder="Emp. No.">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="vlno">Vehical Loan No</label>
                      <input type="text" class="form-control input-sm" id="vlnotxt" name="vlnotxt" placeholder="Account No">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="vamt" id="vamtlbl">Loan Amount</label>
                      <input type="text" class="form-control input-sm" id="vamttxt" name="vamttxt" placeholder="Advance Amount">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="noi" id="noilbl">No of Installments</label>
                      <input type="text" class="form-control input-sm" value="90" id="noitxt" name="noitxt" placeholder="No of Installments">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="iamt" id="ivamtlbl">Intrest Amount</label>
                      <input type="text" class="form-control input-sm" id="ivamttxt" name="ivamttxt" placeholder="Intrest Amount">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="noi" id=""inoilbl>No of Intrest Installments</label>
                      <input type="text" class="form-control input-sm" id="inoitxt" name="inoitxt" placeholder="No of Installments">
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

        $('#addvehicalbtn').click(function () {
            $("#viewvehicaldiv").slideUp();
            $("#addvehicaldiv").show();
            $("#VehicalForm")[0].reset();
            $("#btnSubmit").val('Save');
        });

        $('#viewvehicalbtn').click(function () {

            console.log("enetered buton");
            $("#addvehicaldiv").slideUp();
            $("#viewvehicaldiv").show();
        });
        $("#VehicalForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");

            $("#loader").show();

            if ($("#empnotxt").val() !== "") {


                if ($("#btnSubmit").val() === "Save"){

                    console.log($("#btnSubmit").val());
                    $("#hdaction").val("save");
                    
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/vehicaladvview.php",
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