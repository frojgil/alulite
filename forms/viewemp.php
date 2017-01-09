<section class="content">
<div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Deductions</h3>
                </div><!-- /.box-header -->
                <div>
                <div class="box-body">
                	<table id="empviewtbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Emp No</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Official Email</th>
                        <th>Personal Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>

                </div>
               </div>
              </div>
            </section>

            <script type="text/javascript">
              $(document).ready(function(){
              	var msg = new SpeechSynthesisUtterance('Processing data');
			      msg.pitch = 0.5;
			      msg.rate = 1;
			      window.speechSynthesis.speak(msg);
                  console.log("entered emp view");
        
			  
			         //function LoadData(){
			         console.log("entered loaddata");

			        $("#empviewtbl").DataTable({

			            "bProcessing":true,
			            "sAjaxSource":"../views/empview.php",
			            "aoColumns":[

			              {mData:'emp_no'},
			              {mData:'name'},
			              {mData:'mob'},
			              {mData:'oemail'},
			              {mData:'pemail'},
			              {mData:'action'}
			            
			                ]
			                   });
                        //   }
                       });
              </script>
