<?php include 'pages/header.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="assets/css/sign_in.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>

<body>
<div class="wrapper">
        <div class="logo">
            <img src="assets/img/school_img.svg" alt="">
        </div>
        <div class="text-center mt-4 name">
            <h4>Sign In</h4>
        </div>
        <form class="p-3 mt-6" method="POST">

            <div >
                <select required name="userType" class="form-control mb-3" style="width:100%;">
                    <option value="">--Select User Roles--</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">ClassTeacher</option>
                        <option value="student">Student</option>
                </select>                             
            </div>
            <div class="form-field  align-items-center mt-3">
                <input type="text" name="userName" id="userName" placeholder="Username/Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button class="btn mt-3" onclick="userLogin(this.form)" type="button">Login</button>
        </form>
    </div>

</body>

</html>