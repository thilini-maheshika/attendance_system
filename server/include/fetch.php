<?php 
    //function for fetching data from database table student
    function fetchStudent(){

        include 'connection.php';

        $viewstd = "SELECT * FROM student WHERE is_deleted = '0'";
        return mysqli_query($con, $viewstd);
        
    }

    function fetchStudentinClass($sec_id){
        include 'connection.php';

        $viewstd = "SELECT * FROM student WHERE is_deleted = 0 AND sec_id = $sec_id ";
        return mysqli_query($con, $viewstd);
        
    }

    function fetchClass(){

        include 'connection.php';

        $viewcls = "SELECT * FROM class WHERE is_deleted = '0'";
        return mysqli_query($con, $viewcls);
        
    }

    function fetchClassbyTeacher($teacher){

        include 'connection.php';

        $viewcls = "SELECT sec_id FROM teacher WHERE is_deleted = '0' AND t_id = $teacher";
        return mysqli_query($con, $viewcls);
        
    }

    function fetchSection(){

        include 'connection.php';

        $viewcls = "SELECT * FROM section WHERE is_deleted = '0'";
        return mysqli_query($con, $viewcls);
        
    }

    function fetchTeacher(){

        include 'connection.php';

        $viewt = "SELECT * FROM teacher WHERE is_deleted = '0'";
        return mysqli_query($con, $viewt);
        
    }

    function fetchAll($t_id){

        include 'connection.php';
    
        $getall = "SELECT student.reg_no, student.std_name, class.cls_id, class.cls_name, section.sec_id, section.sec_name,
        teacher.t_name
        FROM student
        JOIN class ON student.sec_id = class.cls_id
        JOIN section ON student.sec_id = section.sec_id AND student.sec_id = section.sec_id
        JOIN teacher ON student.sec_id = teacher.sec_id AND student.sec_id = teacher.sec_id
        WHERE teacher.t_id = '$t_id' AND student.is_deleted = '0' GROUP BY student.reg_no";
        
        return mysqli_query($con, $getall);
    }
    
    

    function fetchAttendance(){

        include 'connection.php';

        $viewt = "SELECT * FROM attendance WHERE status_check = '1' AND DATE(date_updated) = CURDATE()";
        return mysqli_query($con, $viewt);
        
    }

    function fetchAttendanceInDate($date){

        include 'connection.php';

        $viewt = "SELECT * FROM attendance WHERE DATE(date_updated) = '$date'";
        return mysqli_query($con, $viewt);
        
    }

    function fetchAttendanceInSec($sec_id){

        include 'connection.php';

        $viewt = "SELECT * FROM attendance WHERE sec_id = '$sec_id' GROUP BY date_updated";
        return mysqli_query($con, $viewt);
        
    }

     
    

?>