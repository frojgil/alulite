<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {

            $empnotxt = FixNull($_POST['empnotxt']);
            $vlnotxt = FixNull($_POST['vlnotxt']);
            $namttxt = FixNull($_POST['vamttxt']);
            $noitxt = FixNull($_POST['noitxt']);
            $ivamttxt = FixNull($_POST['ivamttxt']);
            $inoitxt = FixNull($_POST['inoitxt']);
            $date = date("Y-m-d", strtotime("+5 hours 30 minutes"));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO vehical_adv(emp_no,loan_no,vloanamt,bvloanamt,vltotal_inst,vlremaining_inst,ivloanamt,ibvloanamt,ivltotal_inst,ivlremaining_inst,loan_date)
             VALUES('$empnotxt',$vlnotxt,$namttxt,$namttxt,$noitxt,$noitxt,$ivamttxt,$ivamttxt,$inoitxt,$inoitxt,'$date');";
            } else {

                $qry = "update vehical_adv set bvloanamt=$vamttxt,vlremaining_inst=$noitxt,ibvloanamt=$ivamttxt,ivlremaining_inst=$inoitxt where emp_no='$empnotxt';";
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
function FixNull($param){

        if(empty($param) || $param == ""){

            return "NULL";
        }
        return $param;
    }
if ($_SERVER['REQUEST_METHOD'] == "POST") {



    if (isset($_POST['mode']) && $_POST['mode'] == "edit") {


        if (isset($_POST['id'])) {

            $emid = $_POST['id'];
            $output = array();
            $qury = "SELECT * FROM vehical_adv as v INNER JOIN emp_master as e ON e.emp_no = v.emp_no WHERE v.emp_no='" . $emid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('emp_no' => $person['emp_no'],
                        'loan_no' => $person['loan_no'],
                        'bvloanamt' => $person['bvloanamt'],
                        'vlremaining_inst' => $person['vlremaining_inst'],
                        'ibvloanamt' => $person['ibvloanamt'],
                        'ivlremaining_inst' => $person['ivlremaining_inst'],
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

        $qury = "DELETE FROM vehical_adv WHERE emp_no='" . $emid . "';";

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

