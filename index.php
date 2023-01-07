<?php 
    session_start();
    include_once('db/connect_pdo.php');
    if($_SESSION['role'] == ''){
        echo "<script>";
        echo "window.location.href='login.php';";
        echo "</script>";
    }

    $sql_room = "SELECT * FROM room";
    $stmt_room = $conn->prepare($sql_room);
    $stmt_room->execute();
 
    $sql = "SELECT * FROM booking as b 
    LEFT JOIN users as u ON b.users_id = u.users_id
    LEFT JOIN room as r ON b.room_id = r.room_id WHERE book_status = 2";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $start = substr($row['book_start_date'], 11, 22);
        $new_start = substr($start, 0, 5);
        $end = substr($row['book_end_date'], 11, 22);
        $new_end= substr($end, 0, 5);
    
        $data[] = array(
            'id' => $row['book_id'],
            'title' => $new_start.' - '.$new_end.' '.$row['room_name'].' คุณ '.$row['firstname'].' '.$row['lastname'],
            'start' => $row['book_start_date'],
            'end' => $row['book_end_date']
        );
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
    <?php require_once('public/components/navbar.php'); ?>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container" id="login_section">
                    <div class="row">
                        <?php while($row = $stmt_room->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div class="col-4">
                            <div class="card">
                                <img src="<?php echo $row['room_img']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['room_name']; ?></h5>
                                    <p class="card-text"><?php echo $row['room_details']; ?></p>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?php echo $row['room_id']; ?>"
                                        class="btn btn-primary">Booking</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal<?php echo $row['room_id']; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form class="booking_form w-100" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">จองห้องประชุม</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="exampleFormControlInput1"
                                                        class="form-label">วัน/เวลาที่ต้องกาาร</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" name="booking_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Booking Now</button>
                                            <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                            <input type="hidden" name="do" value="booking">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row text-center" style="margin-top: -70px;">
                    <h3>Booking Calendar</h3>
                </div>
                <div class="row">
                    <div id="calendar"></div>
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
    $(document).ready(function(e) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            timeFormat: 'H:mm',
            defaultDate: '<?php echo date('Y-m-d');?>',
            editable: true,
            displayEventTime: false,
            eventLimit: true,
            events: <?php echo json_encode($data);?>,
            textColor: '#ffffff',
            eventColor: '#000'

        });
        $('input[name="booking_time"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour'),
            timePicker24Hour: true,
            pick12HourFormat: false,
            minTime: '12:00',
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            }
        });

        $(".booking_form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "controller/bookingController.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.res_code == 403) {
                        swal("Booking time is request! Please contact admin.", {
                            icon: "warning",
                        });
                    }
                    if (response.res_code == 200) {
                        swal("", {
                            icon: "success",
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {}
            });
        }));
    });
    </script>
</body>

</html>