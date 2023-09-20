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
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col">
                <?php $r1 = fetchAll($_SESSION['teacher']);
                $row1 = mysqli_fetch_assoc($r1) ; ?>
                <h4>Take Attendance - <small class="text-muted"><?php echo $row1['cls_name'] ?>(<?php echo $row1['sec_name']?>)</small></h4>
            </div>
            <div class="col text-right">
                <h4><small class="text-muted">(Today's Date : <?php echo date('d-M-Y'); ?>)</small></h4>
            </div>
        </div>


        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <h6>All Students</h6>
                </div>
                <div class="card-body px-0 pt-2 pb-2">
                    <div class="table-responsive p-0">
                        <form action="" method="post">
                            <table class="table">
                                <thead class="table-dark" style="width: 100%;">
                                    <tr>
                                        <th>Registration No</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Check</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $getstd = fetchAll($_SESSION['teacher']); 

                                        while($row = mysqli_fetch_assoc($getstd)){

                                        $id = $row['reg_no'];
                                        $name = $row['std_name'];
                                        $cls_id = $row['cls_id'];
                                        $cls_name = $row['cls_name'];
                                        $sec_id = $row['sec_id'];
                                        $sec_name = $row['sec_name'];

                                        ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <?php
                                            $sec = getSecById($sec_id);
                                            while($row2 = mysqli_fetch_assoc($sec)){
                                                $class_list = fetchClassBySectionId($row2['cls_id']);
                                                $class_row = mysqli_fetch_assoc($class_list);

                                                $sec_name = $class_row['cls_name']." ". $row2['sec_name'];
                                        ?>

                                    <td><?php echo $sec_name; ?></td>
                                    <?php } ?>
                                        <td>
                                            <input type="checkbox" name="check" id="check_<?php echo $id; ?>"
                                                value="<?php echo $id; ?>" data-id="<?php echo $id; ?>"
                                                data-clsid="<?php echo $cls_id; ?>" data-secid="<?php echo $sec_id; ?>">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <button type="button" name="submit" class="btn btn-success"
                                onclick="handleCheckboxChange(this.form,'<?php echo $_SESSION['teacher']; ?>')">Take
                                Attendance</button>
                        </form>


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