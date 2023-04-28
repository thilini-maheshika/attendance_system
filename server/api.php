<?php
include 'include/connection.php';
include 'include/add.php';
include '../server/include/common.php';
include '../server/include/edit.php';
include '../server/include/delete.php';

if(isset($_GET['function_code']) && $_GET['function_code'] == 'addStudent'){ 
    RegStudent($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'Editdata'){
    UpdateData($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'delData'){
    DeleteData($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'addcls'){
    AddClass($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'addsec'){
    AddSection($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'addTeacher'){
    AddTeacher($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'login'){
    CheckLogin($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'checkAttendance'){
    checkAttendanceBatch($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'fetchsec'){
    fetch_section($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'fetchsecTe'){
    fetch_sectionTe($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'fetchSecs'){
    fetchSectionByClsId($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'IsSectionAssigned'){
    IsSectionAssignedCheck($_POST);
}else if(isset($_GET['function_code']) && $_GET['function_code'] == 'getSectionHasStudentORTeacher'){
    getSectionHasStudentORTeacher($_GET);
}
?>
