<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['mode']) && $_GET['mode'] == "empnochk") {

        $empno = $_GET['empno'];
        $loan_type = $_GET['loan_type'];
        $date = date("Y", strtotime("+5 hours 30 minutes"));
        $month = date("m", strtotime("+5 hours 30 minutes"));
        $currentdate = date("Y-m-d", strtotime("+5 hours 30 minutes"));
        $output = array();

        if ($empno != "") {
            $query = "select emp_no from emp_master where emp_no='$empno';";
            $result = mysql_query($query);
            if (mysql_num_rows($result) == 0) {
                $json = array("status" => false, "result" => "Employee not available");
                echo json_encode($json);
                exit;
            } else {
                if ($empno !== "") {
                    if ($loan_type == "P") {
                        $query = "SELECT loan_date from pfloan_master where emp_no='$empno' and loan_type='$loan_type' order by loan_date desc limit 1;";
                    } else {
                        $query = "SELECT loan_date from pfloan_master where emp_no='$empno' and loan_type='$loan_type' order by loan_date desc limit 1;";
                    }
                    $result = mysql_query($query);
                    $per_data = mysql_fetch_array($result);
                    if ($loan_type == "P") {
                        $valid_loan_dat = strtotime(date("Y-m-d", strtotime($per_data['loan_date'])) . " +6 month");
                        $valid_loan_date = date("Y-m-d", $valid_loan_dat);
                    } else {
                        $valid_loan_dat = strtotime(date("Y-m-d", strtotime($per_data['loan_date'])) . " +12 month");
                        $valid_loan_date = date("Y-m-d", $valid_loan_dat);
                    }
                    if ($currentdate < $valid_loan_date) {

                        if ($loan_type == "P") {
                            $json = array("status" => false, "result" => "Employee is not eligible for the loan. The next loan date is $valid_loan_date.");
                        } else {
                            $json = array("status" => false, "result" => "Employee is not eligible for the partfinal. The next partfinal date is $valid_loan_date.");
                        }
                        echo json_encode($json);
                        exit;
                    } else {
                        $query = "select
                            e.gpf_no as gpf_no,
                            e.name as name,
                            pf.loan_amt as loan_amt,
                            pf.loan_date as loan_date,
                            pf.total_inst as total_inst,
                            pf.remaining_inst as remaining_inst,
                            pf.balance_amt as balance_amt,
                            d.desig_name as desig_name
                             from emp_master as e inner join pfloan_master as pf on e.emp_no = '$empno' and pf.emp_no=e.emp_no inner join desig_master as d on d.desig_id = e.desig_id;";
                        $result = mysql_query($query);
                        $person = mysql_num_rows($result);
                        $person_data = mysql_fetch_array($result);

                        $qry2 = "select ob from pf_master where emp_no='$empno' order by from_year desc limit 1;";
                        $result2 = mysql_query($qry2);
                        $person_data2 = mysql_fetch_array($result2);
                        if ($month <= 03) {
                            $date = $date - 1;
                        }
                        $qry3 = "select sum(pf_sub) + sum(recovery) as cumulative from pf_cumulative "
                                . "where sal_date >= '$date-04-01' and emp_no = '$empno' group by emp_no;";
                        $result3 = mysql_query($qry3);
                        $person_data3 = mysql_fetch_array($result3);

                        if ($person <> 0) {

                            $json = array("status" => true, "result" => "Empno exists", 'pf_no' => $person_data['gpf_no'],
                                'name' => $person_data['name'],
                                'loan_amt' => $person_data['loan_amt'],
                                'loan_date' => date("d-M-Y", strtotime($person_data['loan_date'])),
                                'total_inst' => $person_data['total_inst'],
                                'remaining_inst' => $person_data['remaining_inst'],
                                'balance_amt' => $person_data['balance_amt'],
                                'desig_name' => $person_data['desig_name'],
                                'ob' => $person_data2['ob'],
                                'cumulative' => $person_data3['cumulative']);
                            echo json_encode($json);
                            exit;
                        } else {
                            $query = "select
                            e.gpf_no as gpf_no,
                            e.name as name,
                            d.desig_name as desig_name
                             from emp_master as e inner join desig_master as d on e.emp_no = '125' and d.desig_id = e.desig_id;";
                            $result = mysql_query($query) or die(mysql_error());
                            $person_data = mysql_fetch_array($result);
                            
                            $qry2 = "select ob from pf_master where emp_no='$empno' order by from_year desc limit 1;";
                        $result2 = mysql_query($qry2);
                        $person_data2 = mysql_fetch_array($result2);
                        if ($month <= 03) {
                            $date = $date - 1;
                        }
                        $qry3 = "select sum(pf_sub) + sum(recovery) as cumulative from pf_cumulative "
                                . "where sal_date >= '$date-04-01' and emp_no = '$empno' group by emp_no;";
                        $result3 = mysql_query($qry3);
                        $person_data3 = mysql_fetch_array($result3);

                            $json = array("status" => false, "result" => "This employee does not have any previous loan.",
                                'loanmode' => 'Newloan',
                                'name' => $person_data['name'],
                                'desig_name' => $person_data['desig_name'],
                                'pf_no' => $person_data['gpf_no'],
                                'ob' => $person_data2['ob'],
                                'cumulative' => $person_data3['cumulative']
                            );
                            echo json_encode($json);
                            exit;
                        }
                    }
                }
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hdaction'])) {

        if (isset($_POST['fmonth']) && isset($_POST['tmonth']) && isset($_POST['roitxt'])) {

            $fmonth = ($_POST['fmonth']);
            $fmn = date("Y-m-d", strtotime($fmonth));
            $tmonth = mysql_escape_string($_POST['tmonth']);
            $tmn = date("Y-m-d", strtotime($tmonth));
            $roitxt = mysql_escape_string($_POST['roitxt']);
            $id = mysql_escape_string($_POST['id']);
            $qry = "";
            if ($_POST['hdaction'] == "save") {
                $qry = "INSERT INTO pf_intrest_rate(from_month,to_month,intrest_percent)
             VALUES('$fmn','$tmn',$roitxt);";
            } else {

                $qry = "update pf_intrest_rate set from_month='$fmn',to_month='$tmn',intrest_percent=$roitxt where id='$id';";
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
            $qury = "SELECT * FROM pf_intrest_rate where id=$id";

            $result = mysql_query($qury);
            $rowsnum = mysql_num_rows($result);
            if ($rowsnum > 0) {

                while ($res = mysql_fetch_array($result)) {

                    $output[] = array('from_month' => $res['from_month'],
                        'to_month' => $res['to_month'],
                        'intrest_percent' => $res['intrest_percent'],
                        'id' => $res['id']
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

        $qury = "DELETE FROM pf_intrest_rate WHERE id='" . $id . "';";

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