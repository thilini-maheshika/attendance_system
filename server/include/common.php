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
?>