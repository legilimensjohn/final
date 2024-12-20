<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['ad_id'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include('assets/inc/head.php'); ?>

<body>

    <div id="wrapper">

        <?php include('assets/inc/nav.php'); ?>
        <?php include("assets/inc/sidebar.php"); ?>

        <div class="content-page">
            <div class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                        <li class="breadcrumb-item active">Discharged Patients</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Discharged Patients</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered toggle-circle mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Patient's Name</th>
                                                <th>Patient Number</th>
                                                <th>Patient's Address</th>
                                                <th>Patient Category</th>
                                                <th>Discharge Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM his_patients WHERE pat_discharge_status='Discharged' ORDER BY pat_date_joined DESC";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row->pat_fname . " " . $row->pat_lname; ?></td>
                                                <td><?php echo $row->pat_number; ?></td>
                                                <td><?php echo $row->pat_addr; ?></td>
                                                <td><?php echo $row->pat_type; ?></td>
                                                <td><?php echo $row->pat_discharge_status; ?></td>
                                            </tr>
                                            <?php $cnt = $cnt + 1; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php include('assets/inc/footer.php'); ?>

        </div>

    </div>

    <div class="rightbar-overlay"></div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>