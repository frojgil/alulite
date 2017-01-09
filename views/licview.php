<?php
include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['mode']) && $_GET['mode'] == "empnochk") {

        $empno = $_GET['empno'];
        
        $qry="select count(emp_no) as tot from lic_recovery where emp_no='$empno';";
        $result = mysql_query($qry) or die(mysql_error());
        $lic_count = mysql_fetch_array($result);
        if($lic_count['tot']>=8)
        {
          $json = array("status" => true, "result" => "Sorry! Employee total number of policies are exceeded");
          echo json_encode($json);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['empnotxt'])) {
            $idtxt = mysql_escape_string($_POST['idtxt']);
            $empnotxt = mysql_escape_string($_POST['empnotxt']);
            $polnotxt = mysql_escape_string($_POST['polnotxt']);
            $polamttxt = mysql_escape_string($_POST['polamttxt']);
            $polpamttxt = mysql_escape_string($_POST['polpamttxt']);
            $noitxt= mysql_escape_string($_POST['noitxt']);
            $polopdatetxt = ($_POST['polopdatetxt']);
            $polmdate = ($_POST['polmdate']);
            $podate = date("Y-m-d",strtotime($polopdatetxt));
            $pmdate = date("Y-m-d",strtotime($polmdate));
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO lic_recovery(emp_no,policy_no,pamt,pcamt,pmax_inst,premaining_inst,po_date,pm_date)
             VALUES('$empnotxt','$polnotxt',$polamttxt,$polpamttxt,$noitxt,$noitxt,'$podate','$pmdate');";
            } else {

                $qry = "update lic_recovery set policy_no='$polnotxt',pamt=$polamttxt,pcamt=$polpamttxt,po_date='$podate',pm_date='$pmdate',pmax_inst=$noitxt,premaining_inst=$noitxt where id=$idtxt;";
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

            $licid = $_POST['id'];
            $output = array();
            $qury = "SELECT * FROM lic_recovery as l INNER JOIN emp_master as e ON e.emp_no = l.emp_no WHERE l.id='" . $licid . "';";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($person = mysql_fetch_array($result)) {

                    $output[] = array('emp_no' => $person['emp_no'],
                        'policy_no' => $person['policy_no'],
                        'pamt' => $person['pamt'],
                        'pcamt' => $person['pcamt'],
                        'pmax_inst' => $person['pmax_inst'],
                        'po_date' => $person['po_date'],
                        'pm_date' => $person['pm_date'],
                        'id' => $person['id']
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

        $licid = $_POST['id'];

        $qury = "DELETE FROM lic_recovery WHERE id='" . $licid . "';";

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

