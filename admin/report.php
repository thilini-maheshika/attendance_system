<?php
session_start();
include 'pages/header.php'; 
require '../vendor/autoload.php'; // require the PhpSpreadsheet library

if (isset($_SESSION['teacher'])) {   

    if(isset($_REQUEST['key'])){

        $key = $_REQUEST['key'];
        $getatt = GetclassAttendance($key,$_SESSION['teacher']);

        // create a new Excel spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // write column headers
        $sheet->setCellValue('A1', 'Registration No');
        $sheet->setCellValue('B1', 'Student Name');
        $sheet->setCellValue('C1', 'Class');
        $sheet->setCellValue('D1', 'Section');

        // write attendance data
        $row = 2;
        while($data = mysqli_fetch_assoc($getatt)) {
            $sheet->setCellValue('A' . $row, $data['reg_no']);
            $sheet->setCellValue('B' . $row, $data['std_name']);
            $sheet->setCellValue('C' . $row, $data['cls_name']);
            $sheet->setCellValue('D' . $row, $data['sec_name']);
            $row++;
        }

        // generate Excel file and prompt user to download it
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="attendance.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;

    }
}
?>
