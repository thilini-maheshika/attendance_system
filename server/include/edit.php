<?php

    function EditStudent($data){

        include 'connection.php';

        $std_id = $data['std_id'];
        $field = $data['field'];
        $value = $data['value']; 
            
        $sql1 = "UPDATE student SET $field='$value'  WHERE reg_no='$std_id'";
        return mysqli_query($con, $sql1);
    }

?>