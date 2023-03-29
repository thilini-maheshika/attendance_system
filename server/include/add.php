<?php

    //function for Add Student
    function RegStudent($data){

        include 'connection.php';

        $std_name = $data['name'];
        $std_address = $data['address'];
        $std_phone = $data['phone'];
        $std_uname = $data['uname'];
        $std_pass = $data['pass'];

        $count = checkstdByUname($std_uname);

        if($count == 0){
            //insert query to table student
            $sql = "INSERT INTO student(std_name, std_address, std_phone, std_uname, std_pass, reg_date, is_deleted) VALUES ('$std_name', '$std_address', '$std_phone', '$std_uname', '$std_pass', NOW(), 0)";
            return mysqli_query($con, $sql);
        }else{
            echo json_encode($count);
        }

        

    }
?>