<?php include 'pages/header.php';
session_start(); ?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <?php if (isset($_SESSION['admin'])) { ?>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-bottom:0.7rem;">
                    <button class="btn btn-secondary me-md-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Add New</button>
                </div>
            <?php } ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Student Registration</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="col-md-12 " method="POST" novalidateenctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Student Name</b></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Student Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address" class="a"><b>Address</b></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone" class="a"><b>Phone No</b></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Phone No">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="username" class="a"><b>Username</b></label>
                                    <input type="text" class="form-control" id="uname" name="uname"
                                        placeholder="Username">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Select Class</b></label>
                                    <select type="text" class='form-control norad tx12' name="sect" id="sect"
                                        onchange="fetchSectionByall()" required>
                                        <option selected disabled>--Select Class--</option>
                                        <?php
                                        $res = fetchSectionByall();
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $class_list = fetchClassBySectionId($row['cls_id']);
                                            $class_row = mysqli_fetch_assoc($class_list);

                                            echo "<option value='" . $row['sec_id'] . "'>" . $class_row['cls_name'] . "" . $row['sec_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password" class="a"><b>Password</b></label>
                                    <input type="password" class="form-control" id="pass" name="pass"
                                        placeholder="Password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="confirmpassword" class="a"><b>Confirm Password</b></label>
                                    <input type="password" class="form-control" id="confpass" name="confpass"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="addStudent(this.form)" name="submit"
                                class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Students Management</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table">
                            <thead class="table-dark" style="width: 100%;">
                                <tr>
                                    <th>Registration No</th>
                                    <th>Student Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th>Username</th>
                                    <?php } ?>
                                    <th>Class</th>
                                    <th>Registered Date</th>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th>Attendance</th>
                                        <th colspan="2">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                if (isset($_SESSION['admin']) && $_SESSION['admin'] != '') {
                                    $getstd = fetchStudent();
                                } else if (isset($_SESSION['teacher']) && $_SESSION['teacher'] != '') {
                                    $getSection = fetchClassbyTeacher($_SESSION['teacher']);
                                    if (mysqli_num_rows($getSection) == 1) {
                                        $res = mysqli_fetch_assoc($getSection);
                                        $getstd = fetchStudentinClass($res['sec_id']);
                                    }
                                } else {
                                    $getstd = fetchStudent();
                                }

                                while ($row = mysqli_fetch_assoc($getstd)) {
                                    $id = $row['reg_no'];
                                    $name = $row['std_name'];
                                    $address = $row['std_address'];
                                    $phone = $row['std_phone'];
                                    $uname = $row['std_uname'];
                                    $sec_id = $row['sec_id'];
                                    $regdate = $row['reg_date'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $id; ?>
                                        </td>
                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php echo $address; ?>
                                        </td>
                                        <td>
                                            <?php echo $phone; ?>
                                        </td>

                                        <?php if (isset($_SESSION['admin'])) { ?>

                                            <td>
                                                <?php echo $uname; ?>
                                            </td>
                                        <?php } ?>

                                        <?php
                                        $sec = getSecById($sec_id);
                                        while ($row2 = mysqli_fetch_assoc($sec)) {
                                            $class_list = fetchClassBySectionId($row2['cls_id']);
                                            $class_row = mysqli_fetch_assoc($class_list);

                                            $sec_name = $class_row['cls_name'] . " " . $row2['sec_name'];
                                            ?>

                                            <td>
                                                <?php echo $sec_name; ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <?php echo $regdate; ?>
                                        </td>

                                        <?php if (isset($_SESSION['admin'])) { ?>

                                            <td>
                                                <a href="studentAttendance.php?std_id=<?php echo $id; ?>"
                                                    class="btn btn-info btn-sm">Attendance </a>
                                            </td>


                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                        class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <li><a class="dropdown-item"
                                                                href="editstd.php?reg_no=<?php echo $id; ?>"><i
                                                                    class="fa-solid fa-user-pen"></i> Edit </a></li>
                                                        <li><button class="dropdown-item"
                                                                onclick="deleteData(<?php echo $id; ?> ,'student','reg_no')"><i
                                                                    class="fa-solid fa-trash"></i> Delete </button></li>
                                                        <li><a class="dropdown-item"
                                                                href="editpassStd.php?reg_no=<?php echo $id; ?>"><i
                                                                    class="fa-solid fa-lock"></i>Change Credentials</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>

                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <?php include 'pages/footer.php'; ?>
    </div>
</main>

</body>

</html>