<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['mode']) && $_POST['mode'] == "da") {

            $output = array();
            $qury = "SELECT * FROM da_rate order by da_date desc limit 1;";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('crnt_da_rate' => $person['crnt_da_rate'],
                    );
                }

                $json = array("status" => true, "recordset" => $output, "result" => "Got Data");
                echo json_encode($json);
                exit;
            } else {

                $json = array("status" => false, "recordset " => "Nil", "result" => "No data found in db");
                echo json_encode($json);
                exit;
            }
    }
}
function FixNull($param){

        if(empty($param) || $param == ""){

            return "0";
        }
        return $param;
    }

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['datxt'])) {

            $darate = mysql_escape_string($_POST['datxt']);
            $olddarate = (FixNull($_POST['olddatxt']));
            $dadate = mysql_escape_string($_POST['dadate']);
            $id = mysql_escape_string($_POST['id']);
            $date = date("Y-m-d", strtotime($dadate));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO da_rate(crnt_da_rate,old_da_rate,da_date)
             VALUES($darate,$olddarate,'$date');";
            } else {

                $qry = "update da_rate set crnt_da_rate=$darate,old_da_rate=$olddarate,da_date='$date' where id='$id';";
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
            $qury = "SELECT * from da_rate where id=$id;";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('crnt_da_rate' => $person['crnt_da_rate'],
                        'old_da_rate' => $person['old_da_rate'],
                        'da_date' => $person['da_date'],
                            'id'=>$person['id']
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

        $qury = "DELETE FROM da_rate WHERE id='" . $id . "';";

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
