<?php
include_once 'pages/header.php';
?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <?php include 'navbar.php'; ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class=" mb-4 mt-3">
                <h4 class="text-muted">

                    <?php
                    if (isset($_SESSION['admin'])) {
                        echo 'Admin Dashboard';
                    } else if (isset($_SESSION['teacher'])) {
                        echo 'Class Teacher Dashboard';
                    } else {
                        echo 'Student View';
                    }
                    ?>
                </h4>
            </div>
            <?php if (isset($_SESSION['admin'])) { ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-person-fill fs-1 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Students</h5>
                                <?php
                                $get_all_students = fetchStudent();
                                $total_students = mysqli_num_rows($get_all_students);
                                ?>
                                <p class="card-text">
                                    <?php echo $total_students; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-people-fill fs-1 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Teachers</h5>
                                <?php
                                $get_all_teachers = fetchTeacher();
                                $total_teachers = mysqli_num_rows($get_all_teachers);
                                ?>
                                <p class="card-text">
                                    <?php echo $total_teachers; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-journal-text fs-1 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Classes</h5>
                                <?php
                                $get_all_sections = fetchSection();
                                $total_sections = mysqli_num_rows($get_all_sections);
                                ?>
                                <p class="card-text">
                                    <?php echo $total_sections; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-journal-check fs-1 me-3"></i>
                            <div>
                                <h5 class="card-title">Today Attendance</h5>
                                <?php
                                $get_all_att = fetchAttendance();
                                $total_att = mysqli_num_rows($get_all_att);
                                ?>
                                <p class="card-text">
                                    <?php echo $total_att; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else if (isset($_SESSION['teacher'])) { ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-person-fill fs-1 me-3"></i>
                                <div>
                                    <h5 class="card-title">Total Students</h5>
                                <?php
                                $get_all_students = fetchStudent();
                                $total_students = mysqli_num_rows($get_all_students);
                                ?>
                                    <p class="card-text">
                                    <?php echo $total_students; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-secondary text-white">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-people-fill fs-1 me-3"></i>
                                <div>
                                    <h5 class="card-title">Total Teachers</h5>
                                <?php
                                $get_all_teachers = fetchTeacher();
                                $total_teachers = mysqli_num_rows($get_all_teachers);
                                ?>
                                    <p class="card-text">
                                    <?php echo $total_teachers; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-journal-text fs-1 me-3"></i>
                                <div>
                                    <h5 class="card-title">Total Classes</h5>
                                <?php
                                $get_all_sections = fetchSection();
                                $total_sections = mysqli_num_rows($get_all_sections);
                                ?>
                                    <p class="card-text">
                                    <?php echo $total_sections; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-journal-check fs-1 me-3"></i>
                                <div>
                                    <h5 class="card-title">Today Attendance</h5>
                                <?php
                                $get_all_att = fetchAttendance();
                                $total_att = mysqli_num_rows($get_all_att);
                                ?>
                                    <p class="card-text">
                                    <?php echo $total_att; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } else if (isset($_SESSION['student'])) { ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body d-flex align-items-center">
                                    <i class="bi bi-person-fill fs-1 me-3"></i>
                                    <div>
                                        <h5 class="card-title">Total Students</h5>
                                <?php
                                $get_all_students = fetchStudent();
                                $total_students = mysqli_num_rows($get_all_students);
                                ?>
                                        <p class="card-text">
                                    <?php echo $total_students; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-body d-flex align-items-center">
                                    <i class="bi bi-people-fill fs-1 me-3"></i>
                                    <div>
                                        <h5 class="card-title">Total Teachers</h5>
                                <?php
                                $get_all_teachers = fetchTeacher();
                                $total_teachers = mysqli_num_rows($get_all_teachers);
                                ?>
                                        <p class="card-text">
                                    <?php echo $total_teachers; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body d-flex align-items-center">
                                    <i class="bi bi-journal-text fs-1 me-3"></i>
                                    <div>
                                        <h5 class="card-title">Total Classes</h5>
                                <?php
                                $get_all_sections = fetchSection();
                                $total_sections = mysqli_num_rows($get_all_sections);
                                ?>
                                        <p class="card-text">
                                    <?php echo $total_sections; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

            <?php } ?>
        </div>


        <?php include 'pages/footer.php'; ?>
    </div>
</main>
</body>

</html>