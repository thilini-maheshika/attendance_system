<?php
session_start();
include 'pages/header.php'; ?>

<?php
if (isset($_SESSION['admin'])) {
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <h4>View Reports</small>
                </h4>
            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive p-0">

                <div class="container p-5">
                    <?php $getsec = fetchAttendanceInSec($_REQUEST['sec_id']);
                            if(mysqli_num_rows($getsec) > 0) : ?>
                    <table class="table">
                        <thead class="table-dark" style="width: 100%;">
                            <tr>
                                <th>Date / Attendance</th>
                                <th>Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getsec = fetchAttendanceInSec($_REQUEST['sec_id']);
                            while ($row = mysqli_fetch_assoc($getsec)) {

                                ?>
                                <tr>
                                    <td>
                                        <a class="nav-link" href="getAttendance.php?sec_id=<?php echo $_REQUEST['sec_id']; ?>&&date=<?php echo $row['date_updated']; ?>"><?php echo $row['date_updated']; ?></a>
                                    </td>
                                    <td>
                                        <a class="nav-link" href="report.php?sec_id=<?php echo $_REQUEST['sec_id']; ?>&&date=<?php echo $row['date_updated']; ?>">Report(xls)</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php else :?><h2>No Attendance Logged</h2> <?php endif;  ?>
                </div>

            </div>
        </div>
        <?php include 'pages/footer.php'; ?>
        </div>
    </main>

<?php
} ?>

</body>

</html>