<div id="viewpfratetdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View PF Intrest </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to PF intrest">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addpfratebtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add PF intrest</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="pfroiviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>From month</th>
                                <th>To month</th>
                                <th>Rate of Intrest</th>
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

            $("#pfroiviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/pfroitbview.php",
                "aoColumns": [

                    {mData: 'id'},
                    {mData: 'fmn'},
                    {mData: 'tmn'},
                    {mData: 'pfroi'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('pfintrestrate');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/pfroiview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $.each(data.recordset, function (index, obj) {
                            $("#id").val(obj.id);
                            $("#fmonth").val(obj.from_month);
                            $("#tmonth").val(obj.to_month);
                            $("#roitxt").val(obj.intrest_percent);
                            $("#viewpfratetdiv").slideUp();
                            $("#addpfratediv").show();
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
                        url: "../views/pfroiview.php",
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

<div id="addpfratediv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">PF Intrest Rate</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to view PF Intrest Rate">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewpfratebtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View PF Intrest Rate</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="IntrateForm" name="IntrateForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="date" id="fmn">From Month</label>
                        <input type="date" required="required" class="form-control input-sm" name="fmonth" id="fmonth">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="date" id="tmn">To Month</label>
                        <input type="date" required="required" class="form-control input-sm" name="tmonth" id="tmonth">
                    </div> 
                    <div class="form-group col-xs-3">
                        <label for="noi" id="noilbl">Rate of intrest (%)</label>
                        <div class="input-group">
                        <input type="text" required="required" class="form-control input-sm" name="roitxt" id="roitxt" placeholder="Rate of intrest">
                        <span class="input-group-addon" id="tickempno" style="color:green;"><b>%</b></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" id="hdaction" name="hdaction" />
                    <input type="hidden" id="id" name="id" />
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

        $('#addpfratebtn').click(function () {
            $("#viewpfratetdiv").slideUp();
            $("#addpfratediv").show();
            $("#IntrateForm")[0].reset();
            $("#btnSubmit").val('Save');
        });

        $('#viewpfratebtn').click(function () {

            console.log("enetered buton");
            $("#addpfratediv").slideUp();
            $("#viewpfratetdiv").show();
        });
        $("#IntrateForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");

            $("#loader").show();

            if ($("#fmonth").val() !== "" && $("#tmonth").val() !== "" && $("#roitxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/pfroiview.php",
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
