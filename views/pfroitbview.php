<?php

include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "SELECT * from pf_intrest_rate";
$result = mysql_query($query) or die(mysql_error());
while($intrest = mysql_fetch_array($result)){  
    $fmn = $intrest['from_month'];
    $fmn_str = date("F,Y",strtotime($fmn));
    $tmn = $intrest['to_month'];
    $tmn_str = date("F,Y",strtotime($tmn));
 $output[] =
array('id'=>$intrest['id'],'fmn'=>$fmn_str,'tmn'=>$tmn_str,'pfroi'=>$intrest['intrest_percent'].' %',
'action'=>'<a href="javascript:editAction(' . $intrest['id']
. ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $intrest['id']
. ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');

                }

                $results = array("sEcho"=>1,
                				"iTotalRecords"=>count($output),
                				"iTotalDisplayFRecords"=> count($output),
                				"aaData"=> $output);

                echo json_encode($results);
                
                
                
                
                
 ?>
