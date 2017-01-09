<div id="viewdaratetdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View DA Rate </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to DA Rate">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="adddaratebtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add DA Rate</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="daratetbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Old DA Rate %</th>
                                <th>Current DA Rate %</th>
                                <th>DA Anounced Date</th>
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

            $("#daratetbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/daratetblview.php",
                "aaSorting": [[ 0, "desc" ]],
                "aoColumns": [
                    {mData: 'old_da_rate'},
                    {mData: 'crnt_da_rate'},
                    {mData: 'da_date'},
                    {mData: 'action'}

                ]
            });
        });

        function reloadForm() {
            $("#divload").load('darate');
        }


        function editAction(id) {

            if (id != "") {
                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/darateview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {

                        $.each(data.recordset, function (index, obj) {
                            $("#daid").val(obj.id);
                            $("#olddatxt").val(obj.old_da_rate);
                            $("#datxt").val(obj.crnt_da_rate);
                            $(".dadate").val(obj.da_date);
                            $("#viewdaratetdiv").slideUp();
                            $("#adddaratediv").show();
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
                        url: "../views/darateview.php",
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


<div id="adddaratediv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">DA Rate</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to view DA Rate">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewdaratebtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View DA Rate</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="DarateForm" name="DarateForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="olddalbl" id="olddalbl">Old DA Rate(%)</label>
                        <div class="input-group">
                        <input type="text" readonly="readonly" class="form-control input-sm" name="olddatxt" id="olddatxt" placeholder="Old DA Rate">
                        <span class="input-group-addon" style="color:green;"><b>%</b></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="dalbl" id="dalbl">DA Rate(%)</label>
                        <div class="input-group">
                        <input type="text" required="required" class="form-control input-sm" name="datxt" id="datxt" placeholder="DA Rate">
                        <span class="input-group-addon" style="color:green;"><b>%</b></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="date" id="dadate">DA Announced Date</label>
                        <input type="date" required="required" class="form-control input-sm dadate" id="dadate"  name="dadate">
                    </div>
                </div>
                <input type="hidden" id="daid" name="id" />
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

        $('#adddaratebtn').click(function () {
            $("#viewdaratetdiv").slideUp();
            $("#adddaratediv").show();
            $("#DarateForm")[0].reset();
            $("#btnSubmit").val('Save');
             $.ajax({
                    type: "POST",
                    data: {'mode': 'da'},
                    url: "../views/darateview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        $.each(data.recordset, function (index, obj) {
                            $("#olddatxt").val(obj.crnt_da_rate);
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html("Error has been deducted");
                        $("#errlbl").css('color', 'red');
                        console.log("Error status" + textStatus + " " + errorThrown);

                    }

                });
        });

        $('#viewdaratebtn').click(function () {
            $("#adddaratediv").slideUp();
            $("#viewdaratetdiv").show();
        });
        $("#DarateForm").on('submit', function (e) {

            e.preventDefault();
            $("#loader").show();

            if ($("#datxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/darateview.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
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

