<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  //$aid=$_SESSION['ad_id'];

  if(isset($_SESSION['ad_id'])) {
    $aid = $_SESSION['ad_id'];
} else {
    // Handle the case where 'ad_id' is not set
    $aid = null; // or some default value
    // Optionally, you can redirect to an error page or show an error message
    // header("Location: error_page.php");
    // exit();
}

  $doc_id = $_SESSION['doc_id'];
  /*
  Doctor has no previledges to delete a patient record
  if(isset($_GET['delete']))
  {
        $id=intval($_GET['delete']);
        $adn="delete from his_patients where pat_id=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Patients Records Deleted";
          }
            else
            {
                $err = "Try Again Later";
            }
    }
    */

?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">Operate Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Operate Patient Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >
                                                <div class="form-group mr-2" style="display:none">
                                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                                        <option value="">Show all</option>
                                                        <option value="Discharged">Discharged</option>
                                                        <option value="OutPatients">OutPatients</option>
                                                        <option value="InPatients">InPatients</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Patient's Name</th>
                                                <th data-hide="phone">Patient Number</th>
                                                <th data-hide="phone">Patient's Address</th>
                                                <th data-hide="phone">Patient Category</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *get details of allpatients
                                                *
                                            */
                                                $ret="SELECT * FROM  his_patients ORDER BY RAND() "; 
                                                //sql code to get to ten docs  randomly
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>

                                                <tbody>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?></td>
                                                    <td><?php echo $row->pat_number;?></td>
                                                    <td><?php echo $row->pat_addr;?></td>
                                                    <td><?php echo $row->pat_type;?></td>
                                                    
                                                    
                                                    <td>
                                                        <a href="his_doc_view_single_patient.php?pat_id=<?php echo $row->pat_id;?>&&pat_number=<?php echo $row->pat_number;?>" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a>
                                                        <a href="his_doc_update_single_patient.php?pat_number=<?php echo $row->pat_number;?>" class="badge badge-primary"><i class="mdi mdi-check-box-outline "></i> Update</a>
                                                        <a href="his_doc_discharge_patient.php?discharge=<?php echo $row->pat_id;?>" class="badge badge-warning"><i class="mdi mdi-check-box-outline "></i> Discharge</a>

                                                    </td>
                                                </tr>
                                                </tbody>


                                            <?php  $cnt = $cnt +1 ; }?>
                                            
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                 <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>