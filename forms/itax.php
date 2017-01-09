<div id="viewitaxdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View I-Tax</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add I-Tax">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="additaxbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add I-Tax</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="itaxviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>I-Tax Amount</th>
                                <th>I-Tax Jan Amount</th>
                                <th>I-Tax Feb Amount</th>
                                <th>I-Tax Mar Amount</th>
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
            
            $("#itaxviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/itaxtblview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'itaxamt'},
                    {mData: 'ejanitaxamt'},
                    {mData: 'efebitaxamt'},
                    {mData: 'emaritaxamt'},
                    {mData: 'action'}

                ]
            });
        });
        
         function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/itaxview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        $.each(data.recordset, function (index, obj) {
                            $("#empnotxt").val(obj.emp_no);
                            $("#itaxamttxt").val(obj.itaxamt);
                            $("#eitaxamtjtxt").val(obj.ejanitaxamt);
                            $("#eitaxamtftxt").val(obj.efebitaxamt);
                            $("#eitaxamtmtxt").val(obj.emaritaxamt);
                            $("#viewitaxdiv").slideUp();
                            $("#additaxdiv").show();
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

       function reloadForm() {
            $("#divload").load('itax');
        }
        function removeRow(id) {


            if (confirm("Are you sure to delete data ?")) {

                if (id != "") {
                    $.ajax({
                        url: "../views/itaxview.php",
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

<div id="additaxdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Income Tax Deduction</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View I-Tax">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewitaxbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View I-Tax</button>
                    </div>   
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="ItaxForm" name="ItaxForm">
                <div class="box-body">
                    <div class="form-group col-xs-3" id="empnodiv">
                        <label for="empno">Emp No</label>
                        <input type="text" class="form-control input-sm" name="empnotxt" id="empnotxt" placeholder="Emp. No.">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="namt" id="namtlbl">Income Tax Amount</label>
                        <input type="text" required="required" class="form-control input-sm" name="itaxamttxt" id="itaxamttxt" placeholder="Income Tax Amount">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="namt" id="namtlbl">Excess I-Tax Amount for Janaury</label>
                        <input type="text" required="required" class="form-control input-sm" name="eitaxamtjtxt" id="eitaxamtjtxt" value="0" placeholder="Excess I-Tax Amount for Janaury">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="namt" id="namtlbl">Excess I-Tax Amount for February</label>
                        <input type="text" required="required" class="form-control input-sm" name="eitaxamtftxt" id="eitaxamtftxt" value="0" placeholder="Excess I-Tax Amount for February">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="namt" id="namtlbl">Excess I-Tax Amount for March</label>
                        <input type="text" required="required" class="form-control input-sm" name="eitaxamtmtxt" id="eitaxamtmtxt" value="0" placeholder="Excess I-Tax Amount for March">
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
        
         $('#additaxbtn').click(function () {
            $("#viewitaxdiv").slideUp();
            $("#additaxdiv").show();
            $("#ItaxForm")[0].reset();
            $("#btnSubmit").val('Save');
        });

        $('#viewitaxbtn').click(function () {
            $("#additaxdiv").slideUp();
            $("#viewitaxdiv").show();
        });
       
        $("#ItaxForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");

            $("#loader").show();

            if ($("#empnotxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/itaxview.php",
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