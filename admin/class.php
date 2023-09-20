<?php include 'pages/header.php'; 
?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-bottom:0.7rem; margin-top:0.5rem;">
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
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="a"><b>Class Name</b></label>
                                    <input type="text" class="form-control" id="class" name="class"
                                        placeholder="Class Name">
                                </div>                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="addClass(this.form)" name="submit"
                                class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Class Management</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table">
                            <thead class="table-dark" style="width: 100%;">
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th style="width:8em;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $getcls = fetchClass();

                                    while ($row = mysqli_fetch_assoc($getcls)) {

                                        $id = $row['cls_id'];
                                        $name = $row['cls_name'];
                                        
                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><input type="text" class="form-control"
                                    onchange="EditData(this,<?php echo $id; ?>,'cls_name','class','cls_id')" id="name<?php echo $id; ?>" name="name"
                                        value="<?php echo $name; ?>" width="20px"></td>             
                                    <td><button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $id; ?> ,'class','cls_id')"><i
                                        class="fa-solid fa-trash"></i> Delete </button></td>
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