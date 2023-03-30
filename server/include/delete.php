<?php
    function DeleteData($data){

        include 'connection.php';

        $field = $data['field'];
        $table = $data['table'];
        $id = $data['id'];

        $q1 = "UPDATE $table SET is_deleted='1' WHERE $field='$id'";
        return mysqli_query($con,$q1);
        
    }
?>