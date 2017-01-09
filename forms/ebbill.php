<div id="viewebbilldiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View EB Bill </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to EB Bill">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addebbillbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add EB Bill</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="ebbillviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp. No.</th>
                                <th>Amount</th>
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

            $("#ebbillviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/ebbilltblview.php",
                "aoColumns": [
                    {mData: 'empno'},
                    {mData: 'amt'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('ebbill');
        }


        function editAction(id) {
            if (id != "") {

                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/ebbillview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {

                        $.each(data.recordset, function (index, obj) {
                            $("#idtxt").val(obj.id);
                            $("#empnotxt").val(obj.empno);
                            $("#amttxt").val(obj.amt);
                            $("#viewebbilldiv").slideUp();
                            $("#addebbilldiv").show();
                        });

                        $("#btnSubmit").val("Update");
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
                        url: "../views/ebbillview.php",
                        type: "POST",
                        data: {mode: 'del', id: id},
                        crossDomain: true,
                        cache: false,
                        success: function (data)
                        {
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




<div id="addebbilldiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">EB Bill</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View EB Bill">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewebbillbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View EB Bill</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="ebbillForm" name="ebbillForm">
                <div class="box-body">
                    
                    <div class="form-group col-xs-3">
                        <label for="empno">Employee No</label>
                        <input type="text" class="form-control input-sm" required="required" id="empnotxt" name="empnotxt" placeholder="Employee No ">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="smt">Amount (Rs)</label>
                        <input type="text" class="form-control input-sm" required="required" id="amttxt" name="amttxt" placeholder="Amount">
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
        $('#addebbillbtn').click(function () {
            $("#viewebbilldiv").slideUp();
            $("#addebbilldiv").show();
            $("#ebbillForm")[0].reset();
            $("#btnSubmit").val('Save');
            //$("#famtlbl").html("Amount");
            //$("#noilbl").html("No of Installment");
        });

        $('#viewebbillbtn').click(function () {
            $("#addebbilldiv").slideUp();
            $("#viewebbilldiv").show();
        });
        
        function reloadForm() {
            $("#divload").load('ebbill');
        }
        $("#empnotxt").on('change', function () {
            if ($("#empnotxt").val() != "")
            {
                var empno = $("#empnotxt").val();
                console.log("entered ajax");
                $.ajax({
                    url: "../views/ebbillview.php?mode=id",
                    type: "GET",
                    data: {'id': id},
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
                $("#errlbl").html("Please enter the department id");
                $("#errlbl").css('color', 'red');
                var admsg = new SpeechSynthesisUtterance('Please make sure too fill the department id');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }

        });

        $("#ebbillForm").on('submit', function (e) {

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
                    url: "../views/ebbillview.php",
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

