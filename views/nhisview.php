<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['namttxt'])) {

            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $allnhis = mysql_escape_string($_POST['allnhis']);
            $namttxt = mysql_escape_string($_POST['namttxt']);
            $date = date("Y-m-d", strtotime("+5 hours 30 minutes"));
            $qry = "";
          
            if ($_POST['hdaction'] == "save") {
                
                 if($allnhis=="ALLNHIS")
                {
                   $qry="update nhis_adv set nhisamt=$namttxt,nhis_date='$date' where emp_no in(select emp_no from emp_master);";  
                }
                else {
                $qry = "INSERT INTO nhis_adv(emp_no,nhisamt,nhis_date)
             VALUES('$empnotxt',$namttxt,'$date');";
                }
            } else {

                $qry = "update nhis_adv set nhisamt=$namttxt,nhis_date='$date' where emp_no='$empnotxt';";
            }

            mysql_query($qry) or die(mysql_error());
            $json = array("status" => true, "result" => "Data Added Successfuly");
            echo json_encode($json);
          }
        else {

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
            $qury = "SELECT * FROM nhis_adv as n INNER JOIN emp_master as e ON e.emp_no = n.emp_no WHERE n.emp_no='" . $emid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('emp_no' => $person['emp_no'],
                        'nhisamt' => $person['nhisamt'],
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

        $qury = "DELETE FROM nhis_adv WHERE emp_no='" . $emid . "';";

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

