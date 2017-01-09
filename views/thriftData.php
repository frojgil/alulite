<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $date = date("Y-m-d", strtotime("+5 hours 30 minutes"));
$file = $_FILES['file']['tmp_name'];
$handle = fopen($file, "r");
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
{
        $m_no= $filesop[0];
        $emp_no= $filesop[1];
        $name= $filesop[2];
        $loan_no= $filesop[3];
        $loan_bal= $filesop[4];
        $prin_amt= $filesop[5];
        $intrest= $filesop[6];
        $t_share= $filesop[7];
        $loan_no1= $filesop[8];
        $loan_balance1= $filesop[9];
        $prin_amt1= $filesop[10];
        $intrest1= $filesop[11];
        $total_amt= $filesop[12];
$sql = mysql_query("INSERT INTO thrift (mem_no, emp_no, name, loan_no1, loan_bal1, prin_amt1, intrest1, t_deposit, loan_no2, loan_bal2, prin_amt2, intrest2, total_amt, sal_month) VALUES
('$m_no', '$emp_no', '$name', $loan_no, $loan_bal, $prin_amt, $intrest, $t_share, $loan_no1, $loan_balance1,$prin_amt1, $intrest1,$total_amt, '$date')") or die(mysql_error());
$c = $c + 1;
}

        $json = array("status" => true, "result" => "Data uploaded for thrift");
        echo json_encode($json);
    } else {

        $json = array("status" => false, "result" => "File is empty ");
        echo json_encode($json);
    }