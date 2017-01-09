<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['deptidtxt'])) {
            $id = mysql_escape_string($_POST['idtxt']);
            $deptidtxt = mysql_escape_string($_POST['deptidtxt']);
            $deptnametxt = mysql_escape_string(strtoupper($_POST['deptnametxt']));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO dept(deptid,deptname)
             VALUES('$deptidtxt','$deptnametxt');";
            } else {

                $qry = "update dept set deptid='$deptidtxt',deptname='$deptnametxt' where id=$id;";
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

            $deptid = $_POST['id'];
            $output = array();
            $qury = "SELECT * FROM dept WHERE id='" . $deptid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('id' => $person['id'],
                        'deptid' => $person['deptid'],
                        'deptname' => $person['deptname']
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

        $deptid = $_POST['id'];

        $qury = "DELETE FROM dept WHERE id='" . $deptid . "';";

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