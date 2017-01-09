<?php

include('../include/dbconfig.php');
session_start();

$output = array();
$query = "SELECT * from thrift order by sal_month desc;";
$result = mysql_query($query) or die(mysql_error());
while ($person = mysql_fetch_array($result)) {
    $date = date("F-Y", strtotime($person['sal_month']));
    $output[] = array('emp_no' => $person['emp_no'], 'name' => $person['name'], 'total_amt' => $person['total_amt'],
               'sal_month' => $date);
}

$results = array("sEcho" => 1,
    "iTotalRecords" => count($output),
    "iTotalDisplayFRecords" => count($output),
    "aaData" => $output);

echo json_encode($results);
?>