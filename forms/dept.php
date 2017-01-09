<div id="viewdeptdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Department </h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Department">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="adddeptbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Department</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="deptviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Dept ID</th>
                                <th>Department Name</th>
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

            $("#deptviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/depttblview.php",
                "aoColumns": [

                    {mData: 'deptid'},
                    {mData: 'deptname'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('dept');
        }


        function editAction(id) {

            if (id != "") {

                console.log("ed " + id);


                $.ajax({
                    type: "POST",
                    data: {'mode': 'edit', 'id': id},
                    url: "../views/deptview.php",
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log("rec " + data.status);

                        $.each(data.recordset, function (index, obj) {
                            $("#idtxt").val(obj.id);
                            $("#deptidtxt").val(obj.deptid);
                            $("#deptnametxt").val(obj.deptname);
                            $("#viewdeptdiv").slideUp();
                            $("#adddeptdiv").show();
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
                        url: "../views/deptview.php",
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



<div id="adddeptdiv" style="display:none">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Department</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View Department">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewdeptbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Department</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="deptForm" name="deptForm">
                <div class="box-body">

                    <div class="form-group col-xs-3">
                        <label for="deptid">Department ID</label>
                        <input type="text" class="form-control input-sm" required="required" id="deptidtxt" name="deptidtxt" placeholder="Dept. ID ">
                    </div>
                    <div class="form-group col-xs-8">
                        <label for="deptname">Department Name</label>
                        <input type="text" class="form-control input-sm" required="required" id="deptnametxt" name="deptnametxt" placeholder="Department Name">
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
        $('#adddeptbtn').click(function () {
            $("#viewdeptdiv").slideUp();
            $("#adddeptdiv").show();
            $("#deptForm")[0].reset();
            $("#btnSubmit").val('Save');
            //$("#famtlbl").html("Amount");
            //$("#noilbl").html("No of Installment");
        });

        $('#viewdeptbtn').click(function () {
            $("#adddeptdiv").slideUp();
            $("#viewdeptdiv").show();
        });

        function reloadForm() {
            $("#divload").load('dept');
        }
        $("#deptidtxt").on('change', function () {
            if ($("#deptidtxt").val() != "")
            {
                var deptid = $("#deptidtxt").val();
                console.log("entered ajax");
                $.ajax({
                    url: "../views/deptview.php?mode=id",
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

        $("#deptForm").on('submit', function (e) {

            e.preventDefault();

            console.log("print enter");
            $("#loader").show();

            if ($("#btnSubmit").val() == "Save") {

                $("#hdaction").val("save");
            } else {

                $("#hdaction").val("update");
            }

            if ($("#deptidtxt").val() !== "") {

                $.ajax({
                    url: "../views/deptview.php",
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
