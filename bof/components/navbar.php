<?php 
    if($_SESSION['role'] == ''){
        echo "<script>";
        echo "window.location.href='../login.php';";
        echo "</script>";
    }else if($_SESSION['role'] != '1'){
        echo "<script>";
        echo "window.location.href='../index.php';";
        echo "</script>";
    }
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $current_page; ?></li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><?php echo $current_page; ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-auto justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>