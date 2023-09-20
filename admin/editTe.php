<?php include 'pages/header.php';

if (!isset($_REQUEST['t_id'])) {
    echo '<script>window.location.href="teacher.php"</script>';
}
$t_id = $_REQUEST['t_id'];

?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <h4 class="modal-title" id="exampleModalLabel">Edit Teacher Details</h4>
            <form class="col-md-8 " method="POST" enctype="multipart/form-data" id="productinfo">
                <div class="modal-body">
                    <div class="form-row">
                        <?php

                        $teacher = getAllTeByID($t_id);
                        while ($row = mysqli_fetch_assoc($teacher)) {

                            $id = $row['t_id'];
                            $name = $row['t_name'];
                            $email = $row['t_email'];
                            $address = $row['t_address'];
                            $phone = $row['t_phone'];
                            $sec_id = $row['sec_id'];
                            $regdate = $row['date_updated'];

                            ?>
                            <div class="form-group col-md-12">
                                <label for="name" class="a"><b>Teacher Name</b></label>
                                <input type="text" class="form-control"
                                    onchange="EditData(this,<?php echo $id; ?>,'t_name','teacher','t_id')"
                                    id="name<?php echo $id; ?>" name="name" value="<?php echo $name ?>">

                                <input type="hidden" class="form-control" id="t_id<?php echo $id; ?>" name="t_id"
                                    value="<?php echo $id ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="email" class="a"><b>Email</b></label>
                                <input type="text" class="form-control"
                                    onchange="EditData(this,<?php echo $id; ?>,'t_email','teacher','t_id')"
                                    id="email<?php echo $id; ?>" name="email" value="<?php echo $email ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="address" class="a"><b>Address</b></label>
                                <input type="text" class="form-control"
                                    onchange="EditData(this,<?php echo $id; ?>,'t_address','teacher','t_id')"
                                    id="address<?php echo $id; ?>" name="address" value="<?php echo $address ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="phone" class="a"><b>Phone No</b></label>
                                <input type="text" class="form-control"
                                    onchange="EditData(this,<?php echo $id; ?>,'t_phone','teacher','t_id')"
                                    id="phone<?php echo $id; ?>" name="phone" value="<?php echo $phone ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="name" class="a"><b>Select Class</b></label>
                                <select type="text" class='form-control norad tx12' name="sec_id"
                                    onchange="loadclass(this, <?php echo $id; ?>, 'sec_id','teacher','t_id', <?php echo $sec_id; ?>)"
                                    id="sec_id<?php echo $id; ?>">
                                    <option selected disabled>--Select Class--</option>
                                    <?php
                                    $res = fetchSectionByall();
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $class_list = fetchClassBySectionId($row['cls_id']);
                                        $class_row = mysqli_fetch_assoc($class_list);
                                        if ($row['sec_id'] == $sec_id): ?>
                                            <option value='<?php echo $row['sec_id']; ?>' <?php if ($row['sec_id'] == $sec_id):
                                                    echo "selected"; endif; ?>><?php echo $class_row['cls_name'] . " " . $row['sec_name'] ?>
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

                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location.href='teacher.php'" class="btn btn-secondary"
                        data-bs-dismiss="modal">Back</button>
                </div>
            </form>
        </div>
        <?php include 'pages/footer.php'; ?>
    </div>
</main>

</body>

</html>