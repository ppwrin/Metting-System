<?php 
session_start();
include_once('../db/connect_pdo.php');
$current_page =  basename(__FILE__, '.php');

$sql = "SELECT * FROM users WHERE role IN (2,3)";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('components/head.php'); ?>

<style>
td {
    height: 50px;
    vertical-align: bottom;
}
</style>

<body class="g-sidenav-show  bg-gray-100">
    <!-- Sidebar -->
    <?php require_once('components/sidebar.php'); ?>
    <!-- End Sidebar -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once('components/navbar.php'); ?>
        <!-- End Navbar -->
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h6>Member</h6>
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
                                                Members</th>
                                            <th
                                                class="text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                Email</th>
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
                                                <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                                            </td>
                                            <td class="align-middle text-start text-sm ps-4">
                                                <span class="font-weight-bold"> <?php echo $row['email']; ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <?php if($row['role'] === '2'){ ?>
                                                <span class="badge rounded-pill text-bg-success">Active</span>
                                                <?php }else{ ?>
                                                <span class="badge rounded-pill text-bg-danger">Deleted users</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center d-flex justify-content-center align-items-center">
                                                <div class="d-flex align-items-center mt-3">
                                                    <?php if($row['role'] === '2'){ ?>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btn_action"
                                                        data-val="del" data-id="<?php echo $row['users_id']; ?>">Deleted</button>
                                                    <?php }else{ ?>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-success btn_action"
                                                        data-val="act" data-id="<?php echo $row['users_id']; ?>">Active</button>
                                                    <?php } ?>
                                                </div>
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
        $('#myTable').DataTable();
        $('.btn_action').on('click', function() {
            Swal.fire({
                title: 'Do you want to update users',
                showDenyButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                $.ajax({
                    type: "POST",
                    url: "../controller/memberController.php",
                    data: {
                        do: $(this).data('val'),
                        users_id: $(this).data('id')
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.res_code == 200){
                            Swal.fire('Saved', '', 'success')
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