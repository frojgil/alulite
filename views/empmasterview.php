<?php 

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");



if($_SERVER['REQUEST_METHOD'] == "GET") {



if(isset($_GET['mode']) && $_GET['mode'] == "empnochk")
  {    

       $empno = $_GET['empno'];
       $query = "SELECT * FROM emp_master where emp_no='".$empno."'";
       $result = mysql_query($query); 
       $person = mysql_num_rows($result);
      if($person > 0)
      {

             $json = array("status"=>true,"result"=>"Empno already exists");
             echo json_encode($json);  
             exit;

      }
      else{

             $json = array("status"=>false,"result"=>"Empno avaliable");
             echo json_encode($json);  
             exit;
      }

  }

}


if($_SERVER['REQUEST_METHOD'] == "POST"){



        if(isset($_POST['mode']) && $_POST['mode'] == "edit"){


                if(isset($_POST['id'])){

                        $emid = $_POST['id'];
                        $output = array();
                        $qury = "SELECT * FROM emp_master as em INNER JOIN allowance as al ON al.emp_no = em.emp_no WHERE em.emp_no='".$emid."';";

                        $result = mysql_query($qury);
                        $rowsnum = mysql_num_rows($result);
                        if($rowsnum > 0){

                            while($person = mysql_fetch_array($result)){   

                                 $output[] = array('emp_no'=> $person['emp_no'],
                                                    'empname'=> $person['name'],
                                                   'salary_status'=> $person['salary_status'],
                                                   'desig_id'=> $person['desig_id'],
                                                   'dob'=> $person['dob'],
                                                   'join_date'=> $person['join_date'],
                                                   'dor'=> $person['dor'],
                                                   'basic_pay'=> $person['basic_pay'],
                                                   'grade_pay'=> $person['grade_pay'],
                                                   'personal_pay'=> $person['personal_pay'],
                                                   'other_pay'=> $person['other_pay'],
                                                   'bank_id'=> $person['bank_id'],
                                                   'gpf_no'=> $person['gpf_no'],
                                                   'panchayath_id'=> $person['panchayath_id'],
                                                   'dept_id'=> $person['dept_id'],
                                                   'pan_no'=> $person['pan_no'],
                                                   'aadhaar_no'=> $person['aadhaar_no'],
                                                   'bank_ac_no'=> $person['bank_ac_no'],
                                                   'emp_type'=> $person['emp_type'],
                                                   'teach_nteach'=> $person['teach_nteach'],
                                                   'landline_no'=> $person['landline_no'],
                                                   'mobile_no'=> $person['mobile_no'],
                                                   'official_email'=> $person['official_email'],
                                                   'personal_email'=> $person['personal_email'],
                                                   'per_address'=> $person['per_address'],
                                                   'res_address'=> $person['res_address'],
                                                   'emp_remarks'=> $person['emp_remarks'],
                                                   'da_amount'=> $person['da_amount'],
                                                   'hra'=> $person['hra'],
                                                   'medi_alwn'=> $person['medi_alwn'],
                                                   'wash_alwn'=> $person['wash_alwn'],
                                                   'cash_alwn'=> $person['cash_alwn'],
                                                   'phy_alwn'=> $person['phy_alwn'],
                                                   'cca'=> $person['cca'],
                                                   'cloth_alwn'=> $person['cloth_alwn'],
                                                   'ir'=> $person['ir']

                                    );
                                }

                            $json = array("status"=>true, "recordset" => $output, "result"=>"Data Added Sussesfully");
                            echo json_encode($json);
                            exit;

                        }
                        else{

                            $json = array("status"=>false, "recordset " => "Nil", "result"=>"No data found in db");
                            echo json_encode($json);
                            exit;
                        }
                }
                else{

                            $json = array("status"=>false, "recordset " => "Nil", "result"=>"No data found");
                            echo json_encode($json);
                            exit;
                }
        }
        

        if(isset($_POST['mode']) && $_POST['mode'] == "del"){


                if(isset($_POST['id'])){

                        $emid=$_POST['id'];

                        $qury = "DELETE FROM emp_master WHERE emp_no='".$emid."';";

                        $result = mysql_query($qury);
                        if($result){

                            $json = array("status"=>true, "result"=>"Delete Sussesfully");
                            echo json_encode($json);
                            exit;

                        }
                        else{

                            $json = array("status"=>false, "result"=>"No data found");
                            echo json_encode($json);
                            exit;
                        }
                }
        }




  if(isset($_POST['empnotxt']))
  {    

    // ------------------- employee master post fields------------
     $empnotxt = mysql_escape_string($_POST['empnotxt']);
     $empnametxt = mysql_escape_string($_POST['empnametxt']);
     $empdesgcmb = mysql_escape_string($_POST['empdesgcmb']);
     $empdeptcmb = mysql_escape_string($_POST['empdeptcmb']);
     $empbptxt = mysql_escape_string($_POST['empbptxt']);
     $empagptxt = mysql_escape_string($_POST['empagptxt']);
     $empdob = ($_POST['empdob']);
     $mempdob=date("Y-m-d",strtotime($empdob));
     $empdoj = ($_POST['empdoj']);
     $mempdoj=date("Y-m-d",strtotime($empdoj));
     $empgpftxt = mysql_escape_string($_POST['empgpftxt']);
     $empbnkcmb = mysql_escape_string($_POST['empbnkcmb']);
     $empbankacntxt = mysql_escape_string($_POST['empbankacntxt']);
     $emppanchcmb = mysql_escape_string($_POST['emppanchcmb']);
     $empmobtxt = mysql_escape_string($_POST['empmobtxt']);
     $empdor = ($_POST['empdor']);
     $mempdor=date("Y-m-d",strtotime($empdor));
     $empphonetxt = mysql_escape_string($_POST['empphonetxt']);
     $empoemailtxt = mysql_escape_string($_POST['empoemailtxt']);
     $emppemailtxt = mysql_escape_string($_POST['emppemailtxt']);
     $emppantxt = mysql_escape_string($_POST['emppantxt']);
     $empadartxt = mysql_escape_string($_POST['empadartxt']);
     $empperaddrta = mysql_escape_string($_POST['empperaddrta']);
     $empresaddrta = mysql_escape_string($_POST['empresaddrta']);
     $emptyperd = mysql_escape_string($_POST['emptyperd']);
     $hdsstatus = mysql_escape_string($_POST['hdsstatus']);
     $stopsalreason = mysql_escape_string($_POST['empsalaryoff']);
     $r3 = mysql_escape_string($_POST['r3']);
     $empsalfundcmb = mysql_escape_string($_POST['empsalfundcmb']);
     $empquastacmb = mysql_escape_string($_POST['empquastacmb']);
     $empcadrecmb = mysql_escape_string($_POST['empcadrcmb']);
    // -------------------- end emplyee post fields-------------------

    //------------------- employee allowence post fields------------
     $empotherpaytxt = FixNull($_POST['empotherpaytxt']);
     $empdralwntxt = (FixNull($_POST['empdralwntxt']));
     $empadatxt = (FixNull($_POST['empadatxt']));
     $empirtxt = (FixNull($_POST['empirtxt']));
     $emphratxt = (FixNull($_POST['emphratxt']));
     $empmatxt = (FixNull($_POST['empmatxt']));
     $empccatxt = (FixNull($_POST['empccatxt']));
     $empclothtxt = (FixNull($_POST['empclothtxt']));
     $empwatxt = (FixNull($_POST['empwatxt']));
     $empcatxt = (FixNull($_POST['empcatxt']));
     $emppcatxt = (FixNull($_POST['emppcatxt']));
     $empwagedytxt = (FixNull($_POST['empwagedytxt']));
    // ------------------- end employee allowence post fields------------
        

     if($_POST['hdaction'] == "save") {
         
        $ImageName = "$empnotxt.".pathinfo($_FILES['empphoto']['name'],PATHINFO_EXTENSION)  ;
        $path = 'empPhotos/'; 
        $location = $path . $ImageName; 
        move_uploaded_file($_FILES['empphoto']['tmp_name'], $location);
        
     $qry = "INSERT INTO emp_master (emp_no,name,desig_id,dept_id,basic_pay,grade_pay,dob,join_date,gpf_no,bank_id,bank_ac_no,panchayath_id,mobile_no,dor,
        landline_no,official_email,personal_email,pan_no,aadhaar_no,per_address,res_address,teach_nteach,salary_status,emp_remarks,pf_type,salary_fund,photo,quarters_status,staff_cadre) VALUES ('$empnotxt','$empnametxt',
        $empdesgcmb,$empdeptcmb,$empbptxt,$empagptxt,'$mempdob','$mempdoj','$empgpftxt',$empbnkcmb,'$empbankacntxt',$emppanchcmb,'$empmobtxt','$mempdor',
        '$empphonetxt','$empoemailtxt','$emppemailtxt','$emppantxt','$empadartxt','$empperaddrta','$empresaddrta',$emptyperd,'$hdsstatus','$stopsalreason','$r3',$empsalfundcmb,'$path$ImageName','$empquastacmb','$empcadrecmb');";


     $qry2 = "INSERT INTO allowance (emp_no,other_pay,da_amount,ada,ir,hra,medi_alwn,cca,cloth_alwn,wash_alwn,cash_alwn,phy_alwn) 
     VALUES ('$empnotxt',$empotherpaytxt,$empdralwntxt,$empadatxt,$empirtxt,$emphratxt,$empmatxt,$empccatxt,$empclothtxt,$empwatxt,$empcatxt,$emppcatxt);";
      }
      else{


                //update query
      }

        mysql_query($qry);
        sleep(1); 
        mysql_query($qry2) or die(mysql_error());

  		$json = array("status"=>true,"result"=>"Data Added Sussesfully");
        echo json_encode($json);

     }                    
     else{

          $json = array("status"=>false,"result" => "Error While Adding The Data");
          echo json_encode($json);

        }    
        }          




    function FixNull($param){

        if(empty($param) || $param == ""){

            return "0";
        }
        return $param;
    }





        ?>
