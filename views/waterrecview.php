<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['waterbilltxt'])) {

            $waterbilltxt = mysql_escape_string($_POST['waterbilltxt']);
            $waterid = mysql_escape_string($_POST['waterid']);
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO water_rec(water_bill)
             VALUES($waterbilltxt);";
            } else {

                $qry = "update water_rec set water_bill=$waterbilltxt where id='$waterid';";
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

            $id = $_POST['id'];
            $output = array();
            $qury = "SELECT * from water_rec where id=$id;";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('id' => $person['id'],
                        'water_bill' => $person['water_bill'],
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

        $id = $_POST['id'];

        $qury = "DELETE FROM water_rec WHERE id='" . $id . "';";

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
