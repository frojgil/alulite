<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['desigidtxt'])) {
            $id = mysql_escape_string($_POST['idtxt']);
            $desigidtxt = mysql_escape_string($_POST['desigidtxt']);
            $designametxt = mysql_escape_string(strtoupper($_POST['designametxt']));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO desig_master(desig_id,desig_name)
             VALUES('$desigidtxt','$designametxt');";
            } else {

                $qry = "update desig_master set desig_id='$desigidtxt',desig_name='$designametxt' where id=$id;";
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
            $qury = "SELECT * FROM desig_master WHERE id='" . $id . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('id' => $person['id'],
                        'desig_id' => $person['desig_id'],
                        'desig_name' => $person['desig_name']
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

        $desigid = $_POST['id'];

        $qury = "DELETE FROM desig_master WHERE id='" . $desigid . "';";

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
