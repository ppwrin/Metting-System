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

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Meeting System
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
</head>

<style>
.modal-backdrop {
    position: static;
}
</style>

<body class="">
    <?php require_once('../public/components/navbar.php'); ?>
    <main class="main-content  mt-0">
        <section>
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
                                            <td class="align-middle text-center text-sm">
                                                <?php if($row['book_status'] === '2'){ ?>
                                                <span class="badge rounded-pill text-bg-success">Approve by Admin</span>
                                                <?php }else if($row['book_status'] === '3'){ ?>
                                                    <span class="badge rounded-pill text-bg-danger">Cancel</span>
                                                    <?php }else{ ?>
                                                <span class="badge rounded-pill text-bg-warning">Waiting</span>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
    
 
</body>

</html>