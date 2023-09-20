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
            <h4 class="modal-title" id="exampleModalLabel">Edit Password</h4>
            <form class="col-md-8 " method="POST" enctype="multipart/form-data" id="productinfo">
                <div class="modal-body">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="password" class="a"><b>Password</b></label>
                            <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Password">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="confpassword" class="a"><b>Confirm Password</b></label>
                            <input type="password" class="form-control" id="crepass" name="crepass" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-secondary"
                        data-bs-dismiss="modal">Back</button>
                    <button type="button" onclick="updateCred(this.form,'<?php echo $std_id;?>','std_pass','student','reg_no')" name="submit"
                                class="btn btn-dark">Save changes</button>
                </div>
            </form>
        </div>
        <?php include 'pages/footer.php'; ?>
    </div>
</main>

</body>

</html>