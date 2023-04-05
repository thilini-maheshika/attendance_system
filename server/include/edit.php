<?php

    function UpdateData($data){

        include 'connection.php';

        $id = $data['id'];
        $field = $data['field'];
        $value = $data['value']; 
        $table = $data['table'];
        $table_id = $data['tbl_id'];
            
        $sql1 = "UPDATE $table SET $field='$value'  WHERE $table_id='$id'";
        if($table == 'teacher'){
            updateSection($value);
        }
        return mysqli_query($con, $sql1);


    }

    function updateSection($sec_id){

        include 'connection.php';
        
        $sql = "UPDATE section SET is_assigned = (CASE WHEN sec_id = '$sec_id' THEN 1 ELSE 0 END)";
        $result = mysqli_query($con, $sql);
    }

?>