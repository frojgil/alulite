<div>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Pay Proccess</h3>
            </div><!-- /.box-header -->
            <div>
                <div class="box-body">
    <form method="POST" id="PayForm" name="PayForm"> 
        <input type="submit" value="Click to process the pay" class="btn btn-success" id="pay" name="pay"/>
        &nbsp;&nbsp;&nbsp;<label id="loader" style="display:none;color:green"><i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>Saving Record</label>
                    &nbsp;&nbsp;&nbsp;<label id="errlbl" ></label>
                    </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#PayForm").on('submit', function (e) {

            e.preventDefault();

            console.log("ajx enter");
            $.ajax({
                url: "../views/payview.php",
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

        });
    });
</script>
