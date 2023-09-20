<?php include 'pages/header.php'; ?>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end"
                style="padding-bottom:0.7rem; margin-top:0.5rem;">
                <button class="btn btn-secondary me-md-2" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Add New</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Teacher Registration</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="col-md-12 " method="POST" novalidateenctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Teacher Name</b></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Teacher Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Email</b></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email Address">
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
                                    <label for="name" class="a"><b>Select Class</b></label>
                                    <select type="text" class='form-control norad tx12' name="sect" id="sect" required>
                                        <option selected disabled>--Select Class--</option>
                                        <?php
                                        $res = fetchSectionByall();
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $class_list = fetchClassBySectionId($row['cls_id']);
                                            $class_row = mysqli_fetch_assoc($class_list);
                                            if ($row['sec_id'] == $sec_id): ?>
                                                <option value='<?php echo $row['sec_id']; ?>' <?php if ($row['sec_id'] == $sec_id):
                                                       echo "selected";
                                                   endif; ?>><?php echo $class_row['cls_name'] . " " . $row['sec_name'] ?>
                                                </option>

                                            <?php endif;

                                            if (getCountUsingID($row['sec_id'], 'teacher', 'sec_id') == 0): ?>
                                                <option value='<?php echo $row['sec_id']; ?>'><?php echo $class_row['cls_name'] . " " . $row['sec_name'] ?>
                                                </option>
                                            <?php endif;
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
                            <button type="button" onclick="addTeacher(this.form)" name="submit"
                                class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Teachers Management</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table">
                            <thead class="table-dark" style="width: 100%;">
                                <tr>
                                    <th>#</th>
                                    <th>Teacher Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Class</th>
                                    <th>Date Registered</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getTeacher = fetchTeacher();

                                while ($row = mysqli_fetch_assoc($getTeacher)) {

                                    $id = $row['t_id'];
                                    $name = $row['t_name'];
                                    $email = $row['t_email'];
                                    $address = $row['t_address'];
                                    $phone = $row['t_phone'];
                                    $sec_id = $row['sec_id'];
                                    $regdate = $row['date_updated'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $id; ?>
                                        </td>
                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php echo $email; ?>
                                        </td>
                                        <td>
                                            <?php echo $address; ?>
                                        </td>
                                        <td>
                                            <?php echo $phone; ?>
                                        </td>

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
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-secondary btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <li><a class="dropdown-item"
                                                            href="editTe.php?t_id=<?php echo $id; ?>"><i
                                                                class="fa-solid fa-user-pen"></i> Edit </a></li>
                                                    <li><button class="dropdown-item"
                                                            onclick="deleteData(<?php echo $id; ?> ,'teacher','t_id')"><i
                                                                class="fa-solid fa-trash"></i> Delete </button></li>
                                                    <li><a class="dropdown-item"
                                                            href="editpassTe.php?t_id=<?php echo $id; ?>"><i
                                                                class="fa-solid fa-lock"></i>Change Credentials</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
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