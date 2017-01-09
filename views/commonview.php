<?php 

include('../include/dbconfig.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");


if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST['pcodetxt']))
  {    

    // ------------------- employee master post fields------------
     $pcodetxt = mysql_escape_string($_POST['pcodetxt']);
     $pnametxt = mysql_escape_string($_POST['pnametxt']);
     $gpmintxt = mysql_escape_string($_POST['gpmintxt']);
     $gpmaxtxt = mysql_escape_string($_POST['gpmaxtxt']);
     $ptaxtxt = mysql_escape_string($_POST['ptaxtxt']);
     
     if($_POST['hdaction'] == "save") {
        
     $qry = "INSERT INTO panchayat (panchayat_id,panchayat_name,min_gp,max_gp,p_tax_amount) VALUES('$pcodetxt','$pnametxt',$gpmintxt,$gpmaxtxt,$ptaxtxt);";
     mysql_query($qry) or die(mysql_error());

     $json = array("status"=>true,"result"=>"Data Added Sussesfully");
    echo json_encode($json);

      }

     

	}
	else
	{

		$json = array("status"=>false,"result" => "Error While Adding The Data");
        echo json_encode($json);
	}
}


?>