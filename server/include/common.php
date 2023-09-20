<?php

function checkstdByUname($std_uname)
{
    include 'connection.php';

    $q1 = "SELECT * FROM student WHERE std_uname='$std_uname' AND is_deleted='0'";
    $uname_check = mysqli_query($con, $q1);
    return mysqli_num_rows($uname_check);
}

function getAllStdByID($std_id)
{

    include 'connection.php';

    $q1 = "SELECT * FROM student WHERE reg_no='$std_id' AND is_deleted='0'";
    return mysqli_query($con, $q1);
}

function checkclsByName($cls_name)
{
    include 'connection.php';

    $q1 = "SELECT * FROM class WHERE cls_name='$cls_name' AND is_deleted='0'";
    $class_check = mysqli_query($con, $q1);
    return mysqli_num_rows($class_check);
}

function checksecByClsID($cls_id)
{
    include 'connection.php';

    $q1 = "SELECT * FROM section WHERE cls_id='$cls_id' AND is_deleted='0'";
    $sec_check = mysqli_query($con, $q1);
    return mysqli_num_rows($sec_check);
}

function fetchSectionByClsId($class)
{

    include 'connection.php';

    $viewsec = "SELECT * FROM section WHERE cls_id = $class AND is_deleted = '0' AND is_assigned = '0'";
    return mysqli_query($con, $viewsec);
}

function getSectionHasStudentORTeacher($sec_id)
{
    include 'connection.php';

    $sec_id = $sec_id['id'];

    $viewd = "SELECT * FROM student WHERE is_deleted = 0 AND sec_id = '$sec_id'";
    $stu_res = mysqli_query($con, $viewd);

    $viewt = "SELECT * FROM teacher WHERE is_deleted = 0 AND sec_id = '$sec_id'";
    $tea_res = mysqli_query($con, $viewt);

    if (getCountUsingID($sec_id, 'student', 'sec_id') > 0) {
        echo getCountUsingID($sec_id, 'student', 'sec_id');
    } else if (getCountUsingID($sec_id, 'teacher', 'sec_id') > 0) {
        echo getCountUsingID($sec_id, 'teacher', 'sec_id');
    }
}

function getCountUsingID($id, $table, $field)
{

    include 'connection.php';

    $viewcls = "SELECT * FROM $table WHERE is_deleted = '0' AND $field = '$id'";
    $res = mysqli_query($con, $viewcls);
    return mysqli_num_rows($res);

}

function fetchClassBySectionId($cls_id)
{

    include 'connection.php';

    $viewsec = "SELECT * FROM class WHERE cls_id = '$cls_id'";
    return mysqli_query($con, $viewsec);
}


function fetchSectionByall()
{

    include 'connection.php';

    $viewsec = "SELECT * FROM section WHERE is_deleted = 0";
    return mysqli_query($con, $viewsec);
}

function fetchSectionByallinClass()
{

    include 'connection.php';

    $viewsec = "SELECT * FROM section WHERE is_deleted = 0";
    return mysqli_query($con, $viewsec);
}

function IsSectionAssignedCheck($sec_id)
{

    include 'connection.php';

    $sql = "SELECT is_assigned FROM section WHERE sec_id = '$sec_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['is_assigned'] === '1' ? 'true' : 'false';
}



function checkTeacherByEmail($uname)
{

    include 'connection.php';

    $q1 = "SELECT * FROM teacher WHERE t_email='$uname' AND is_deleted='0'";
    $res = mysqli_query($con, $q1);
    return mysqli_num_rows($res);
}

function getSecById($sec_id)
{
    include 'connection.php';

    $q1 = "SELECT * FROM section WHERE sec_id='$sec_id' AND is_deleted='0'";
    return mysqli_query($con, $q1);
}

function fetch_section($data)
{
    include 'connection.php';

    $cls_id = $data['value'];

    $sql = "SELECT sec_id,sec_name FROM section WHERE cls_id = $cls_id AND is_assigned = 1 AND is_deleted = 0";
    $result = mysqli_query($con, $sql);
    $sections = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row;
    }

    // Return the fetched sections as JSON
    echo json_encode($sections);
}

function fetch_sectionTe($data)
{
    include 'connection.php';

    $cls_id = $data['value'];

    $sql = "SELECT sec_id,sec_name FROM section WHERE cls_id = $cls_id AND is_assigned = 0 AND is_deleted = 0";
    $result = mysqli_query($con, $sql);
    $sections = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row;
    }

    // Return the fetched sections as JSON
    echo json_encode($sections);
}

function getClassbyID($cls_id)
{

    include 'connection.php';

    $viewcls = "SELECT * FROM class WHERE cls_id='$cls_id' AND is_deleted='0'";
    return mysqli_query($con, $viewcls);

}

function getClassbySectionID($cls_id)
{

    include 'connection.php';

    $viewcls = "SELECT * FROM section WHERE cls_id='$cls_id'";
    return mysqli_query($con, $viewcls);

}

function getAllTeByID($t_id)
{
    include 'connection.php';

    $q1 = "SELECT * FROM teacher WHERE t_id='$t_id' AND is_deleted='0'";
    return mysqli_query($con, $q1);
}

function checkAttendanceOfDate()
{
    include 'connection.php';

    $q1 = "SELECT * FROM attendance WHERE DATE(date_updated) = CURDATE()";
    $check = mysqli_query($con, $q1);
    return mysqli_num_rows($check);
}

function CheckLogin($data)
{
    include 'connection.php';

    $userType = $data['userType'];
    $uname = $data['userName'];
    $password = $data['password'];

    if ($userType == 'admin') {
        // execute admin login query
        $q1 = "SELECT * FROM tbl_admin WHERE ad_email='$uname' AND ad_pass='$password'";
        $res = mysqli_query($con, $q1);
        $num_rows = mysqli_num_rows($res);

        if ($num_rows > 0 && $uname == 'admin') {
            // create session called 'admin'
            session_start();
            $_SESSION['admin'] = true;
        }

        echo $num_rows;


    } else if ($userType == 'teacher') {
        // execute teacher login query
        $q1 = "SELECT * FROM teacher WHERE t_email='$uname' AND t_pass='$password' AND is_deleted = 0";
        $res = mysqli_query($con, $q1);
        $num_rows = mysqli_num_rows($res);
        $teacher = mysqli_fetch_assoc($res);

        if ($num_rows > 0) {
            // create session called 'teacher'
            if ($teacher) {
                session_start();
                // $_SESSION['teacher'] = true;
                $_SESSION['teacher'] = $teacher['t_id'];
            }
        }

        echo $num_rows;

    } else if ($userType == 'student') {
        // execute student login query
        $q1 = "SELECT * FROM student WHERE std_uname='$uname' AND std_pass='$password' AND is_deleted = 0";
        $res = mysqli_query($con, $q1);
        $num_rows = mysqli_num_rows($res);
        $student = mysqli_fetch_assoc($res);

        if ($num_rows > 0) {
            // create session called 'teacher'
            if ($student) {
                session_start();
                // $_SESSION['teacher'] = true;
                $_SESSION['student'] = $student['reg_no'];
            }
        }

        echo $num_rows;

    } else {
        // handle invalid userType
        echo "Invalid userType: " . $userType;

        mysqli_close($con);

        return 0;
    }
    mysqli_close($con);

}

function GetclassAttendance($date, $sec_id)
{

    include 'connection.php';

    $view = "SELECT *  FROM attendance JOIN student ON student.reg_no = attendance.std_id 
            JOIN section ON section.sec_id = attendance.sec_id 
                 WHERE attendance.date_updated = '$date' AND attendance.sec_id = '$sec_id' GROUP BY reg_no";

    return mysqli_query($con, $view);

}
function GetclassAttendanceBySec($sec_id)
{

    include 'connection.php';

    $view = "SELECT *  FROM attendance JOIN student ON student.reg_no = attendance.std_id 
            JOIN section ON section.sec_id = attendance.sec_id  JOIN class ON class.cls_id = class.cls_id 
                 WHERE attendance.sec_id = '$sec_id' GROUP BY reg_no";

    return mysqli_query($con, $view);

}

function GetstdAttendance($std_id)
{

    include 'connection.php';

    $view = "SELECT s.reg_no, s.std_name, c.cls_name, sc.sec_name, a.status_check, a.date_updated
    FROM attendance a
    INNER JOIN student s ON s.reg_no = a.std_id AND s.sec_id = a.sec_id
    INNER JOIN class c ON c.cls_id = a.sec_id 
    INNER JOIN section sc ON sc.sec_id = a.sec_id 
    WHERE s.reg_no = '$std_id'  
    AND YEAR(a.date_updated) = YEAR(NOW())
    GROUP BY date_updated 
    ORDER BY date_updated DESC;
    
                ";

    return mysqli_query($con, $view);
}

function getStuById($std_id)
{
    include 'connection.php';

    $q1 = "SELECT * FROM student WHERE reg_no='$std_id' AND is_deleted='0'";
    return mysqli_query($con, $q1);
}

// function GetAttendanceByCls($date,$cls_id,$sec_id){

//     include 'connection.php';

//     $count = checkStatusofCls($sec_id);

//     if($count > 0){
//         $view = "SELECT s.reg_no, s.std_name, c.cls_name, sc.sec_name, a.status_check
//         FROM attendance a
//         INNER JOIN student s ON s.reg_no = a.std_id AND s.sec_id = a.sec_id
//         INNER JOIN class c ON c.cls_id = a.sec_id 
//         INNER JOIN section sc ON sc.sec_id = a.sec_id 
//         WHERE a.date_updated = '$date' AND c.cls_id = '$cls_id' AND sc.sec_id = '$sec_id'";

//     return mysqli_query($con, $view);

//     }else{
//         echo json_encode($count);
//     }
// }

// function checkStatusofCls($sec_id){

//     include 'connection.php';

//     $getall = "SELECT * FROM section WHERE sec_id = $sec_id AND is_assigned = '0' ";
//     $check = mysqli_query($con,$getall);
//     return mysqli_num_rows($check);
// }


function checkStatus($sec_id)
{
    include 'connection.php';

    $sql = "SELECT COUNT(*) as count FROM section WHERE sec_id = '$sec_id' AND is_assigned = '1'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}



?>