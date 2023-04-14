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
            <h4>View Attendance</small>
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
                    onclick="classAttendance(this.form,'<?php echo $_SESSION['teacher']; ?>')">View Attendance</button>
            </form>
        </div>
    </div>

    <div class="col-12">
                <div class="table-responsive p-0">
                                
                    <?php
                    if(isset($_REQUEST['key'])){

                        $key = $_REQUEST['key'];
                        $getatt = GetclassAttendance($key,$_SESSION['teacher']); ?>

                   <table class="table">
                       <thead class="table-dark" style="width: 100%;">
                           <tr>
                               <th>Registration No</th>
                               <th>Student Name</th>
                               <th>Class</th>
                               <th>Attendance</th>
                           </tr>
                       </thead>
                       <tbody>

                       <?php  
                       
                       while($row = mysqli_fetch_assoc($getatt)){
                           $status = $row['status_check'];
                       
                   ?>

                           <tr>
                               <td><?php echo $row['reg_no']; ?></td>
                               <td><?php echo $row['std_name']; ?></td>
                               <?php 
                                $sec_name = $row['cls_name']." ". $row['sec_name'];
                               ?>
                               <td><?php echo $sec_name;?></td>
                               <td><?php 
                               
                                   if($status == 1){ ?>
                                       <button class="btn btn-sm btn-warning" disabled="disabled">Present</button>
                                   <?php }else{ ?>
                                       <button class="btn btn-sm btn-danger" disabled="disabled">Absent</button>
                                   <?php } ?>
                               </td>
                           </tr>
                           <?php } ?>
                       </tbody>
                   </table>

                    <?php }
                
                    ?>
               
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