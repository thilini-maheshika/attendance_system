<?php
session_start();
 include 'pages/header.php'; ?>

<?php 
    if (isset($_SESSION['teacher'])) {   

?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="col-12">
        <div class="container-fluid py-4">

            <?php

                $details = getAllTeByID($_SESSION['teacher']); 
                $row = mysqli_fetch_assoc($details);?>

            <h4>Teacher Profile</h4>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $row['t_name']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $row['t_email']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $row['t_phone']; ?></p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $row['t_address']; ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include 'pages/footer.php'; ?>
    </div>
</main>

<?php }else{
    header('Location: index.php');
    exit();
} ?>

</body>

</html>