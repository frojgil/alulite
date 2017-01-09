<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['mode']) && $_GET['mode'] == "gp") {



        $getMn = date("m", strtotime("+5 hours 30 minutes"));
        $getYr = date("Y", strtotime("+5 hours 30 minutes"));

        if (($getMn == "02") || ($getMn == "08")) {

            $query = "SELECT * FROM emp_master where salary_status='Y';";
            $rt = mysql_query($query);
            $persons = mysql_num_rows($rt);
            if ($persons > 0) {

                $output = array();

                while ($rows = mysql_fetch_array($rt)) {

                    $panchid = $rows['panchayath_id'];
                    $getDt = date("Y-m-d", strtotime("+5 hours 30 minutes"));

                    $empid = $rows['emp_no'];
                    $qury = "UPDATE salary SET ptax=GetTaxRate('$panchid','$getDt','$empid') "
                            . "WHERE emp_no='$empid' and MONTH(yr_mn) ='$getMn' and YEAR(yr_mn) = '$getYr';";

                    $result = mysql_query($qury);

                    if ($result) {
                        $output[] = array('emp_no' => $rows['emp_no']);
                    }
                }

                $json = array("status" => true, "EmpCount" => $output, "result" => "P Tax Processed successfuly");
                echo json_encode($json);
                exit;
            } else {
                $json = array("status" => false, "result" => "No record found");
                echo json_encode($json);
                exit;
            }
        } else {

            $json = array("status" => false, "result" => "P Tax Deduction proccessing is not allowed for this month");
            echo json_encode($json);
            exit;
        }
    }
}
