<?php
include 'include/connection.php';
include 'include/add.php';
include '../server/include/common.php';
include '../server/include/edit.php';
include '../server/include/delete.php';

if(isset($_GET['function_code']) && $_GET['function_code'] == 'addStudent'){ 
    RegStudent($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'stdEdit'){
    EditStudent($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'delData'){
    DeleteData($_POST);
}
?>