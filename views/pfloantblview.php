<?php

include('../include/dbconfig.php');
session_start();

$output = array();
$query = "select
e.emp_no as emp_no,
e.gpf_no as gpf_no,
e.name as name,
pf.id as id,
pf.loan_amt as loan_amt,
pf.loan_date as loan_date,
pf.total_inst as total_inst,
pf.loan_type as loan_type,
pf.remaining_inst as remaining_inst,
pf.balance_amt as balance_amt,
pf.consolidate_amt as consolidate_amt,
d.desig_name as desig_name
from emp_master as e inner join pfloan_master as pf on pf.emp_no=e.emp_no inner join desig_master as d on d.desig_id = e.desig_id order by loan_date desc;";
$result = mysql_query($query) or die(mysql_error());
while ($person = mysql_fetch_array($result)) {
    $output[] = array('emp_no' => $person['emp_no'], 
                        'name' => $person['name'], 
                        'desig_name' => $person['desig_name'],
                        'loan_amt' => $person['loan_amt'],
                        'loan_type' => $person['loan_type'],
                        'loan_date' => $person['loan_date'],
                        'total_inst' => $person['total_inst'],
                        'remaining_inst' => $person['remaining_inst'],
                        'balance_amt' => $person['balance_amt'],
                        'consolidate_amt' => $person['consolidate_amt'],
                        'action' => '<a href="javascript:removeRow(' . $person['id']
                . ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-
color: #b33426; color: #ffffff;">remove</a>');
}

$results = array("sEcho" => 1,
    "iTotalRecords" => count($output),
    "iTotalDisplayFRecords" => count($output),
    "aaData" => $output);

echo json_encode($results);
?>

