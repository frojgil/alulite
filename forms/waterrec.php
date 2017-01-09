<div id="viewwaterbilldiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Water Bill </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Water Bill">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addwaterbillbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Water Bill</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="waterbilltbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Water Bill</th>
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

            $("#waterbilltbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/waterrectblview.php",
                "aaSorting": [[0, "desc"]],
                "aoColumns": [
                    {mData: 'id'},
                    {mData: 'water_bill'},
                    {mData: 'action'}

                ]
            });
        });

        function reloadForm() {
            $("#divload").load('waterrec');
        }


        function editAction(id) {

            if (id != "") {
                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/waterrecview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {

                        $.each(data.recordset, function (index, obj) {
                            $("#waterid").val(obj.id);
                            $("#waterbilltxt").val(obj.water_bill);
                            $("#viewwaterbilldiv").slideUp();
                            $("#addwaterbilldiv").show();
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
                        url: "../views/waterrecview.php",
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


<div id="addwaterbilldiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Water Bill</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to view Water Bill">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewwaterbillbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Water Bill</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="WaterbillForm" name="WaterbillForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="waterbill">Water Bill</label>
                        <input type="text" required="required" class="form-control input-sm" name="waterbilltxt" id="waterbilltxt" placeholder="Water Bill">
                    </div>
                </div>
                <input type="hidden" id="waterid" name="waterid" />
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

        $('#addwaterbillbtn').click(function () {
            $("#viewwaterbilldiv").slideUp();
            $("#addwaterbilldiv").show();
            $("#WaterbillForm")[0].reset();
            $("#btnSubmit").val('Save');
        });

        $('#viewwaterbillbtn').click(function () {
            $("#addwaterbilldiv").slideUp();
            $("#viewwaterbilldiv").show();
        });
        $("#WaterbillForm").on('submit', function (e) {

            e.preventDefault();
            $("#loader").show();

            if ($("#waterbilltxt").val() !== "") {


                if ($("#btnSubmit").val() == "Save") {

                    $("#hdaction").val("save");
                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/waterrecview.php",
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