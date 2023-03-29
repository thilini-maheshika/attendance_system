<?php
include 'include/connection.php';
include 'include/add.php';
include '../server/include/common.php';

if(isset($_GET['function_code']) && $_GET['function_code'] == 'addStudent'){
    
    RegStudent($_POST);
    
}
?>