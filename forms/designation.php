<div id="viewdesigdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Designation Details </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Designation Details">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="adddesigbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Designation Details</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="desigviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Designation ID</th>
                                <th>Designation Name</th>
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

            $("#desigviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/desigtblview.php",
                "aoColumns": [

                    {mData: 'desig_id'},
                    {mData: 'desig_name'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('designation');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/desigview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $.each(data.recordset, function (index, obj) {
                            $("#idtxt").val(obj.id);
                            $("#desigidtxt").val(obj.desig_id);
                            $("#designametxt").val(obj.desig_name);
                            $("#viewdesigdiv").slideUp();
                            $("#adddesigdiv").show();
                        });

                        $("#btnSubmit").val("Update");
                        //$("#viewempdiv").slideUp();
                        //$("#addempdiv").show();
                        //$("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('data is ready to edit');
                        admsg.pitch = 0.1;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                        admsg.pitch =1;
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
                        url: "../views/desigview.php",
                        type: "POST",
                        data: {mode: 'del', id: id},
                        crossDomain: true,
                        cache: false,
                        success: function (data)
                        {
                            console.log(data.result);
                            $("#loader").hide();
                            var admsg = new SpeechSynthesisUtterance('data removed successfuly');
                            admsg.pitch = 1;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                            $("#errlbl").html(data.result);
                            $("#errlbl").css('color', 'green');
                            reloadForm();
                        },
                        error: function (jqXHR, textStatus, errorThrow) {

                            $("#loader").hide();
                            var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                            admsg.pitch = 1;
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





<div id="adddesigdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Designation Details</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Designation detais">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewdesigbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Designation detais</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="desigForm" name="desigForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="desigid">Designation ID</label>
                        <input type="text" class="form-control input-sm" required="required" id="desigidtxt" name="desigidtxt" placeholder="Dept. ID ">
                    </div>
                    <div class="form-group col-xs-8">
                        <label for="designame">Designation Name</label>
                        <input type="text" class="form-control input-sm" required="required" id="designametxt" name="designametxt" placeholder="Designation Name">
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
        $('#adddesigbtn').click(function () {
            $("#viewdesigdiv").slideUp();
            $("#adddesigdiv").show();
            $("#desigForm")[0].reset();
            $("#btnSubmit").val('Save');
            //$("#famtlbl").html("Amount");
            //$("#noilbl").html("No of Installment");
        });

        $('#viewdesigbtn').click(function () {
            $("#adddesigdiv").slideUp();
            $("#viewdesigdiv").show();
        });

        function reloadForm() {
            $("#divload").load('desig');
        }
        $("#desigidtxt").on('change', function () {
            if ($("#desigidtxt").val() != "")
            {
                var desigid = $("#desigidtxt").val();
                console.log("entered ajax");
                $.ajax({
                    url: "../views/desigview.php?mode=id",
                    type: "GET",
                    data: {'id': id},
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("entered success");
                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance(data.result);
                        admsg.pitch =1;
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
                admsg.pitch =1;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }

        });

        $("#desigForm").on('submit', function (e) {

            e.preventDefault();

            console.log("print enter");
            $("#loader").show();

            if ($("#btnSubmit").val() == "Save") {

                $("#hdaction").val("save");
            } else {

                $("#hdaction").val("update");
            }

            if ($("#desigidtxt").val() !== "") {

                $.ajax({
                    url: "../views/desigview.php",
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
                        admsg.pitch =1;
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
                        admsg.pitch =1;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html("Error While Adding Data");
                        $("#errlbl").css('color', 'red');
                        console.log("Error status" + textStatus + " " + errorThrown);

                    }

                });

            } else {

                var admsg = new SpeechSynthesisUtterance('Please make sure too fill the required fields');
                admsg.pitch =1;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
            }



        });
    });
</script>


