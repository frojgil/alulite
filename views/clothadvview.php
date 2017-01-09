<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {

            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $camttxt = mysql_escape_string($_POST['camttxt']);
            $noitxt = mysql_escape_string($_POST['noitxt']);
            $cinstamttxt = mysql_escape_string($_POST['cinstamttxt']);
            $date = date("Y-m-d", strtotime("+5 hours 30 minutes"));
            $fromdate = ($_POST['fdate']);
            $todate = ($_POST['tdate']);
            $fdate = date("Y-m-d",strtotime($fromdate));
            $tdate = date("Y-m-d",strtotime($todate));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO cloth_adv(emp_no,clothamt,balance_due,total_inst,remaining_inst,loan_date,from_date,to_date,inst_amt)
             VALUES('$empnotxt',$camttxt,$camttxt,$noitxt,$noitxt,'$date','$fdate','$tdate',$cinstamttxt);";
            } else {
                $qry = "update cloth_adv set balance_due=$camttxt,remaining_inst=$noitxt,inst_amt=$cinstamttxt,from_date='$fdate',to_date='$tdate' where emp_no='$empnotxt';";
            }

            mysql_query($qry) or die(mysql_error());
            $json = array("status" => true, "result" => "Data Added Successfuly");
            echo json_encode($json);
        } else {

            $json = array("status" => false, "result" => "Error While Adding The Data");
            echo json_encode($json);
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {



    if (isset($_POST['mode']) && $_POST['mode'] == "edit") {


        if (isset($_POST['id'])) {

            $emid = $_POST['id'];
            $output = array();
            $qury = "SELECT * FROM cloth_adv as c INNER JOIN emp_master as e ON e.emp_no = c.emp_no WHERE c.emp_no='" . $emid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('emp_no' => $person['emp_no'],
                        'balance_due' => $person['balance_due'],
                        'remaining_inst' => $person['remaining_inst'],
                        'inst_amt' => $person['inst_amt'],
                        'from_date' => $person['from_date'],
                        'to_date' => $person['to_date']
                    );
                }

                $json = array("status" => true, "recordset" => $output, "result" => "Data Added Sussesfully");
                echo json_encode($json);
                exit;
            } else {

                $json = array("status" => false, "recordset " => "Nil", "result" => "No data found in db");
                echo json_encode($json);
                exit;
            }
        } else {

            $json = array("status" => false, "recordset " => "Nil", "result" => "No data found");
            echo json_encode($json);
            exit;
        }
    }
}


if (isset($_POST['mode']) && $_POST['mode'] == "del") {


    if (isset($_POST['id'])) {

        $emid = $_POST['id'];

        $qury = "DELETE FROM cloth_adv WHERE emp_no='" . $emid . "';";

        $result = mysql_query($qury);
        if ($result) {

            $json = array("status" => true, "result" => "Delete Sussesfully");
            echo json_encode($json);
            exit;
        } else {

            $json = array("status" => false, "result" => "No data found");
            echo json_encode($json);
            exit;
        }
    }
}
