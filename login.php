<?php 
    session_start();
    if(isset($_SESSION['users_id'])){
        if($_SESSION['role'] == '2'){
            echo "<script>";
            echo "window.location.href='index.php';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "window.location.href='bof/index.php';";
            echo "</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Meeting System
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="login.php">
                            Meeting System
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="#" id="register_tab">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Sign Up
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="#" id="login_tab">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        Sign In
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container" id="login_section">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="login_form" enctype="multipart/form-data">
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                            <input type="hidden" name="do" value="login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('assets/img/london-business-meeting-in-progress.jpg')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container" id="register_section" style="display: none;">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Enter your bio to sign up</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="register_form" enctype="multipart/form-data">
                                        <label>Firstname</label>
                                        <div class="mb-3">
                                            <input type="text" name="firstname" class="form-control"
                                                placeholder="Firstname" aria-label="Email"
                                                aria-describedby="email-addon">
                                        </div>
                                        <label>Lastname</label>
                                        <div class="mb-3">
                                            <input type="text" name="lastname" class="form-control"
                                                placeholder="Lastname" aria-label="Email"
                                                aria-describedby="email-addon">
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                            <input type="hidden" name="do" value="register">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('assets/img/london-business-meeting-in-progress.jpg')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright © <script>
                        document.write(new Date().getFullYear())
                        </script> Meeting System By Paphawarin Thaworn.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

    $(document).ready(function(e) {

        $("#login_tab").click(function() {
            $("#login_section").show();
            $("#register_section").hide();
        });

        $("#register_tab").click(function() {
            $("#login_section").hide();
            $("#register_section").show();
        });

        $("#login_form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "controller/loginController.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    if (response.res_code == 403) {
                        swal("Email or password incorrect.", {
                            icon: "warning",
                        });
                    }

                    if (response.res_code == 402) {
                        swal("Account is deleted. Please contact admin.", {
                            icon: "warning",
                        });
                    }

                    if (response.res_code == 200) {
                        if(response.res_data.role == '2'){
                            setTimeout(function() {
                                window.location.href = "index.php";
                            }, 1000);
                        }else if(response.res_data.role == '1'){
                            setTimeout(function() {
                                window.location.href = "bof/index.php";
                            }, 1000);
                        }else{
                            swal("Account is deleted. Please contact admin.", {
                                icon: "warning",
                            });  
                        }
                    }
                },
                error: function() {}
            });
        }));

        $("#register_form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "controller/loginController.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.res_code == 403) {
                        swal("Email or password is using.", {
                            icon: "warning",
                        });
                    }
                    if (response.res_code == 200) {
                        setTimeout(function() {
                            window.location.href = "index.php";
                        }, 2000);
                    }
                },
                error: function() {}
            });
        }));

    });
    </script>
</body>

</html>