<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {

            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $itaxamttxt = mysql_escape_string($_POST['itaxamttxt']);
            $eitaxamtjtxt = mysql_escape_string($_POST['eitaxamtjtxt']);
            $eitaxamtftxt = mysql_escape_string($_POST['eitaxamtftxt']);
            $eitaxamtmtxt = mysql_escape_string($_POST['eitaxamtmtxt']);
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO itax_master(emp_no,itaxamt,ejanitaxamt,efebitaxamt,emaritaxamt)
             VALUES('$empnotxt',$itaxamttxt,$eitaxamtjtxt,$eitaxamtftxt,$eitaxamtmtxt);";
            } else {

                $qry = "update itax_master set itaxamt=$itaxamttxt,ejanitaxamt=$eitaxamtjtxt,efebitaxamt=$eitaxamtftxt,emaritaxamt=$eitaxamtmtxt where emp_no ='$empnotxt';";
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
            $qury = "SELECT * from itax_master as i INNER JOIN emp_master as e ON e.emp_no = i.emp_no WHERE i.emp_no='" . $emid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('emp_no' => $person['emp_no'],
                        'itaxamt' => $person['itaxamt'],
                        'ejanitaxamt' => $person['ejanitaxamt'],
                        'efebitaxamt' => $person['efebitaxamt'],
                        'emaritaxamt' => $person['emaritaxamt'],
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

        $qury = "DELETE FROM itax_master WHERE emp_no='" . $emid . "';";

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
