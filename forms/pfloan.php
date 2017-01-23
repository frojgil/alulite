<div id="viewpfdiv">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">View PF Prossesing</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to PF loan">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="addpfbtn" class="btn btn-success btn-sm active"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add PF Loan</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
                    <table id="pfloanviewtbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Loan Amount</th>
                                <th>Loan Type</th>
                                <th>Loan Date</th>
                                <th>No of Instalment</th>
                                <th>Remaining Instalment</th>
                                <th>Balance Amount</th>
                                <th>Consolidate Amount</th>
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

            $("#pfloanviewtbl").DataTable({

                "bProcessing": true,
                "sAjaxSource": "../views/pfloantblview.php",
                "aoColumns": [

                    {mData: 'emp_no'},
                    {mData: 'name'},
                    {mData: 'desig_name'},
                    {mData: 'loan_amt'},
                    {mData: 'loan_type'},
                    {mData: 'loan_date'},
                    {mData: 'total_inst'},
                    {mData: 'remaining_inst'},
                    {mData: 'balance_amt'},
                    {mData: 'consolidate_amt'},
                    {mData: 'action'}

                ]
            });
            //   }
        });

        function reloadForm() {
            $("#divload").load('pfloan');
        }

        function removeRow(id) {


            if (confirm("Are you sure to delete data ?")) {

                if (id != "") {
                    $.ajax({
                        url: "../views/pfloanview.php",
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

<div id="addpfdiv" style="display:none"> 
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">PF Loan / Part Final</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Click to View PF loan">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <button type="button" id="viewpfbtn" class="btn btn-warning btn-sm active"><i class="fa fa-eye"></i>&nbsp;&nbsp;View PF Loan</button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- place your form controls here -->
            <form role="form" method="POST" id="PFloanForm" name="PFloanForm">
                <div class="box-body">
                    <div class="form-group col-xs-3">
                        <br>
                        <label>
                            PF Loan
                            <input type="radio" name="pfloantyperd" id="pfrd" value="P">
                        </label>&nbsp;&nbsp;
                        <label>
                            Part Final
                            <input type="radio" name="pfloantyperd" id="partfinalrd" value="W">
                        </label>
                    </div>
                    <div class="form-group col-xs-3">
                            <label>Eligiblity Percentage</label>
                            <select required="required" class="form-control input-sm" id="elipercmb" name="elipercmb">
                                <option value="75">75 %</option>
                                <option value="90">90 %</option>
                            </select>
                        </div>
                    <div class="form-group col-xs-3">
                        <label for="empno">Emp No</label>
                        <input type="text"  class="form-control input-sm" name="empnotxt" id="empnotxt" placeholder="Emp. No.">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="famt" id="pfacnolbl">PF Ac/No</label>

                        <input type="text" readonly="readonly"  class="form-control input-sm" name="pfacnotxt" id="pfacnotxt" placeholder="PF Ac/No">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="empname" id="empnamelbl">Name</label>
                        <input type="text" readonly="readonly" class="form-control input-sm" name="empnametxt" id="empnametxt" placeholder="Emp Name">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="des" id="deslbl">Designation</label>
                        <input type="text" readonly="readonly" class="form-control input-sm" name="destxt" id="destxt">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="ob" id="oblbl">Opening Balance</label>
                        <input type="text" readonly="readonly" class="form-control input-sm" name="obtxt" id="obtxt">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="slt" id="deslbl">Sub + Loan Rec (Total)</label>
                        <input type="text" readonly="readonly" class="form-control input-sm" name="slttxt" id="slttxt">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="lastloan" id="lastloanlbl">Last Loan Amt</label>
                        <input type="text"  readonly="readonly" class="form-control input-sm" name="lastloantxt" id="lastloantxt">
                    </div>
                    <div class="form-group col-xs-3" id="totinstnodiv">
                        <label for="totinstno" id="totinstnolbl">Total Instalment No</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="totinstnotxt" id="totinstnotxt">
                    </div>
                    <div class="form-group col-xs-3" id="curinstdiv">
                        <label for="curinstno" id="curinstlbl">Current Instalment No</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="curinstnotxt" id="curinstnotxt">
                    </div> 
                    <div class="form-group col-xs-3" id="lonrecdiv">
                        <label for="lonrec" id="lonreclbl">Loan Recovered</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="lonrectxt" id="lonrectxt">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="lonbal" id="lonballbl">Loan Balance</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="lonbaltxt" id="lonbaltxt">
                    </div> 
                    <div class="form-group col-xs-3">
                        <label for="lld" id="lldlbl">Last Loan Date</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="lastloandatetxt" id="lastloandatetxt">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="odb" id="odblbl">On date Balance</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="ondatebaltxt" id="ondatebaltxt">
                    </div>
                    
                    <div class="form-group col-xs-3">
                        <label for="newlonele" id="newlonelelbl" class="blink">New Loan Eligiblity</label>
                        <input type="text"  readonly="readonly"  class="form-control input-sm" name="newloneletxt" id="newloneletxt">
                    </div>
                </div>
                <div class="box box-danger">
                    <div class="box-body">

                        <div class="form-group col-xs-3">
                            <label for="newlonamt" id="newlonamtlbl">Amount Claimed</label>
                            <input type="text" required="required" class="form-control input-sm" name="newlonamttxt" id="newlonamttxt">
                        </div>

                        <div class="form-group col-xs-3" id="noidiv">
                            <label>No of instalment</label>
                            <select required="required" class="form-control input-sm" id="noicmb" name="noicmb">
                                <option value="0">----Select----</option>
                                <option value="36">36</option>
                                <option value="24">24</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-3" id="aldiv">
                            <label for="aloan" id="aloanlbl">Approved Loan</label>
                            <input type="text" readonly="readonly" required="required" class="form-control input-sm" name="aloantxt" id="aloantxt">
                        </div>

                        <div class="form-group col-xs-3" id="conamtdiv">
                            <label for="newlonamtfinal" id="newlonamtfinallbl">Consolidated Amount</label>
                            <input type="text" readonly="readonly" required="required" class="form-control input-sm" name="newlonamtfinaltxt" id="newlonamtfinaltxt">
                        </div>

                        <div class="form-group col-xs-3" id="emidiv">
                            <label for="emi" id="emilbl">EMI</label>
                            <input type="text" readonly="readonly" required="required" class="form-control input-sm" name="emitxt" id="emitxt" placeholder="EMI">
                        </div>

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
        $('#addpfbtn').click(function () {
            $("#viewpfdiv").slideUp();
            $("#addpfdiv").show();
        });

        $('#viewpfbtn').click(function () {

            console.log("enetered buton");
            $("#addpfdiv").slideUp();
            $("#viewpfdiv").show();
        });
        
        $('#partfinalrd').click(function () {
            // $("#PFloanForm")[0].reset();
            // $('#partfinalrd').attr("checked", "true");
            //$('#pfrd').attr("checked", "false");
            $('#newlonelelbl').html("Part Final Eligiblity");
            $('#lonballbl').html("Closing Balance");
            $('#emidiv').hide();
            $('#aldiv').hide();
            $('#noidiv').hide();
            $('#conamtdiv').hide();

        });
        $('#pfrd').click(function () {
            // $("#PFloanForm")[0].reset();
            //$('#partfinalrd').attr("checked", "false");
            //$('#pfrd').attr("checked", "true");
            $('#newlonelelbl').html("New Loan Eligiblity");
            $('#lonballbl').html("Loan Balance");
            $('#emidiv').show();
            $('#aldiv').show();
            $('#noidiv').show();
            $('#conamtdiv').show();
        });

        $("#newlonamttxt").on('keyup', function () {
            if ($("#partfinalrd").is(':checked')) {
               var new_loan = parseInt($('#newlonamttxt').val());
               var loan_balance = parseInt($('#lonbaltxt').val()); 
               $('#newlonamtfinaltxt').val(new_loan+loan_balance);
            }
            
            if ($('#empnotxt').val() == "")
            {
                var admsg = new SpeechSynthesisUtterance('Caution! please enter the employee number');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
                alert("please enter the employee");
                $('#empnotxt').focus();
                $("#empnotxt").css('border-color', 'red');
                $('#newlonamttxt').val("");
            } else
            {
                if (parseInt($('#newlonamttxt').val()) > parseInt($('#newloneletxt').val()))
                {
                    var admsg = new SpeechSynthesisUtterance('Caution! loan amount cannot be greater than elegiblity amount');
                    admsg.pitch = 0.5;
                    admsg.rate = 1;
                    window.speechSynthesis.speak(admsg);
                    alert("New loan amount cannot be greater than elegiblity amount");
                    $('#newlonamttxt').focus();
                    $('#newlonamttxt').val("");
                    $('#newlonamtfinaltxt').val("");

                }
            }
        });
        
        $("#elipercmb").on('change', function () {
           if($("#empnotxt").val()!="")
           {
             reloadForm();
           }
        });

        $("#noicmb").on('change', function () {
            if($("#empnotxt").val()=="")
            {
                var admsg = new SpeechSynthesisUtterance('Caution! please enter the employee number');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
                alert("please enter the employee");
                $('#empnotxt').focus();
                $("#empnotxt").css('border-color', 'red');
                $('#newlonamttxt').val("");
                $("#noicmb").val("0");
            }
            else if($("#newlonamttxt").val()=="")
            {
                var admsg = new SpeechSynthesisUtterance('Caution! please enter the Claimed loan amount');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
                $('#newlonamttxt').focus();
                $('#newlonamttxt').val("");
                $("#noicmb").val("0");
            }
            else
            {
            var new_loan = parseInt($('#newlonamttxt').val());
            var loan_balance = parseInt($('#lonbaltxt').val());
            var noi = parseInt($('#noicmb').val());
            if($('#lonbaltxt').val()!="")
            {
            var emi = Math.floor((((new_loan + loan_balance) / noi)) / 10) * 10;
            }
            else
            {
             var emi = Math.floor((new_loan / noi) / 10) * 10;   
            }
            var nlamt = parseInt(emi) * noi;
            $('#newlonamtfinaltxt').val(nlamt);
            $('#emitxt').val(emi);
            if($('#lonbaltxt').val()!="")
            {
            $('#aloantxt').val((parseInt(emi) * noi) - loan_balance);
            }
            else
            {
             $('#aloantxt').val(parseInt(emi) * noi);
            }
        }

        });

        $("#empnotxt").on('keyup', function () {
            if (!$("[name='pfloantyperd']").is(':checked')) {
                $("#empnotxt").val("");
                var admsg = new SpeechSynthesisUtterance('Please Choose PF or Partfinal');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg);
                alert("Please Choose PF or Partfinal");
            }

        });

        $("#empnotxt").on('change', function () {
            $("#empnotxt").css('border-color', 'green');
            if ($("#empnotxt").val() !== "") {
                var empno = $("#empnotxt").val();
                var loan_type = $('input[name=pfloantyperd]:checked', '#PFloanForm').val()
                $.ajax({
                    url: "../views/pfroiview.php?mode=empnochk",
                    type: "GET",
                    data: {'empno': empno,'loan_type':loan_type},
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        console.log(data.result);
                        if (data.status == true) {
                            $('#pfacnotxt').val(data.pf_no);
                            $('#obtxt').val(data.ob);
                            $('#slttxt').val(data.cumulative);
                            $('#empnametxt').val(data.name);
                            $('#destxt').val(data.desig_name);
                            $('#lastloantxt').val(data.loan_amt);
                            $('#lastloandatetxt').val(data.loan_date);
                            $('#lonbaltxt').val(data.balance_amt);
                            $('#totinstnotxt').val(data.total_inst);
                            $('#curinstnotxt').val(data.remaining_inst);
                            $('#lonrectxt').val(parseInt(data.loan_amt) - parseInt(data.balance_amt));
                            var a = (parseInt(data.ob) + parseInt(data.cumulative)) - (parseInt(data.loan_amt));
                            var per = parseInt($('#elipercmb').val());
                            var b = a * per;
                            $('#newloneletxt').val(b / 100);
                            $(".blink").addClass("blink_me");
                            $('#ondatebaltxt').val(a);
                            var admsg = new SpeechSynthesisUtterance('Getting elegiblity');
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                        } else if(data.loanmode == "Newloan")
                        {
                            var admsg = new SpeechSynthesisUtterance(data.result);
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                            alert(data.result);
                            $('#pfacnotxt').val(data.pf_no);
                            $('#empnametxt').val(data.name);
                            $('#destxt').val(data.desig_name);
                            
                            var a = (parseInt(data.ob) + parseInt(data.cumulative));
                            var per = parseInt($('#elipercmb').val());
                            var b = a * per;
                            $('#newloneletxt').val(b / 100);
                        }
                        else
                        {
                            $("#empnotxt").focus();
                            $("#empnotxt").val("");
                            $("#empnotxt").css('border-color', 'red');
                            var admsg = new SpeechSynthesisUtterance(data.result);
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                            alert(data.result);
                            reloadForm();
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrow) {

                        $("#loader").hide();
                        console.log("Error status" + textStatus + " " + errorThrown);
                        $("#errlbl").html("Error While processing");
                        $("#errlbl").css('color', 'red');
                    }

                });
            }

        });

        function reloadForm() {
            $("#divload").load('pfloan.php');
        }

        $("#PFloanForm").on('submit', function (e) {

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
                    url: "../views/pfloanview.php",
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

                $.ajax({
                    url: "../report/pfloanrep.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    crossDomain: true,
                    cache: false,
                    success: function (data)
                    {
                        setTimeout(function () {
                            var w = window.open('about:blank', 'windowname');
                            w.document.write(data);
                            w.document.close();
                        }, 1000);
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
