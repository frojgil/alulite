<?php

//require 'calendar/php/findCntry.php';
session_start();
include('config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['file_src'])) {

        $output = array();
        $actal = realpath($_FILES['Scholar']['tmp_name']);
        $path = $_POST['file_src'];
        $sheetname = strtolower($_POST['flSheet']);
        $uploaddir = 'Docsuploads/';
        $uploadfile = $uploaddir . basename($_FILES["Scholar"]["name"]);

        if (move_uploaded_file($_FILES["Scholar"]["tmp_name"], $uploadfile)) {

            //echo "Path: " . $uploadfile;
            //$handle = fopen("$uploadfile", "r");
        }


        include 'PHPExcel/Classes/PHPExcel.php';
        $dataFfile = $uploadfile;

        /* $objPHPExcel = PHPExcel_IOFactory::load($dataFfile);
          $sheet = $objPHPExcel->getActiveSheet();
          $data = $sheet->rangeToArray('A1:J300'); */

        $objReader = PHPExcel_IOFactory::createReaderForFile($dataFfile);
        $objReader->setLoadSheetsOnly(array($sheetname));
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($dataFfile);
        $highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        $xlrange = "A1:" . $highestColumm . $highestRow;
        $sheet = $objPHPExcel->getActiveSheet();
        $data = $sheet->rangeToArray($xlrange);


        /*  echo 'getHighestColumn() = [' . $highestColumm . ']<br/>';
          echo 'getHighestRow() = [' . $highestRow . ']<br/>';
          echo '<table border="1">';
          $i = 1;
          foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          echo '<tr>';
          echo '<td>' . $i . '</td>';

          foreach ($cellIterator as $cell) {
          if (!is_null($cell)) {
          $value = $cell->getCalculatedValue();

          $row = str_replace('\'', '’ ', $value);

          $row = str_replace('’', ' ', $row);

          echo '<td>';
          echo $rowval . '&nbsp;';
          echo '</td>';
          }
          $i = $i + 1;
          } echo '</tr>';
          } echo '</table>'; */

        /*
          echo "Rows available: " . count($data) . "\n";
          echo "<table border='1'>";
          echo "<tr>";
          echo "<th>type</th>";
          echo "<th>Instu</th>";
          echo "<th>city</th>";
          echo "<th>prov</th>";
          echo "<th>name</th>";
          echo "<th>websit</th>";
          echo "<th>award</th>";
          echo "<th>Ch</th>";
          echo "<th>Cp</th>";
          echo "<th>Sp</th>";
          echo "<th>Ug</th>";
          echo "<th>Pg</th>";
          echo "<th>Tr</th>";
          echo "<th>Country</th>";
          echo "</tr>";
         */
        echo 'getHighestColumn() = [' . $highestColumm . ']<br/>';
        echo 'getHighestRow() = [' . $highestRow . ']<br/>';
        $DefultCrtry = (isset($_SESSION['selCity']) == true) ? strtolower($_SESSION['selCity']) : strtolower("Philippines");
        $sel = "";
        $path = "Location:scholarships.php";
        $curdate = date('Y-m-d h:i:sa', time());

        if ($_POST['selModel'] == "scholarships") {

            if (isset($_SESSION['selCity'])) {

                if (strtolower($_SESSION['selCity']) == "asia" || strtolower($_SESSION['selCity']) == "philippines") {

                    $path = 'Location:scholarshipcountry.php';
                } else {
                    $path = 'Location:scholarships.php';
                }
            }
            //$qry = "INSERT INTO scholarships (country, nameofschool, deadline, titleofscholarships, scholarshipsdesp, requirements, academicinterest, awards,renewablereq, link, Createdby, Createddate) VALUES ";
            foreach ($data as $row) {

                if (strtolower($row[0]) != "country" && strtolower($row[0]) != "name of school" && strtolower($row[0]) != "deadline" && strtolower($row[0]) != "title of scholarships" && strtolower($row[0]) != "scholarships description" && strtolower($row[0]) != "requirements" && strtolower($row[0]) != "academic interest" &&
                        strtolower($row[0]) != "awards" && strtolower($row[0]) != "renewable requirements" && strtolower($row[0]) != "website link") {

                    $country = str_replace('\'', ' ', $row[0]);
                    $country = str_replace('’', ' ', $country);

                    $nameofschool = str_replace('\'', ' ', $row[1]);
                    $nameofschool = str_replace('’', ' ', $nameofschool);

                    $deadline = str_replace('\'', ' ', $row[2]);
                    $deadline = str_replace('’', ' ', $deadline);

                    $titleofscholarships = str_replace('\'', ' ', $row[3]);
                    $titleofscholarships = str_replace('’', ' ', $titleofscholarships);

                    $scholarshipsdesp = str_replace('\'', ' ', $row[4]);
                    $scholarshipsdesp = str_replace('’', ' ', $scholarshipsdesp);

                    $requirements = str_replace('\'', ' ', $row[5]);
                    $requirements = str_replace('’', ' ', $requirements);

                    $academicinterest = str_replace('\'', ' ', $row[6]);
                    $academicinterest = str_replace('’', ' ', $academicinterest);

                    $awards = str_replace('\'', ' ', $row[7]);
                    $awards = str_replace('’', ' ', $awards);

                    $renewablereq = str_replace('\'', ' ', $row[8]);
                    $renewablereq = str_replace('’', ' ', $renewablereq);

                    $link = str_replace('\'', ' ', $row[9]);
                    $link = str_replace('’', ' ', $link);

                    /*
                      echo "<tr>";
                      echo"<td>" . $country . "</td>";
                      echo"<td>" . $nameofschool . "</td>";
                      echo"<td>" . $deadline . "</td>";
                      echo"<td>" . $titleofscholarships . "</td>";
                      echo"<td>" . $scholarshipsdesp . "</td>";
                      echo"<td>" . $requirements . "</td>";
                      echo"<td>" . $academicinterest . "</td>";
                      echo"<td>" . $awards . "</td>";
                      echo"<td>" . $renewablereq . "</td>";
                      echo"<td>" . $link . "</td>";
                      echo "</tr>";
                     */

                    $qry = "INSERT INTO scholarships (country, nameofschool, deadline, titleofscholarships, scholarshipsdesp, requirements, academicinterest, awards,renewablereq, link, Createdby, Createddate) VALUES ('" . $country . "','" . $nameofschool . "','" . $deadline . "','" . $titleofscholarships . "','" . $scholarshipsdesp . "','" . $requirements . "'," .
                            "'" . $academicinterest . "','" . $awards . "','" . $renewablereq . "','" . $link . "','System',NOW());";

                    $result = mysqli_query($dbc, $qry);

                    /* $qry = "INSERT INTO scholarships1 (country, nameofschool, deadline, titleofscholarships, scholarshipsdesp, requirements, academicinterest, awards,renewablereq, link, Createdby, Createddate) VALUES ('s','ss','sss','sss','ss','ss','sss','ss','ss','ss','sss',NOW());";

                     */
                }
                header($path, true, 301);
            }
        }

        if ($_POST['selModel'] == "connect") {


            $calstud = 0;
            $ug = 0;
            $pg = 0;
            $trans = 0.0;
            $champ = 0;

            foreach ($data as $row) {

                if (strtolower($row[0]) != "type of school" && strtolower($row[0]) != "institution type" && strtolower($row[0]) != "city" && strtolower($row[0]) != "province" && strtolower($row[0]) != "name of school" && strtolower($row[0]) != "website" && strtolower($row[0]) != "award offered" &&
                        strtolower($row[0]) != "campus setting" && strtolower($row[0]) != "campus housing" && strtolower($row[0]) != "student population" && strtolower($row[0]) != "undergraduate students" && strtolower($row[0]) != "graduation rate" && strtolower($row[0]) != "transfer out rate") {


                    $type = str_replace('\'', ' ', $row[0]);
                    $type = str_replace('’', ' ', $type);

                    $institutetype = str_replace('\'', ' ', $row[1]);
                    $institutetype = str_replace('’', ' ', $institutetype);

                    $city = str_replace('\'', ' ', $row[2]);
                    $city = str_replace('’', ' ', $city);

                    $state = str_replace('\'', ' ', $row[3]);
                    $state = str_replace('’', ' ', $state);

                    $name = str_replace('\'', ' ', $row[4]);
                    $name = str_replace('’', ' ', $name);

                    $website = str_replace('\'', ' ', $row[5]);
                    $website = str_replace('’', ' ', $website);

                    $awards = str_replace('\'', ' ', $row[6]);
                    $awards = str_replace('’', ' ', $awards);

                    $campussetting = str_replace('\'', ' ', $row[7]);
                    $campussetting = str_replace('’', ' ', $campussetting);

                    $campushousing = str_replace('\'', ' ', $row[8]);
                    $campushousing = str_replace('’', ' ', $campushousing);

                    /*  $students = str_replace('\'', '', $row[9]);
                      $students = str_replace('’', '', $students);
                      $students = str_replace(',', '', $students);

                      $ugstudents = str_replace('\'', '', $row[10]);
                      $ugstudents = str_replace('’', '', $ugstudents);
                      $ugstudents = str_replace(',', '', $ugstudents);

                      $graduationrate = str_replace('\'', '', $row[11]);
                      $graduationrate = str_replace('’', '', $graduationrate);
                      $graduationrate = str_replace(',', '', $graduationrate);

                      $transferrange = str_replace('\'', '', $row[12]);
                      $transferrange = str_replace('’', '', $transferrange);
                      $transferrange = str_replace(',', '', $transferrange); */

                    $country = (isset($_SESSION['selCity']) == true) ? strtolower($_SESSION['selCity']) : strtolower("Philippines");

                    //Check numeric
                    if ($campushousing != '') {

                        if (strtolower($campushousing) == "yes") {
                            $champ = 1;
                        }
                        if (strtolower($campushousing) == "no") {
                            $champ = 0;
                        }
                    }

                    if (is_numeric($row[9])) {

                        $calstud = $row[9];
                    } else {
                        $calstud = 0;
                    }
                    if (is_numeric($row[10])) {
                        $ug = $row[10];
                    } else {
                        $ug = 0;
                    }
                    if (is_numeric($row[11])) {
                        $pg = $row[11];
                    } else {
                        $pg = 0;
                    }
                    if (is_numeric($row[12])) {
                        $trans = $row[12];
                    } else {
                        $trans = 0;
                    }


                    /*
                      echo "<tr>";
                      echo"<td>" . $type . "</td>";
                      echo"<td>" . $institutetype . "</td>";
                      echo"<td>" . $city . "</td>";
                      echo"<td>" . $state . "</td>";
                      echo"<td>" . $name . "</td>";
                      echo"<td>" . $website . "</td>";
                      echo"<td>" . $awards . "</td>";
                      echo"<td>" . $campussetting . "</td>";
                      echo"<td>" . $champ . "</td>";
                      echo"<td>" . $calstud . "</td>";
                      echo"<td>" . $ug . "</td>";
                      echo"<td>" . $pg . "</td>";
                      echo"<td>" . $trans . "</td>";
                      echo"<td>" . $country . "</td>";
                      echo "</tr>";
                     */

                    $qry = "INSERT INTO colleges (type, institutetype, city, state, name, website, awards, campussetting, campushousing, students, ugstudents, graduationrate, transferrange, country) VALUES ('" . $type . "','" . $institutetype . "','" . $city . "','" . $state . "','" . $name . "','" . $website . "'," .
                            "'" . $awards . "','" . $campussetting . "','" . $champ . "','" . $calstud . "','" . $ug . "','" . $pg . "','" . $trans . "','" . $country . "');";

                    $result = mysqli_query($dbc, $qry);

                    /* $qry = "INSERT INTO scholarships1 (country, nameofschool, deadline, titleofscholarships, scholarshipsdesp, requirements, academicinterest, awards,renewablereq, link, Createdby, Createddate) VALUES ('s','ss','sss','sss','ss','ss','sss','ss','ss','ss','sss',NOW());";

                     */
                }
            }

            header('Location:select.html', true, 301);
        }

        exit();
    }
}