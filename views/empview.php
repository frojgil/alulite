<?php

				include('../include/dbconfig.php');
      			session_start();

            $output = array();         $query = "SELECT
emp_no,name,mobile_no,official_email,personal_email FROM emp_master";
$result = mysql_query($query) or die(mysql_error());
while($person = mysql_fetch_array($result)){                   $output[] =
array('emp_no'=>$person['emp_no'],
'name'=>$person['name'],
'mob'=>$person['mobile_no'],
'oemail'=>$person['official_email'],
'pemail'=>$person['personal_email'],
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