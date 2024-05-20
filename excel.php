<?php  
//export.php

require_once('PHPExcel/Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('PHPExcel/Classes/PHPExcel/Writer/Excel5.php');
require 'vendor/connect.php';
mysqli_query($connect, "SET NAMES utf8");
$output = '';
 $data1 = $_POST['date1'];
 $data2 = $_POST['date2'];
  $group_id = $_POST['group'];

                
                $result = mysqli_query($connect, "SELECT * FROM `child` where group_id='$group_id' ORDER BY `first_name`, `middle_name`, `last_name` ASC ") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);


 
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
$i = 1;
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "ФИО ребенка");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "ФИО родителя"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "Номер телефона родителя"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "Почта");  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", "Кол-во пропусков");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "Кол-во посещений");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", "Количество пропусков");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", "=SUM(F:F)");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I2", "Количество посещаемости");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J2", "=SUM(G:G)");
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);


  $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);



foreach($result as $row)
{
    $i++;

    $fio = $row[first_name]." ".$row[middle_name]." ".$row[last_name];

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$i", $fio);
    $parent = $row[parent_id];
    $result1 = mysqli_query($connect, "SELECT * FROM `users` where id='$parent'") or die(mysqli_error($connect));
    $row1 = mysqli_num_rows($result);

                foreach ($result1 as $row1) {
                  $fio2 = $row1[first_name]." ".$row1[middle_name]." ".$row1[last_name];
                  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$i", $fio2);
                  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$i", $row1[phone]);
                  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$i", $row1[email]);
                    $nuw_users = 0;
                    $result2 = mysqli_query($connect, "SELECT * FROM `ivent` where data >= '$data1' AND data <= '$data2'") or die(mysqli_error($connect));
                    $row2 = mysqli_num_rows($result);

                    foreach ($result2 as $row2) {
                      $id_ivent = $row2['id'];
                      $users = mysqli_query($connect, "SELECT COUNT(*) FROM orders WHERE id_user = '$parent' AND id_ivent = '$id_ivent'") or die(mysqli_error($connect));
                      $nuw_users1 = mysqli_fetch_row($users)[0];
                      $nuw_users = $nuw_users1 + $nuw_users; 
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E$i", $nuw_users);
                }
                $id_child = $row[id];
                $child = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$data1' AND data_first <= '$data2' AND miss='-'") or die(mysqli_error($connect));
                $nuw_child = mysqli_fetch_row($child)[0];
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F$i", $nuw_child);

                $child1 = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$data1' AND data_first <= '$data2' AND miss='+'") or die(mysqli_error($connect));
                $nuw_child1 = mysqli_fetch_row($child1)[0];

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G$i", $nuw_child1);


}

 $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="stat.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
 
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
?>