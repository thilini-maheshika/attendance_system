<script src="assets/js/script.js"></script>

<!-- Navbar -->
<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-nav ">
                <a href="index.php" class="nav-item nav-link active"><i class="fas fa-home-alt me-2"></i>Dashboard</a>
                <a href="student.php" class="nav-item nav-link "><i class="fas fa-user-graduate me-2"></i>Students</a>
                <a href="class.php" class="nav-item nav-link "><i class="fa fa-users me-2"></i>Classrooms</a>
                <a href="teacher.php" class="nav-item nav-link"><i
                        class="fas fa-chalkboard-teacher me-2"></i>Teachers</a>
                <a href="" class="nav-item nav-link"><i class="fa fa-list me-2"></i>Customize Page</a>


            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="assets/img/school_logo.png" height="50em" alt="Logo" loading="lazy" />
                <span class="ms-1 font-weight-bold">School Management System /<span
                        style="color: gray; font-size: 0.9em;">Al Adhan Maha Vidyalaya - Badulla</span></span>
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row" style="margin-right: 20px;">
                <!-- Search form -->
                <form method="POST">
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Type here...">
                        <button type="submit" name="search" class="btn btn-dark"><i class="fas fa-search"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
                <!-- Avatar -->
                <li class="nav-item dropdown" style="margin-left: 20px;">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i style="font-size: 20px;" class="fas fa-user-edit" height="20px" alt="Avatar"
                            loading="lazy"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Change Password</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">
    <div class="container pt-4"></div>
</main>
<!--Main layout-->
<!-- End Navbar -->