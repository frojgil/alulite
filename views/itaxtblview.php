<?php

include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "SELECT e.name as name,e.emp_no as emp_no,i.id as id,i.itaxamt as itaxamt,i.ejanitaxamt as ejanitaxamt,i.efebitaxamt as efebitaxamt,i.emaritaxamt as emaritaxamt from itax_master as i inner join emp_master as e on e.emp_no = i.emp_no;";
$result = mysql_query($query) or die(mysql_error());
while($person = mysql_fetch_array($result)){                   
 $output[] =
array('emp_no'=>$person['emp_no'],'name'=>$person['name'],'itaxamt'=>$person['itaxamt'],'ejanitaxamt'=>$person['ejanitaxamt'],
    'efebitaxamt'=>$person['efebitaxamt'],'emaritaxamt'=>$person['emaritaxamt'],
'action'=>'<a href="javascript:editAction(' . $person['emp_no']
. ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $person['emp_no']
. ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');

                }

                $results = array("sEcho"=>1,
                				"iTotalRecords"=>count($output),
                				"iTotalDisplayFRecords"=> count($output),
                				"aaData"=> $output);

                echo json_encode($results);
                
                
                
                
                
 ?>