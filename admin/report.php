<?php 
include '../server/include/connection.php';
require_once '../server/include/common.php';
include 'pages/auth.php';?>

<?php 
if(isset($_REQUEST['sec_id']) && $_REQUEST['date']){
    $sec_id = $_REQUEST['sec_id'];
    $date = $_REQUEST['date'];
}

$filename = "Attendance list " . $date . ".csv";
$dateTaken = $date;
$getatt = GetclassAttendance($dateTaken, $sec_id);

// Set headers to specify file format and name
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=".$filename);

// Open output stream
$output = fopen("php://output", "w");

// Write headers to CSV
fputcsv($output, array('Registration No', 'Student Name', 'Date', 'Section', 'Attendance'));

//Fetch data from database and write to CSV
if($getatt){
    if(mysqli_num_rows($getatt) > 0 ) {
        while ($row=mysqli_fetch_array($getatt)) {
            if($row['status_check'] == '1') {
                $status = "Present";
            } else {
                $status = "Absent";
            }
            $csvData = array($row['reg_no'], $row['std_name'], $row['date_updated'], $row['sec_name'], $status);
            fputcsv($output, $csvData);
        }
    } else {
        echo "No data found";
    }
} else {
    echo "Error executing query";
}

fclose($output);

exit(); // Prevent any additional output
