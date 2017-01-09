<?php
include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

$query = "SELECT emp_no FROM emp_master where emp_no=124";
      $result = mysql_query($query); 
      $person = mysql_num_rows($result);
      echo $person;

if($_SERVER['REQUEST_METHOD'] == "POST"){


  if(isset($_GET['mode']))
  {   
     $empno = $_POST['empnotxt'];

      $query = "SELECT emp_no FROM emp_master where emp_no=123";
      $result = mysql_query($query); 
      $person = mysql_num_rows($result);

      if($person==0)
      {


      }

    }}


     /* While($person = mysql_fetch_array($result))
            {
              if($exist_emp_no = $person['emp_no']==$_POST['empnotxt'])

              {   
                $json = array("status"=>false,"result" => "Error While Adding The Data");
                echo json_encode($json);
                exit();
              }*/
 ?>