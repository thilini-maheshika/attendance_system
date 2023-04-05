<?php

    //function for Add Student
    function RegStudent($data){

        include 'connection.php';

        $std_name = $data['name'];
        $std_address = $data['address'];
        $std_phone = $data['phone'];
        $std_uname = $data['uname'];
        $cls_id = $data['class'];
        $sec_id = $data['sect'];
        $std_pass = $data['pass'];

        $count = checkstdByUname($std_uname);

        if($count == 0){
            //insert query to table student
            $sql = "INSERT INTO student(std_name, std_address, std_phone, std_uname,cls_id,sec_id, std_pass, reg_date, is_deleted) VALUES ('$std_name', '$std_address', '$std_phone', '$std_uname','$cls_id','$sec_id', '$std_pass', NOW(), 0)";
            return mysqli_query($con, $sql);
        }else{
            echo json_encode($count);
        }
    
    }

     //function for Add Class
     function AddClass($data){

        include 'connection.php';

        $cls_name = $data['class'];

        $count = checkclsByName($cls_name);

        if($count == 0){
            //insert query to table class
            $sql = "INSERT INTO class(cls_name, is_deleted) VALUES ('$cls_name', 0)";
            return mysqli_query($con, $sql);
        }else{
            echo json_encode($count);
        }
    
    }

    //function for Add Section
    function AddSection($data){

        include 'connection.php';

        $cls_id = $data['class'];
        $sec_name = $data['section'];

        $count = checksecByName($sec_name);

        if($count == 0){
            //insert query to table section
            $sql = "INSERT INTO section(cls_id,sec_name,is_assigned,is_deleted) VALUES ('$cls_id','$sec_name',0, 0)";
            return mysqli_query($con, $sql);
        }else{
            echo json_encode($count);
        }
    
    }

    //function for Add Student
    function AddTeacher($data){

        include 'connection.php';

        $t_name = $data['name'];
        $t_email = $data['email'];
        $t_address = $data['address'];
        $t_phone = $data['phone'];
        $cls_id = $data['class'];
        $sec_id = $data['sect'];
        $t_pass = $data['pass'];

        $count = checkteacherByEmail($t_email);

        if($count == 0){
            //insert query to table Teacher
            $sql = "INSERT INTO teacher(t_name,t_email, t_address, t_phone, cls_id, sec_id, t_pass, date_updated, is_deleted) VALUES ('$t_name','$t_email','$t_address', '$t_phone', '$cls_id','$sec_id','$t_pass', NOW(), 0)";
            updateSection($sec_id);
            return mysqli_query($con, $sql);

        }else{
            echo json_encode($count);
        }
    }

    function GetAttendance($data){

        include 'connection.php';

        $id = $data['id'];
        $cls_id = $data['cls_id'];
        $sec_id = $data['sec_id'];
        $t_id = $data['t_id'];
        $status_checked = $data['status_checked'];

        $count = checkAttendanceOfDate();

        if($count == 0){
            //insert query to table Teacher
            $sql = "INSERT INTO attendance(std_id,cls_id, sec_id,t_id, status_check, date_updated) VALUES ('$id','$cls_id','$sec_id','$t_id', '$status_checked' , NOW())";
            return mysqli_query($con, $sql);

        }else{
            echo json_encode($count);
        }
        
    }



?>
