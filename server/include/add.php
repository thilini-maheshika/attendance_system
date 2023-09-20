<?php

    //function for Add Student
    function RegStudent($data){

        include 'connection.php';

        $std_name = $data['name'];
        $std_address = $data['address'];
        $std_phone = $data['phone'];
        $std_uname = $data['uname'];
        $sec_id = $data['sect'];
        $std_pass = $data['pass'];

        $count = checkstdByUname($std_uname);

        if($count == 0){
            //insert query to table student
            $sql = "INSERT INTO student(std_name, std_address, std_phone, std_uname,sec_id, std_pass, reg_date, is_deleted) VALUES ('$std_name', '$std_address', '$std_phone', '$std_uname','$sec_id', '$std_pass', NOW(), 0)";
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
    
        // check if section name already exists for the selected class
        $sql_check = "SELECT * FROM section WHERE cls_id = '$cls_id' AND sec_name = '$sec_name' AND is_deleted = 0";
        $result_check = mysqli_query($con, $sql_check);
        $count_check = mysqli_num_rows($result_check);
    
        if($count_check == 0){
            // insert query to table section
            $sql_insert = "INSERT INTO section(cls_id, sec_name, is_assigned, is_deleted) VALUES ('$cls_id', '$sec_name', 0, 0)";
            return mysqli_query($con, $sql_insert);
        }else{
            echo json_encode($count_check);
        }
    
    }
    

    //function for Add Student
    function AddTeacher($data){
        include 'connection.php';
    
        $t_name = $data['name'];
        $t_email = $data['email'];
        $t_address = $data['address'];
        $t_phone = $data['phone'];
        $sec_id = $data['sect'];
        $t_pass = $data['pass'];
    
        $count = checkteacherByEmail($t_email);
    
        if($count == 0){
            // Check if the teacher is already assigned to this section/class
            $sql_check = "SELECT COUNT(*) FROM teacher WHERE sec_id = '$sec_id' AND t_email = '$t_email'";
            $result_check = mysqli_query($con, $sql_check);
            $row_check = mysqli_fetch_array($result_check);
            $count_check = $row_check[0];
    
            if($count_check == 0) {
                // insert query to table Teacher
                $sql = "INSERT INTO teacher(t_name,t_email, t_address, t_phone, sec_id, t_pass, date_updated, is_deleted) VALUES ('$t_name','$t_email','$t_address', '$t_phone','$sec_id','$t_pass', NOW(), 0)";
                mysqli_query($con, $sql);
    
                // update the section table's is_assigned column to 1 for the corresponding section
                $sql_update = "UPDATE section SET is_assigned = 1 WHERE sec_id = '$sec_id'";
                mysqli_query($con, $sql_update);
            } else {
                echo json_encode(0);
            }
        } else {
            echo json_encode(1);
        }
    }
    
    function checkAttendanceBatch() {
        include 'connection.php';
    
        $t_id = $_POST['t_id'];
        $ids = json_decode($_POST['ids'], true);
    
        foreach ($ids as $id) {
            $std_id = $id['id'];
            $sec_id = $id['sec_id'];
            $status_checked = $id['checked']; // Get the checked status from the selectedIds array
    
            $count = isAttendanceTaken($std_id);
    
            if($count == 0 ){
                $sql = "INSERT INTO attendance(std_id, sec_id, t_id, status_check, date_updated) 
                    VALUES ('$std_id', '$sec_id', '$t_id', '$status_checked', Now())";
                $result = mysqli_query($con, $sql);
            }
        }
    
        echo json_encode($count);
    }
    
    
    function isAttendanceTaken($std_id) {
        include 'connection.php';
    
        $today = date("Y-m-d");
        $sql = "SELECT * FROM attendance WHERE std_id='$std_id' AND date_updated='$today'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
    
        return $count > 0 ? 1 : 0; // return 1 if attendance was taken, 0 otherwise
    }
    
    
    
    



?>
