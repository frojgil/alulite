<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Deductions</h3>
        </div><!-- /.box-header -->
        <div>
            <div class="box-body">
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenulic();"><b>LIC</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenuthrift();"><b><b>THRIFT</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenunhis();"><b>NHIS</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenucloth();"><b>CLOTH ADVANCE</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenufest();"><b>FESTIVAL ADVANCE</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenuveh();"><b>VEHICLE ADVANCE</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenurbbill();"><b>EB RECOVERY</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenuitax();"><b>I-TAX</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenurel();"><b>RELIEF</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" id="dmenuptax" ><b>P_Tax Processing</b></button>
                <button class="btn bg-olive  btn-flat margin col-xs-3" onclick="dmenuother();"><b>OTHER DEDUCTION</b></button>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $("#dmenuptax").click(function() {

            currentdate = new Date().getMonth() + 1;

            //if ((currentdate == 2) || (currentdate == 8))
            //{

            $.ajax({
                url: "../views/deductionview.php",
                type: "GET",
                data: {'mode': 'gp'},
                crossDomain: true,
                cache: false,
                success: function(data)
                {
                    console.log(data.result);
                    $("#loader").hide();
                    var admsg = new SpeechSynthesisUtterance(data.result);
                    admsg.lang='en-US';
                    admsg.pitch = 1.2;
                    admsg.rate = 1;
                    window.speechSynthesis.speak(admsg);
                    alert(data.result);
                },
                error: function(jqXHR, textStatus, errorThrow) {

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


            /*}
             else
             {
             alert("P_Tax Deduction proccessing is not allowed for this month");
             }*/
        });
    });

</script>