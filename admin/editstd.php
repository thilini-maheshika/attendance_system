<?php include 'pages/header.php'; 

    if(!isset($_REQUEST['reg_no'])){
        echo '<script>window.location.href="student.php"</script>';
    }
        $std_id = $_REQUEST['reg_no'];
    
?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <h4 class="modal-title" id="exampleModalLabel">Edit Student Details</h4>
            <form class="col-md-8 " method="POST" enctype="multipart/form-data" id="productinfo">
                <div class="modal-body">
                    <div class="form-row">
                        <?php

                                $std = getAllStdByID($std_id);
                                while($row = mysqli_fetch_assoc($std)){
                                        $std_name = $row['std_name'];
                                        $std_address = $row['std_address'];
                                        $std_phone = $row['std_phone'];
                                        $std_username = $row['std_uname'];
                                        $sec_id = $row['sec_id'];

                                ?>
                        <div class="form-group col-md-12">
                            <label for="name" class="a"><b>Student Name</b></label>
                            <input type="text" class="form-control"
                                onchange="EditData(this,<?php echo $std_id; ?>,'std_name','student','reg_no')"
                                id="name<?php echo $std_id; ?>" name="name" value="<?php echo $std_name?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="address" class="a"><b>Address</b></label>
                            <input type="text" class="form-control" 
                            onchange="EditData(this,<?php echo $std_id; ?>,'std_address','student','reg_no')" 
                            id="address<?php echo $std_id;?>" name="address" value="<?php echo $std_address?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="phone" class="a"><b>Phone No</b></label>
                            <input type="text" class="form-control" 
                            onchange="EditData(this,<?php echo $std_id; ?>,'std_phone','student','reg_no')"
                            id="phone<?php echo $std_id;?>" name="phone" value="<?php echo $std_phone?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="username" class="a"><b>Username</b></label>
                            <input type="text" class="form-control" 
                            onchange="EditData(this,<?php echo $std_id; ?>,'std_uname','student','reg_no')"
                            id="uname<?php echo $std_id; ?>" name="uname" value="<?php echo $std_username?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name" class="a"><b>Select Class</b></label>
                            <select type="text" class='form-control norad tx12' name="sec_id" onchange="loadclass(this, <?php echo $std_id; ?>, 'sec_id','student','reg_no', <?php echo  $sec_id; ?>)"
                            id="sec_id<?php echo $std_id;?>">
                            <option selected disabled>--Select Class--</option>
                            <?php 
                                $res = fetchSectionByall();
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $class_list = fetchClassBySectionId($row['cls_id']);
                                    $class_row = mysqli_fetch_assoc($class_list); ?>
                                        <option value='<?php  echo $row['sec_id']; ?>' <?php if($row['sec_id'] == $sec_id) : echo "selected"; endif; ?> ><?php echo $class_row['cls_name']." ".$row['sec_name'] ?></option>
                                <?php }
                            ?>
                            </select>
                        </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location.href='student.php'" class="btn btn-secondary"
                        data-bs-dismiss="modal">Back</button>
                </div>
            </form>
        </div>
        <?php include 'pages/footer.php'; ?>
    </div>
</main>

</body>

</html>