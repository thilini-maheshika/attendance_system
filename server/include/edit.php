<?php

    function UpdateData($data){

        include 'connection.php';

        $id = $data['id'];
        $field = $data['field'];
        $value = $data['value']; 
        $table = $data['table'];
        $table_id = $data['tbl_id'];
            
        $sql1 = "UPDATE $table SET $field='$value'  WHERE $table_id='$id'";
        return mysqli_query($con, $sql1);

    }
    

?>