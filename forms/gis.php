<div id="viewgisdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View GIS</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Add GIS">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addgisbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add GIS</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="gisviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>GIS Amount</th>
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

            $("#gisviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/gistblview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'gisamt'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('gis');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/gisview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);
                        $.each(data.recordset, function (index, obj) {

                            console.log("ob " + obj.emp_no);
                            $("#empnotxt").val(obj.emp_no);
                            $("#namttxt").val(obj.gisamt);
                            $("#viewgisdiv").slideUp();
                            $("#addgisdiv").show();
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
                        url: "../views/gisview.php",
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



<div id="addgisdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">GIS</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to affect GIS for all employee">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button style="margin-right:12px" type="button" id="allempgisbtn" class="btn btn-danger btn-sm active"><i class="fa fa-group"></i>&nbsp;&nbsp;<i class="fa fa-medkit"></i>&nbsp;&nbsp;Affect GIS for all Employee</button>
                    </div>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View GIS">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewgisbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View GIS</button>
                    </div>   
                </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="GisForm" name="GisForm">
                <div class="box-body">
                    <div class="form-group col-xs-3" id="empnodiv">
                        <label for="empno">Emp No</label>
                        <input type="text" class="form-control input-sm" name="empnotxt" id="empnotxt" placeholder="Emp. No.">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="namt" id="namtlbl">Amount</label>
                        <input type="text" required="required" class="form-control input-sm" name="namttxt" id="namttxt" placeholder="Amount">
                    </div>
                    <input type="hidden" id="allgis" name="allgis" />
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
          $('#allempgisbtn').click(function () {
              $('#empnodiv').hide();
              $("#btnSubmit").val('Save');
              $('#allgis').val("ALLGIS");
          });

        $('#addgisbtn').click(function () {
            $("#viewgisdiv").slideUp();
            $("#addgisdiv").show();
            $('#empnodiv').show();
            $("#GisForm")[0].reset();
            $("#btnSubmit").val('Save');
        });

        $('#viewgisbtn').click(function () {

            console.log("enetered buton");
            $("#addgisdiv").slideUp();
            $("#viewgisdiv").show();
        });
        $("#GisForm").on('submit', function (e) {

            e.preventDefault();

            $("#loader").show();

            if ($("#namttxt").val() !== "") {


                if ($("#btnSubmit").val() === "Save") {

                    console.log($("#btnSubmit").val());
                    $("#hdaction").val("save");

                } else {

                    $("#hdaction").val("update");
                }


                $.ajax({
                    url: "../views/gisview.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        alert(data.result);
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

