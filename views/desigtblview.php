<?php
include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "select * from Desig_master;";
$result = mysql_query($query) or die(mysql_error());
while($person = mysql_fetch_array($result)){                   
 $output[] =
array('id'=>$person['id'],
    'desig_id'=>$person['desig_id'],
    'desig_name'=>$person['desig_name'],
    'action'=>'<a href="javascript:editAction(' . $person['id']. ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $person['id']
. ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');

                }

                $results = array("sEcho"=>1,
                				"iTotalRecords"=>count($output),
                				"iTotalDisplayFRecords"=> count($output),
                				"aaData"=> $output);

                echo json_encode($results);
 ?>




