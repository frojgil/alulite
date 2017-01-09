<div id="viewthriftdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View Thrift</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to Upload thrift data">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addthriftbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Click to Upload Thrift Data</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="thriftviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Total Amount</th>
                                <th>Salary Month/Year</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //function LoadData(){
            console.log("entered loaddata");

            $("#thriftviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/thriftview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'total_amt'},
                    {mData: 'sal_month'}

                ]
            });
        });
    </script>


<div id="addthriftdiv" style="display:none">
<section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Thrift Processing</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to view Thrift">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewthriftbtn" class="btn btn-primary btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Thrift</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
                <div class="col-lg-12 col-xs-12" id="caution">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <p><i class="fa fa-warning"></i>&nbsp;&nbsp;Caution!, please verify the thrift file before uppending into the server</p>
                </div>
              </div>
            </div>
            <br>
            <form method="POST" name="frmThrift" id="frmThrift" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="empno">Add Thrift File</label>
                        <input type="file" class="form-control input-sm" name="file" id="file">
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
        
        $('#file').change(function () {
            $("#caution").slideUp();

    });
      
      function reloadForm() {
            $("#divload").load('thrift');
        }
        
        $('#addthriftbtn').click(function () {
            $("#viewthriftdiv").slideUp();
            $("#addthriftdiv").show();
        });

        $('#viewthriftbtn').click(function () {
            $("#addthriftdiv").slideUp();
            $("#viewthriftdiv").show();
        });

        $("#frmThrift").on('submit', function (e) {

            e.preventDefault();
            console.log("ajx enter");
            $("#loader").show();
            if ($("#file").val() !== "") {
                $.ajax({
                    url: "../views/thriftData.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        $("#loader").hide();
                        var admsg = new SpeechSynthesisUtterance('Thrift data uploaded successfuly');
                        admsg.pitch = 0.5;
                        admsg.rate = 1;
                        window.speechSynthesis.speak(admsg);
                        $("#errlbl").html(data.result);
                        $("#errlbl").css('color', 'green');
                        alert("Thrift data uploaded successfuly");
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


