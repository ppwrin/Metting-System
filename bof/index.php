<?php 
session_start();
include_once('../db/connect_pdo.php');
$current_page =  basename(__FILE__, '.php');

$sql_req_today = "SELECT b.book_id, (SELECT count(book_id) as count_all FROM booking) as count_all, 
(SELECT count(book_id) as count FROM booking WHERE DATE(created_at) = DATE(NOW())) as count_td FROM booking as b";
$stmt = $conn->prepare($sql_req_today);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count_td = $row['count_td'];
$count_all = $row['count_all'];

$sql_mem_today = "SELECT u.users_id, (SELECT count(users_id) as count_all FROM users) as count_all, 
(SELECT count(users_id) as count FROM users WHERE DATE(created_at) = DATE(NOW())) as count_td FROM users as u";
$stmt = $conn->prepare($sql_mem_today);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count_u_td = $row['count_td'];
$count_u_all = $row['count_all'];

$sql = "SELECT * FROM booking as b 
LEFT JOIN users as u ON b.users_id = u.users_id
LEFT JOIN room as r ON b.room_id = r.room_id ORDER BY book_status ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('components/head.php'); ?>

<body class="g-sidenav-show  bg-gray-100">
    <!-- Sidebar -->
    <?php require_once('components/sidebar.php'); ?>
    <!-- End Sidebar -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once('components/navbar.php'); ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Request</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo $count_td; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Request</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo $count_all; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo $count_u_td; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo $count_u_all; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h6>Meeting Request</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-2 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="myTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                No.</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                                Room</th>
                                            <th
                                                class="text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                Members</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                Date Request</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td class="ps-4 text-sm">
                                                <?php echo $i; ?>
                                            </td>
                                            <td class="text-sm">
                                                <?php echo $row['room_name']?>
                                            </td>
                                            <td class="align-middle text-start text-sm ps-4">
                                                <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <?php echo $row['book_start_date'] . ' to ' . $row['book_end_date']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($row['book_status'] === '2'){ ?>
                                                <span class="badge rounded-pill text-bg-success">Approve by Admin</span>
                                                <?php }else if($row['book_status'] === '3'){ ?>
                                                <span class="badge rounded-pill text-bg-danger">Cancel by Admin</span>
                                                <?php }else{ ?>
                                                <span class="badge rounded-pill text-bg-warning">Waiting</span>
                                                <?php } ?>
                                            </td>
                             
                                            <td class="text-center d-flex justify-content-center align-items-center">
                                                <?php if($row['book_status'] == '2'){ ?>
                                                    <div class="d-flex align-items-center mt-3">
                                                        <button type="button" class="btn btn-sm btn-outline-success btn_action" data-id="<?php echo $row['book_id']; ?>">Approve</button>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="d-flex align-items-center mt-3">
                                                        <button type="button" class="btn btn-sm btn-outline-success btn_cancel" data-id="<?php echo $row['book_id']; ?>">Cancel</button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once('components/script.php'); ?>

    <script>
        $(document).ready(function() {
            var url = window.location;
            var element = $('ul li a').filter(function() {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }).parent().addClass('active');
            if (element.is('li')) {
                element.addClass('active').parent().parent('li').addClass('active')
            }

            $('#myTable').DataTable();

            $('.btn_action').on('click', function() {
                Swal.fire({
                    title: 'Do you want to approve booking',
                    showDenyButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    $.ajax({
                        type: "POST",
                        url: "../controller/bookingController.php",
                        data: {
                            do: 'app',
                            book_id: $(this).data('id')
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.res_code == 200){
                                Swal.fire('Approve', '', 'success')
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }else{
                                Swal.fire('Status are not saved', '', 'info')
                            }
                        }
                    });
                })
            })

            $('.btn_cancel').on('click', function() {
                Swal.fire({
                    title: 'Do you want to cancel booking',
                    showDenyButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    $.ajax({
                        type: "POST",
                        url: "../controller/bookingController.php",
                        data: {
                            do: 'cancel',
                            book_id: $(this).data('id')
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.res_code == 200){
                                Swal.fire('Cancel', '', 'success')
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }else{
                                Swal.fire('Status are not saved', '', 'info')
                            }
                        }
                    });
                })
            })
        });
    </script>

</body>

</html>