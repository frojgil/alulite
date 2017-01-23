<?php

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $qry = "select * from emp_master as e inner join allowance as a on e.salary_status = 'Y' and e.emp_no = a.emp_no;";
    $rt = mysql_query($qry);
    WHILE ($row = mysql_fetch_array($rt)) {
        $month = date("m", strtotime($_POST['sdate']));
        $date = date("Y-m", strtotime("+5 hours 30 minutes"));
        $dt = date("Y-m-d", strtotime($_POST['sdate']));
        $empid = $row['emp_no'];
        $basic_pay = $row['basic_pay'];
        $grade_pay = $row['grade_pay'];
        $hra = $row['hra'];
        $medi_alwn = $row['medi_alwn'];
        $wash_alwn = $row['wash_alwn'];
        $cash_alwn = $row['cash_alwn'];
        $phy_alwn = $row['phy_alwn'];
        $cloth_alwn = $row['cloth_alwn'];
        $pf_da = $row['pf_da'];
        $ada = $row['ada'];
        $cca = $row['cca'];
        $da_amt = $row['da_amt'];
        $other_pay = $row['other_pay'];
        $ir = $row['ir'];
        $personal_pay = $row['personal_pay'];
        $spl_pay = $row['spl_pay'];
        $imp_da = $row['imp_da'];
        $depute_alwn = $row['depute_alwn'];

        $qry1 = "insert into salary(emp_no,yr_mn,medi_alwn,cash_alwn,wash_alwn,phy_alwn,"
                . "other_pay,cca,cloth_alwn,depute_alwn,pf_da,ada,ir,personal_pay,spl_pay,imp_da,bp,gp,da_amt) values"
                . "('$empid','$dt',$medi_alwn,$cash_alwn,$wash_alwn,$phy_alwn,"
                . "$other_pay,$cca,$cloth_alwn,$depute_alwn,$pf_da,$ada,$ir,$personal_pay,$spl_pay,$imp_da,"
                . "$basic_pay,$grade_pay,$da_amt);";

        $result = mysql_query($qry1) or die(mysql_error());

        //------------------ festival advance process---------------------------------- 
        $qry2 = "select * from festival_adv where emp_no='$empid';";
        $result2 = mysql_query($qry2) or die(mysql_error());

        while ($data2 = mysql_fetch_array($result2)) {
            $festmnyr = date("Y-m", strtotime($data2['from_date']));
            if ($data2['emp_no'] !== "" && $data2['remaining_inst'] != 0 && $festmnyr === $date) {
                $qry2sub = "update salary set festival_adv = $data2[inst_amt] where emp_no= '$data2[emp_no]' and yr_mn ='$dt';";
                $result2s = mysql_query($qry2sub) or die(mysql_error());
                $qry2sub1 = "update festival_adv set remaining_inst=$data2[remaining_inst]-1,balance_due=$data2[balance_due]-$data2[inst_amt] where emp_no= '$data2[emp_no]';";
                $result2s1 = mysql_query($qry2sub1) or die(mysql_error());
            }
        }
        
         //------------------ vehical advance process---------------------------------- 
        //$qry3 = "select * from vehical_adv where emp_no='$empid';";
       // $result3 = mysql_query($qry3) or die(mysql_error());

       // while ($data3 = mysql_fetch_array($result3)) {
        //    if ($data3['emp_no'] !== "" && $data3['vlremaining_inst'] !== 0 || $data3['ivlremaining_inst'] !== 0) {
          //      $qry3sub = "update salary set vehical_adv = $data3[inst_amt] where emp_no= '$data3[emp_no]' and yr_mn ='$dt';";
         //       $result3s = mysql_query($qry2sub) or die(mysql_error());
           //     $qry3sub1 = "update festival_adv set remaining_inst=$data3[remaining_inst]-1,balance_due=$data3[balance_due]-$data3[inst_amt] where emp_no= '$data3[emp_no]';";
           //     $result3s1 = mysql_query($qry3sub1) or die(mysql_error());
          //  }
      //  }
        
        
        //------------------ NHIS process---------------------------------- 
        $qry4 = "select * from nhis_adv where emp_no='$empid';";
        $result4 = mysql_query($qry4) or die(mysql_error());

        while ($data4 = mysql_fetch_array($result4)) {
            if ($data4['emp_no'] !== "" && $data4['nhisamt'] != 0 ) {
                $qry4sub = "update salary set nhis = $data4[nhisamt] where emp_no= '$data4[emp_no]' and yr_mn ='$dt';";
                $result4s = mysql_query($qry4sub) or die(mysql_error());
            }
        }
        
        //------------------ cloth advance process---------------------------------- 
        $qry5 = "select * from cloth_adv where emp_no='$empid';";
        $result5 = mysql_query($qry5) or die(mysql_error());

        while ($data5 = mysql_fetch_array($result5)) {
            $festmnyr = date("Y-m", strtotime($data5['from_date']));
            if ($data5['emp_no'] !== "" && $data5['remaining_inst'] != 0 && $festmnyr === $date) {
                $qry5sub = "update salary set cloth_adv = $data5[inst_amt] where emp_no= '$data5[emp_no]' and yr_mn ='$dt';";
                $result5s = mysql_query($qry5sub) or die(mysql_error());
                $qry5sub1 = "update cloth_adv set remaining_inst=$data5[remaining_inst]-1,balance_due=$data5[balance_due]-$data5[inst_amt] where emp_no= '$data5[emp_no]';";
                $result5s1 = mysql_query($qry5sub1) or die(mysql_error());
            }
        }
        
         //------------------ thrift process---------------------------------- 
        $qry6 = "select sal_month,total_amt,emp_no from thrift where emp_no='$empid';";
        $result6 = mysql_query($qry6) or die(mysql_error());

        while ($data6 = mysql_fetch_array($result6)) {
            $salmnyr = date("Y-m", strtotime($data6['sal_month']));
            if ($data6['emp_no'] !== "" && $data6['total_amt'] != 0 && $salmnyr === $date ) {
                $qry6sub = "update salary set thrift = $data6[total_amt] where emp_no= '$data6[emp_no]' and yr_mn ='$dt';";
                $result6s = mysql_query($qry6sub) or die(mysql_error());
            }
        }
        
        //------------------ lic process---------------------------------- 
        $qry7 = "SELECT sum(pcamt) as pcamt, premaining_inst,emp_no from lic_recovery where emp_no ='$empid' and premaining_inst!=0;";
        $result7 = mysql_query($qry7) or die(mysql_error());

        while ($data7 = mysql_fetch_array($result7)) {
            if ($data7['emp_no'] !== "" && $data7['pcamt'] != 0) {
                $qry7sub = "update salary set lic_recovery = $data7[pcamt] where emp_no= '$data7[emp_no]' and yr_mn ='$dt';";
                $result7s = mysql_query($qry7sub) or die(mysql_error());
                $qry7sub1 = "SELECT * from lic_recovery where emp_no ='$empid';";
                $result7s1 = mysql_query($qry7) or die(mysql_error());
                while ($data7s1 = mysql_fetch_array($result7s1)) {
                $qry7sub2 = "update lic_recovery set premaining_inst= premaining_inst -1 where emp_no= '$data7s1[emp_no]' and premaining_inst!=0;";
                $result7s2 = mysql_query($qry7sub2) or die(mysql_error());
                }
            }
        }
        
         //------------------ itax process---------------------------------- 
        $qry8 = "select * from itax_master where emp_no='$empid';";
        $result8 = mysql_query($qry8) or die(mysql_error());

        while ($data8 = mysql_fetch_array($result8)) {
            if ($data8['emp_no'] !== "" && $data8['itaxamt']!= 0 && $month!=1 && $month!=2 && $month!=3) {
                $qry8sub = "update salary set itax= $data8[itaxamt] where emp_no= '$data8[emp_no]' and yr_mn ='$dt';";
                $result8s = mysql_query($qry8sub) or die(mysql_error());
                
            }
            elseif($data8['emp_no'] !== "" && $data8['itaxamt'] != 0 && $month==1)
            {
                $qry8sub = "update salary set itax= $data8[itaxamt] + $data8[ejanitaxamt] where emp_no= '$data8[emp_no]' and yr_mn ='$dt';";
                $result8s = mysql_query($qry8sub) or die(mysql_error());
                $qry8sub1 = "update itax_master set ejanitaxamt=0 where emp_no= '$data8[emp_no]';";
                $result8s1 = mysql_query($qry8sub1) or die(mysql_error());
                
            }
            elseif($data8['emp_no'] !== "" && $data8['itaxamt'] != 0 && $month==2)
            {
                $qry8sub = "update salary set itax= $data8[itaxamt] + $data8[efebitaxamt] where emp_no= '$data8[emp_no]' and yr_mn ='$dt';";
                $result8s = mysql_query($qry8sub) or die(mysql_error());
                $qry8sub1 = "update itax_master set efebitaxamt=0 where emp_no= '$data8[emp_no]';";
                $result8s1 = mysql_query($qry8sub1) or die(mysql_error());
                
            }
            elseif($data8['emp_no'] !== "" && $data8['itaxamt'] != 0 && $month==3)
            {
                $qry8sub = "update salary set itax= $data8[itaxamt] + $data8[emaritaxamt] where emp_no= '$data8[emp_no]' and yr_mn ='$dt';";
                $result8s = mysql_query($qry8sub) or die(mysql_error());
                $qry8sub1 = "update itax_master set emaritaxamt=0 where emp_no= '$data8[emp_no]';";
                $result8s1 = mysql_query($qry8sub1) or die(mysql_error());
                
            }
        }
        
         //------------------ GIS process---------------------------------- 
        $qry9 = "select * from gis where emp_no='$empid';";
        $result9 = mysql_query($qry9) or die(mysql_error());

        while ($data9 = mysql_fetch_array($result9)) {
            if ($data9['emp_no'] !== "" && $data9['gisamt'] != 0 ) {
                $qry9sub = "update salary set gis = $data9[gisamt] where emp_no= '$data9[emp_no]' and yr_mn ='$dt';";
                $result9s = mysql_query($qry9sub) or die(mysql_error());
            }
        }
         
         //------------------ spf process---------------------------------- 
        $qry10 = "select * from spf where emp_no='$empid';";
        $result10 = mysql_query($qry10) or die(mysql_error());

        while ($data10 = mysql_fetch_array($result10)) {
            if ($data10['emp_no'] !== "" && $data10['spfamt']!= 0 ) {
                $qry10sub = "update salary set spf = $data10[spfamt] where emp_no= '$data10[emp_no]' and yr_mn ='$dt';";
                $result10s = mysql_query($qry10sub) or die(mysql_error());
            }
        }
        
        //------------------ pf loan process---------------------------------- 
        $qry11 = "select * from pfloan_master where emp_no='$empid' and loan_type='P' and remaining_inst!=0;";
        $result11 = mysql_query($qry11) or die(mysql_error());

        while ($data11 = mysql_fetch_array($result11)) {
            if ($data11['emp_no'] !== "" && $data11['inst_amt']!= 0 ) {
                $qry11sub = "update salary set pf_loan = $data11[inst_amt] where emp_no= '$data11[emp_no]' and yr_mn ='$dt';";
                $result11s = mysql_query($qry11sub) or die(mysql_error());
                $qry11sub1 = "update pfloan_master set remaining_inst = remaining_inst - 1, balance_amt = balance_amt - $data11[inst_amt] where emp_no= '$data11[emp_no]';";
                $result11s1 = mysql_query($qry11sub1) or die(mysql_error());
                $qry11sub2 = "update pf_cumulative set remaining_inst = remaining_inst - 1, balance_amt = balance_amt - $data11[inst_amt] where emp_no= '$data11[emp_no]';";
                $result11s2 = mysql_query($qry11sub2) or die(mysql_error());
            }
        }
        
    }
    if ($result) {
        $json = array("status" => true, "result" => "Salary Proccessing done successfuly");
        echo json_encode($json);
        exit;
    } else {

        $json = array("status" => false, "result" => "Error has been deducted");
        echo json_encode($json);
        exit;
    }
}
