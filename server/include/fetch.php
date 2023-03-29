<?php 
    //function for fetching data from database table student
    function fetchStudent(){

        include 'connection.php';

        $viewstd = "SELECT * FROM student WHERE is_deleted = '0'";
        return mysqli_query($con, $viewstd);
        
    }

?>