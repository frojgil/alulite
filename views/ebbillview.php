<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {
            $id = mysql_escape_string($_POST['idtxt']);
            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $ebbilltxt = mysql_escape_string($_POST['amttxt']);
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO eb_bill(emp_no,eb_bill)
             VALUES('$empnotxt',$ebbilltxt);";
            } else {

                $qry = "update eb_bill set emp_no='$empnotxt',eb_bill=$ebbilltxt where id=$id;";
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

            $ebbilid = $_POST['id'];
            $output = array();
            $qury = "SELECT * FROM eb_bill WHERE id='" . $ebbilid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('id' => $person['id'],
                        'empno' => $person['emp_no'],
                        'amt' => $person['eb_bill'],
                    );
                }

                $json = array("status" => true, "recordset" => $output);
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

        $ebbillid = $_POST['id'];

        $qury = "DELETE FROM eb_bill WHERE id='" . $ebbillid . "';";

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
?>