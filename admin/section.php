<?php include 'pages/header.php';
?>


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
                        <h4 class="modal-title" id="exampleModalLabel">Create Class</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="col-md-12 " method="POST" novalidateenctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Class</b></label>
                                    <select type="text" class='form-control norad tx12' name="class" id="class">
                                        <option selected></option>
                                        <?php
                                        $res = fetchClass();
                                        $count = 1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option value='" . $row['cls_id'] . "'>" . $row['cls_name'] . "</option>";
                                            $count++;
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Section Name</b></label>
                                    <input type="text" class="form-control" id="section" name="section"
                                        placeholder="Section Name">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="addSec(this.form)" name="submit" class="btn btn-dark">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Classroom Management</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table">
                            <thead class="table-dark" style="width: 100%;">
                                <tr>
                                    <th>#</th>
                                    <th>Grade</th>
                                    <th>Classroom</th>
                                    <th>Status</th>
                                    <th>Attendance</th>
                                    <th style="width:8em;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getsec = fetchSection();

                                while ($row = mysqli_fetch_assoc($getsec)) {

                                    $cls_id = $row['cls_id'];
                                    $id = $row['sec_id'];
                                    $name = $row['sec_name'];
                                    $status = $row['is_assigned'];

                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $id; ?>
                                        </td>

                                        <?php

                                        $cls = getClassbyID($cls_id);
                                        while ($row1 = mysqli_fetch_assoc($cls)) {

                                            $cls_name = $row1['cls_name'];


                                            ?>
                                            <td>
                                                <?php echo $cls_name; ?>
                                            </td>

                                        <?php } ?>

                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php

                                            if ($status == 0) {
                                                echo 'UnAssigned';
                                            } else {
                                                echo 'Assigned';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($status == 1 && isset($_SESSION['admin'])) { ?>
                                                <a href="get_attendance_admin.php?sec_id=<?php echo $id; ?>"
                                                    class="btn btn-info btn-sm">Attendance </a>
                                            <?php } ?>
                                        </td>
                                        <?php if ($status == 0 && isset($_SESSION['admin'])) { ?>
                                            <td><button class="btn btn-danger btn-sm"
                                                    onclick="deleteSection(<?php echo $id; ?> ,'section','sec_id')"><i
                                                        class="fa-solid fa-trash"></i> Delete </button></td>
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