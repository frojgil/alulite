<section class="content">
<div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Panchayat</h3>
                </div><!-- /.box-header -->
              <!-- place your form controls here -->
                    <form role="form" id="panchform" method="POST">
                      <input type="hidden" id="hdaction" name="hdaction" />
                  <div class="box-body">
                      <div class="form-group col-xs-3">
                      <label for="pcode">Panchayat Code</label>
                      <input type="text" class="form-control input-sm" id="pcodetxt" name="pcodetxt" placeholder="Panchayat code">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="pname">Panchayat Name</label>
                      <input type="text" class="form-control input-sm" id="pnametxt" name="pnametxt" placeholder="Panchayat name">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="gpmin">GP Min Value</label>
                      <input type="text" class="form-control input-sm" id="gpmintxt" name="gpmintxt" placeholder="GP Min Value">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="gpmax">GP Max Value</label>
                      <input type="text" class="form-control input-sm" id="gpmaxtxt" name="gpmaxtxt" placeholder="GP Max Value">
                      </div>
                      <div class="form-group col-xs-3">
                      <label for="ptax">P-Tax Amount</label>
                      <input type="text" class="form-control input-sm" id="ptaxtxt" name="ptaxtxt" placeholder="P-Tax Amount">
                      </div>
                      </div>
                      <div class="box-footer">
                         
                    <input type="submit" class="btn btn-primary" id="btnSubmit" value="Save" />
                    &nbsp;&nbsp;&nbsp;<label id="loader" style="display:none;color:green"><i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>Saving Record</label>
                    &nbsp;&nbsp;&nbsp;<label id="errlbl" ></label>
                      </div>
    
                    </form>
                    <!-- form controls end here -->
              </div>
            </section>

<script type="text/javascript">
 $(document).ready(function(){
        
        $("#panchform").on('submit',function(e){

          e.preventDefault();

          console.log("ajx enter");

         $("#loader").show();  

            if ($("#pcodetxt").val() !=="" && $("#pnametxt").val() !=="" && $("#gpmintxt").val() !=="" && $("#gpmaxtxt").val() !=="" && $("#ptaxtxt").val() !=="") {


                 if($("#btnSubmit").val() == "Save"){

                    $("#hdaction").val("save");
                  }
                  else{

                    $("#hdaction").val("update");
                  }


                 $.ajax({
                        url:"../views/commonview.php",
                        type:"POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        crossDomain: true,
                        cache:false,
                        success: function(data)
                        {
                          console.log(data.result);
                          $("#loader").hide();
                          var admsg = new SpeechSynthesisUtterance('data added successfuly');
                          admsg.pitch = 0.5;
                          admsg.rate = 1;
                          window.speechSynthesis.speak(admsg);
                          $("#errlbl").html(data.result);
                          $("#errlbl").css('color','green');
                          reloadForm();
                          },
                        error : function(jqXHR, textStatus, errorThrow){

                            $("#loader").hide();
                            var admsg = new SpeechSynthesisUtterance('Error has been deducted');
                            admsg.pitch = 0.5;
                            admsg.rate = 1;
                            window.speechSynthesis.speak(admsg);
                            $("#errlbl").html("Error While Adding Data");
                            $("#errlbl").css('color','red'); 
                            console.log("Error status" + textStatus + " " + errorThrown);

                        }

            });

            }
            else{
              $("#loader").hide();
              $("#errlbl").html("Please enter the required fields");
              $("#errlbl").css('color','red');
               var admsg = new SpeechSynthesisUtterance('Please make sure too fill the required fields');
                admsg.pitch = 0.5;
                admsg.rate = 1;
                window.speechSynthesis.speak(admsg); 
            }    

          });
      });


  function reloadForm(){
       $("#divload").load('panchayat');
  }


</script>