<?php

    function checkstdByUname($std_uname){
        include 'connection.php';
    
        $q1= "SELECT * FROM student WHERE std_uname='$std_uname' AND is_deleted='0'";
        $uname_check = mysqli_query($con,$q1);
        return mysqli_num_rows($uname_check);
    }

    function getAllStdByID($std_id){
        include 'connection.php';
    
        $q1= "SELECT * FROM student WHERE reg_no='$std_id' AND is_deleted='0'";
        return mysqli_query($con,$q1);
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

    function checkteacherByEmail($t_email){
        include 'connection.php';
    
        $q1= "SELECT * FROM teacher WHERE t_email='$t_email' AND is_deleted='0'";
        $email_check = mysqli_query($con,$q1);
        return mysqli_num_rows($email_check);
    }

    function getAllTeByID($t_id){
        include 'connection.php';
    
        $q1= "SELECT * FROM teacher WHERE t_id='$t_id' AND is_deleted='0'";
        return mysqli_query($con,$q1);
    }
?>