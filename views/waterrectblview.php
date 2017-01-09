<?php

include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "SELECT * from water_rec;";
$result = mysql_query($query) or die(mysql_error());
while($waterrec = mysql_fetch_array($result)){  
 $output[] =
array('id'=>$waterrec['id'],'water_bill'=>$waterrec['water_bill'],
'action'=>'<a href="javascript:editAction(' . $waterrec['id']
. ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $waterrec['id']
. ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');

                }

                $results = array("sEcho"=>1,
                				"iTotalRecords"=>count($output),
                				"iTotalDisplayFRecords"=> count($output),
                				"aaData"=> $output);

                echo json_encode($results);
                
                
                
                
                
 ?>
