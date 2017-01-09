<div id="adddarreardiv" >
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">DA Arrear Processing</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View DA Arrear Detais">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewdesigbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View DA Arrear</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="desigForm" name="desigForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <label for="olddarate">Old DA Rate (%)</label>
                        <input type="text" class="form-control input-sm" readonly="readonly" id="olddaratetxt" name="olddaratetxt" placeholder="Old DA Rate ">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="newdarate">New DA Rate (%)</label>
                        <input type="text" class="form-control input-sm" readonly="readonly" id="newdaratetxt" name="newdaratetxt" placeholder="New DA Rate (%)">
                    </div>
                    
                    <div class="form-group col-xs-3">
                        <label for="frmmonth">DA From Month</label>
                        <input type="date" class="form-control input-sm" required="required" id="frmmonth" name="frmmonth" >
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="tomonth">DA To Month</label>
                        <input type="date" class="form-control input-sm" required="required" id="tomonth" name="tommonth" >
                    </div>
                    
                    <input type="hidden" id="idtxt" name="idtxt" />

                </div>
                <div class="box-footer">
                    <input type="hidden" id="hdaction" name="hdaction" />
                    <input type="submit" class="btn btn-primary" id="btnSubmit" value="Generate DA Arrear" />
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
            {

            if (id != "") {

                console.log("ed " + id);$.ajax({
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

        });

        function reloadForm() {
            $("#divload").load('designation');
        }


    </script>