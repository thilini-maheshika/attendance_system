<?php
include 'pages/auth.php';
require_once '../server/include/connection.php';
require_once '../server/api.php';


?>

<script src="assets/js/script.js"></script>


<!-- Navbar -->
<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-nav ">
                <a href="index.php" class="nav-item nav-link active"><i class="fas fa-home-alt me-2"></i>Dashboard</a>

                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] != '') { ?>
                    <a href="student.php" class="nav-item nav-link "><i class="fas fa-user-graduate me-2"></i>Students</a>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseBootstrapcon" aria-expanded="false"
                            aria-controls="collapseBootstrapcon">
                            <i class="fa fa-users me-2"></i>
                            <span>Class Manage</span>
                        </a>
                        <div class="collapse ml-3" id="collapseBootstrapcon">
                            <div class="bg-white">
                                <a class="nav-link" href="class.php">Create Grade</a>
                            </div>
                            <div class="bg-white">
                                <a class="nav-link" href="section.php">Create Classroom</a>
                            </div>
                        </div>
                    </li>
                    <a href="teacher.php" class="nav-item nav-link"><i
                            class="fas fa-chalkboard-teacher me-2"></i>Teachers</a>
                <?php } else if ((isset($_SESSION['teacher']) && $_SESSION['teacher'] != '')) {
                    ?>
                        <a href="student.php" class="nav-item nav-link "><i class="fas fa-user-graduate me-2"></i>Students</a>

                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseAttendance" aria-expanded="false" aria-controls="collapseAttendance">
                                <i class="fa fa-users me-2"></i>
                                <span>Attendance</span>
                            </a>
                            <div class="collapse ml-3" id="collapseAttendance">
                                <div class="bg-white">
                                    <a class="nav-link" href="takeattendance.php">Take Attendance</a>
                                </div>
                                <div class="bg-white">
                                    <a class="nav-link" href="viewattendance.php">View Class Attendance</a>
                                </div>
                                <div class="bg-white">
                                    <a class="nav-link" href="stdAttendance.php">View Student Attendance</a>
                                </div>
                                <div class="bg-white">
                                    <a class="nav-link" href="get_report.php">Reports</a>
                                <?php ?>

                                </div>
                            </div>
                        </li>
                <?php } else if (isset($_SESSION['student']) && $_SESSION['student'] != '') { ?>
                            <a href="std_attendance.php" class="nav-item nav-link"><i
                                    class="fas fa-chalkboard-teacher me-2"></i>Attendance</a>
                <?php } ?>
                <!-- <a href="" class="nav-item nav-link"><i class="fa fa-list me-2"></i>Customize Page</a> -->


            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="assets/img/school_logo.png" height="50em" alt="Logo" loading="lazy" />
                <span class="ms-1 font-weight-bold">School Management System /<span
                        style="color: gray; font-size: 0.9em;">Al Adhan Maha Vidyalaya - Badulla</span></span>
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row" style="margin-right: 20px;">
                <?php

                if (isset($_SESSION['teacher'])) {
                    $r1 = fetchAll($_SESSION['teacher']);
                    $row1 = mysqli_fetch_assoc($r1); ?>

                    <span style="color: gray; font-size: 0.9em;">Welcome
                        <?php echo $row1['t_name']; ?>
                    </span>

                <?php } else if (isset($_SESSION['admin'])) { ?>

                        <span style="color: gray; font-size: 0.9em;">Welcome Admin </span>

                <?php } else if (isset($_SESSION['student'])) {

                    $r1 = getStuById($_SESSION['student']);
                    $row1 = mysqli_fetch_assoc($r1); ?>

                            <span style="color: gray; font-size: 0.9em;">Welcome
                        <?php echo $row1['std_name']; ?>
                            </span>

                <?php } ?>
                <!-- Avatar -->
                <li class="nav-item dropdown" style="margin-left: 20px;">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i style="font-size: 20px;" class="fas fa-user-edit" height="20px" alt="Avatar"
                            loading="lazy"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                        <?php if (isset($_SESSION['teacher'])) { ?>
                            <li>
                                <a class="dropdown-item" href="tProfile.php">My Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="editpassTe.php?t_id=<?php echo $_SESSION['teacher']; ?>">Change Password</a>
                            </li>
                        <?php } else if (isset($_SESSION['admin'])) { ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="editpassAdmin.php?ad_id=<?php echo $_SESSION['admin']; ?>">Change Password</a>
                                </li>
                        <?php } else if (isset($_SESSION['student'])) { ?>
                                    <li>
                                        <a class="dropdown-item"
                                            href="editpassStd.php?reg_no=<?php echo $_SESSION['student']; ?>">Change Password</a>
                                    </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 50px;">
    <div class="container pt-2"></div>
</main>
<!--Main layout-->
<!-- End Navbar -->