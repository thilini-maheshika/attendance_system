<?php
session_start();
include 'pages/header.php'; ?>

<?php
if (isset($_SESSION['teacher'])) {
    $getSection = fetchClassbyTeacher($_SESSION['teacher']);
    if(mysqli_num_rows($getSection) == 1) :

    $res = mysqli_fetch_assoc($getSection);
    $sec_id = $res['sec_id'];

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
            <div class="card-body">
                <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-xl-8">
                            <label class="form-control-label">Select Date<span class="text-danger ml-2">*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName"
                                placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                    <button type="button" name="submit" class="btn btn-success"
                        onclick="getreport(this.form,'<?php echo $_SESSION['teacher']; ?>')">View Report</button>
                </form>
            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive p-0">

                <div class="container p-5">
                    <?php
                    if (isset($_REQUEST['date'])) {

                        $date = $_REQUEST['date'];
                        $getatt = fetchAttendanceInDate($date);

                        if (mysqli_num_rows($getatt) > 0): ?>
                            <div class="row">
                                <a class="nav-link" href="report.php?sec_id=<?php echo $sec_id; ?>&&date=<?php echo $date; ?>">Report(xls)</a>
                            </div>
                        <?php else: ?>
                            <h3 class="text-primary p-5">No Data Found in this Date</h3>
                        <?php endif;
                    }

                    ?>
                </div>

            </div>
        </div>
        <?php include 'pages/footer.php'; ?>
        </div>
    </main>

<?php else :
    echo 'Something Went wrong Plase Contact Admin. Because You have more than 1 class';
endif; } else {
    header('Location: index.php');
    exit();
} ?>

</body>

</html>