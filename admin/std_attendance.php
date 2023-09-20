<?php
session_start();
include 'pages/header.php'; ?>

<?php
if (isset($_SESSION['student'])) {

    ?>

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <h4>My Attendance</h4>
            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive p-0">
                <?php
                if (isset($_SESSION['student'])) {
                    $std_id = $_SESSION['student'];
                    $getatt = GetstdAttendance($std_id); 
                    if(mysqli_num_rows($getatt) > 0) :?>

                    <table class="table">
                        <thead class="table-dark" style="width: 100%;">
                            <tr>
                                <th>Registration No</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Attendance</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($getatt)) {
                                $status = $row['status_check'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['reg_no']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['std_name']; ?>
                                    </td>
                                    <?php
                                    $sec_name = $row['cls_name'] . " " . $row['sec_name'];
                                    ?>
                                    <td>
                                        <?php echo $sec_name; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($status == 1) { ?>
                                            <button class="btn btn-sm btn-warning" disabled="disabled">Present</button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-danger" disabled="disabled">Absent</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $row['date_updated']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php else : ?> <p class="p-5">No any Attendance</p><?php endif; } ?>

            </div>
        </div>
        <?php include 'pages/footer.php'; ?>
        </div>
    </main>

<?php } else {
    header('Location: index.php');
    exit();
} ?>

</body>

</html>