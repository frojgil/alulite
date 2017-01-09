<?php
include('../include/dbconfig.php');
session_start();

            $output = array();        
            $query = "SELECT e.name as name,l.id as id,l.policy_no as policy_no,l.emp_no as emp_no, l.pamt as pamt, l.pcamt as pcamt, l.premaining_inst as premaining_inst from lic_recovery as l inner join emp_master as e on e.emp_no = l.emp_no;";
$result = mysql_query($query) or die(mysql_error());
while($person = mysql_fetch_array($result)){                   
 $output[] =
array('emp_no'=>$person['emp_no'],
    'name'=>$person['name'],
    'policy_no'=>$person['policy_no'],
    'pamt'=>$person['pamt'],
    'pcamt'=>$person['pcamt'],
    'premaining_inst'=>$person['premaining_inst'],
'action'=>'<a href="javascript:editAction(' . $person['id']
. ');" class="btn btn-md
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
