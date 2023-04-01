<?php 
    //function for fetching data from database table student
    function fetchStudent(){

        include 'connection.php';

        $viewstd = "SELECT * FROM student WHERE is_deleted = '0'";
        return mysqli_query($con, $viewstd);
        
    }

    function fetchClass(){

        include 'connection.php';

        $viewcls = "SELECT * FROM class WHERE is_deleted = '0'";
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

?>