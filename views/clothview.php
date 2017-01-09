<?php

include('../include/dbconfig.php');
session_start();

$output = array();
$query = "SELECT e.name as name,c.balance_due as balance_due,c.emp_no as emp_no from cloth_adv as c inner join emp_master as e on e.emp_no = c.emp_no;";
$result = mysql_query($query) or die(mysql_error());
while ($person = mysql_fetch_array($result)) {
    $output[] = array('emp_no' => $person['emp_no'], 'name' => $person['name'], 'balance_due' => $person['balance_due'],
                'action' => '<a href="javascript:editAction(' . $person['emp_no']
                . ');" class="btn btn-md
btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $person['emp_no']
                . ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');
}

$results = array("sEcho" => 1,
    "iTotalRecords" => count($output),
    "iTotalDisplayFRecords" => count($output),
    "aaData" => $output);

echo json_encode($results);
?>