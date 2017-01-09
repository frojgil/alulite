<?php

include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "SELECT * from da_rate;";
$result = mysql_query($query) or die(mysql_error());
while($darate = mysql_fetch_array($result)){  
    $dadate = $darate['da_date'];
    $date = date("d-F-Y",strtotime($dadate));
 $output[] =
array('id'=>$darate['id'],'da_date'=>$date,'crnt_da_rate'=>$darate['crnt_da_rate'].' %','old_da_rate'=>$darate['old_da_rate'].' %',
'action'=>'<a href="javascript:editAction(' . $darate['id']
. ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $darate['id']
. ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');

                }

                $results = array("sEcho"=>1,
                				"iTotalRecords"=>count($output),
                				"iTotalDisplayFRecords"=> count($output),
                				"aaData"=> $output);

                echo json_encode($results);
                
                
                
                
                
 ?>
