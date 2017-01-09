<?php
include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {

            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $newlonamttxt = mysql_escape_string($_POST['newlonamttxt']);
            $pftype = mysql_escape_string($_POST['pfloantyperd']);
            $emi = mysql_escape_string($_POST['emitxt']);
            $loanamt = mysql_escape_string($_POST['aloantxt']);
            $noi = mysql_escape_string($_POST['noicmb']);
            $loandate = date("Y-m-d", strtotime("+5 hours 30 minutes"));
            $conamt = mysql_escape_string($_POST['newlonamtfinaltxt']);
            $qry = "";
            if ($_POST['hdaction'] == "save"){
                if($pftype=="P")
                {
                $qry = "INSERT INTO pfloan_master(emp_no,loan_amt,inst_amt,total_inst,loan_date,remaining_inst,balance_amt,loan_type,consolidate_amt)
             VALUES('$empnotxt',$loanamt,$emi,$noi,'$loandate',$noi,$loanamt,'$pftype',$conamt);";
                }
                else
                {
                     $qry = "INSERT INTO pfloan_master(emp_no,loan_amt,loan_date,loan_type)
             VALUES('$empnotxt',$newlonamttxt,'$loandate','$pftype');";
                }
                }
             else {

               
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

if (isset($_POST['mode']) && $_POST['mode'] == "del") {


    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        $qury = "DELETE FROM pfloan_master WHERE id='" . $id . "';";

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