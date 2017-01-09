<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $qry = "SELECT emp_no FROM emp_master where salary_status='Y' ORDER BY emp_no;";
    $rt = mysql_query($qry);
    WHILE ($row = mysql_fetch_array($rt)) {

        //$dt = date("Y-m-d", strtotime("+5 hours 30 minutes"));
        $dt = "2016-08-01";
        $empid = $row['emp_no'];
        //$query1 = "CALL CalculatePolicies('$dt','$empid','LIC'); ";
        //$result1 = mysql_query($query1);
        $query2 = "CALL CalculatePolicies('$dt','$empid','FLV'); ";
        $result2 = mysql_query($query2);
        //$query3 = "CALL CalculatePolicies('$dt','$empid','CLV'); ";
        //$result3 = mysql_query($query3);
          //echo $result3;
        //$query4 = "CALL CalculatePolicies($dt,'$empid','NLV'); ";
        //$result4 = mysql_query($query4);
        //$query5 = "CALL CalculatePolicies($dt,'$empid','VLV'); ";
        //$result5 = mysql_query($query5);
    }
    if ($result2) {
        $json = array("status" => true, "result" => "Salary Proccessing done successfuly");
        echo json_encode($json);
        exit;
    } else {

        $json = array("status" => false, "result" => "$query2");
        echo json_encode($json);
        exit;
    }
}
