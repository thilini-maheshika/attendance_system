<?php

    function checkstdByUname($std_uname){
        include 'connection.php';
    
        $q1= "SELECT * FROM student WHERE std_uname='$std_uname' AND is_deleted='0'";
        $uname_check = mysqli_query($con,$q1);
        return mysqli_num_rows($uname_check);
    }

    function getAllStdByID($std_id) {

        include 'connection.php';

        $q1 = "SELECT * FROM student WHERE reg_no='$std_id' AND is_deleted='0'";
        return mysqli_query($con, $q1);
    }

    function checkclsByName($cls_name){
        include 'connection.php';
    
        $q1= "SELECT * FROM class WHERE cls_name='$cls_name' AND is_deleted='0'";
        $class_check = mysqli_query($con,$q1);
        return mysqli_num_rows($class_check);
    }

    function checksecByName($sec_name){
        include 'connection.php';
    
        $q1= "SELECT * FROM section WHERE sec_name='$sec_name' AND is_deleted='0'";
        $sec_check = mysqli_query($con,$q1);
        return mysqli_num_rows($sec_check);
    }

    function checkTeacherByEmail($uname){
        
        include 'connection.php';
    
        $q1= "SELECT * FROM teacher WHERE t_email='$uname' AND is_deleted='0'";
        return mysqli_query($con,$q1);
    }

    function getSecById($sec_id){
        include 'connection.php';
    
        $q1= "SELECT * FROM section WHERE sec_id='$sec_id' AND is_deleted='0'";
        return mysqli_query($con,$q1);
    }

    function getClassbyID($cls_id){

        include 'connection.php';
    
        $viewcls = "SELECT * FROM class WHERE cls_id='$cls_id' AND is_deleted='0'";
        return mysqli_query($con,$viewcls);
    
    }

    function getAllTeByID($t_id){
        include 'connection.php';
    
        $q1= "SELECT * FROM teacher WHERE t_id='$t_id' AND is_deleted='0'";
        return mysqli_query($con,$q1);
    }

    function checkAttendanceOfDate(){
        include 'connection.php';
    
        $q1= "SELECT * FROM attendance WHERE DATE(date_updated) = CURDATE()";
        $check = mysqli_query($con,$q1);
        return mysqli_num_rows($check);
    }

    function CheckLogin($data){
        include 'connection.php';
    
        $userType = $data['userType'];
        $uname = $data['userName'];
        $password = $data['password'];
    
        if($userType == 'admin'){
            // execute admin login query
            $q1= "SELECT * FROM tbl_admin WHERE ad_email='$uname' AND ad_pass='$password'";
            $res = mysqli_query($con,$q1);
            $num_rows = mysqli_num_rows($res);
    
            if ($num_rows > 0 && $uname == 'admin') {
                // create session called 'admin'
                session_start();
                $_SESSION['admin'] = true;
            }

            echo $num_rows;
 
    
        } else if($userType == 'teacher'){
            // execute teacher login query
            $q1= "SELECT * FROM teacher WHERE t_email='$uname' AND t_pass='$password'";
            $res = mysqli_query($con,$q1);
            $num_rows = mysqli_num_rows($res);
            $teacher = mysqli_fetch_assoc($res);
    
            if ($num_rows > 0 ) {
                // create session called 'teacher'
            if($teacher){
                session_start();
                // $_SESSION['teacher'] = true;
                $_SESSION['teacher'] = $teacher['t_id'];
            }
            }

            echo $num_rows;
    
        } else if($userType == 'student'){
            // execute student login query
            $q1= "SELECT * FROM student WHERE std_uname='$uname' AND std_pass='$password'";
            $res = mysqli_query($con,$q1);
            $num_rows = mysqli_num_rows($res);
            $student = mysqli_fetch_assoc($res);
    
            if ($num_rows > 0 ) {
                // create session called 'teacher'
            if($student){
                session_start();
                // $_SESSION['teacher'] = true;
                $_SESSION['student'] = $student['reg_no'];
            }
            }

            echo $num_rows;
    
        } else {
            // handle invalid userType
            echo "Invalid userType: " . $userType;
    
            mysqli_close($con);
    
            return 0;
        }
        mysqli_close($con);
    
    }

    function GetclassAttendance($date,$t_id){

        include 'connection.php';

        $view = "SELECT s.reg_no, s.std_name, c.cls_name, sc.sec_name, a.status_check
                 FROM attendance a
                 INNER JOIN student s ON s.reg_no = a.std_id AND s.cls_id = a.cls_id AND s.sec_id = a.sec_id
                 INNER JOIN class c ON c.cls_id = a.cls_id 
                 INNER JOIN section sc ON sc.sec_id = a.sec_id AND sc.cls_id = a.cls_id
                 WHERE a.date_updated = '$date' AND a.t_id = '$t_id'";

         return mysqli_query($con, $view);

    }

    function GetstdAttendance($date,$t_id,$std_id){

        include 'connection.php';

        // $date = $data['dateTaken'];
        // $t_id = $data['t_id'];

        $view = "SELECT s.reg_no, s.std_name, c.cls_name, sc.sec_name, a.status_check, a.date_updated
                FROM attendance a
                INNER JOIN student s ON s.reg_no = a.std_id AND s.cls_id = a.cls_id AND s.sec_id = a.sec_id
                INNER JOIN class c ON c.cls_id = a.cls_id 
                INNER JOIN section sc ON sc.sec_id = a.sec_id AND sc.cls_id = a.cls_id
                WHERE a.date_updated = '$date' AND a.t_id = '$t_id' AND s.reg_no = '$std_id'
                ";

        return mysqli_query($con, $view);
    }

    function getStuById($std_id){
        include 'connection.php';
    
        $q1= "SELECT * FROM student WHERE reg_no='$std_id' AND is_deleted='0'";
        return mysqli_query($con,$q1);
    }

    function GetAttendanceByCls($date,$cls_id,$sec_id){

        include 'connection.php';

        $count = checkStatusofCls($sec_id);

        if($count > 0){
            $view = "SELECT s.reg_no, s.std_name, c.cls_name, sc.sec_name, a.status_check
            FROM attendance a
            INNER JOIN student s ON s.reg_no = a.std_id AND s.cls_id = a.cls_id AND s.sec_id = a.sec_id
            INNER JOIN class c ON c.cls_id = a.cls_id 
            INNER JOIN section sc ON sc.sec_id = a.sec_id AND sc.cls_id = a.cls_id
            WHERE a.date_updated = '$date' AND c.cls_id = '$cls_id' AND sc.sec_id = '$sec_id'";
        }else{
            echo json_encode($count);
        }

         return mysqli_query($con, $view);

    }

    function checkStatusofCls($sec_id){

        include 'connection.php';

        $getall = "SELECT * FROM section WHERE sec_id = $sec_id AND is_assigned = '0' ";
        $check = mysqli_query($con,$getall);
        return mysqli_num_rows($check);
    }

    

?>