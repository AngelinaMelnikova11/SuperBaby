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

                
                $result = mysqli_query($connect, "SELECT * FROM `omission` where id_group = '$group_id' AND ((data_first >= '$data1' AND data_first <= '$data2' or data_last >= '$data1' AND data_last <= '$data2'))") or die(mysqli_error($connect));
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
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "Фамилия");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "Имя"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "Отчество"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "Дата занятия");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", "Оценка");   
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G2", "Отличников");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "Успеваемость");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G3", "Хорошистов");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", "(%)");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G4", "Плохая успеваемость");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H2", "=COUNTIF(E:E,5)/COUNT(E:E)*100");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H3", "=COUNTIF(E:E,4)/COUNT(E:E)*100");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H4", "=COUNTIF(E:E,3)/COUNT(E:E)*100");  
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);


  $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);



foreach($result as $row)
{
    $i++;

    $result1 =  mysqli_query($connect, "SELECT * FROM `child` where id = '".$row[id_child]."'") or die(mysqli_error($connect));
    $row1 = mysqli_num_rows($result1);
    foreach($result1 as $row1)
  {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$i", $row1[first_name]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$i", $row1[middle_name]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$i", $row1[last_name]);
 }
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$i", $row[data_first]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E$i", $row[score]);
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