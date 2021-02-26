<?php
include('security.php');
include('inc/header.php');
include('inc/navbar.php');

?>



<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">



        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a data-toggle="modal" data-target="#reportgen" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addadminprofile"><i class="fas fa-download fa-sm text-white-50"></i>    Add new office</button> -->
                <div class="modal fade" id="reportgen" tabindex="-1" role="dialog" aria-labelledby="reportgen" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportgenLabel">Choose report period</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="p-5">
                                    <form action="code.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user" name="start_date" id="start_date" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user" name="end_date" id="end_date" placeholder="Email Address">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="reportgen()" id="view_button" name="view_button" class="btn btn-success">View Report</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Registered Offices</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $owner = $_SESSION['username'];
                                        $query = "SELECT * FROM offices WHERE owner='$owner'";
                                        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        $row = mysqli_num_rows($query_run);

                                        echo '<h1>' . $row . '</h1>';

                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Operating Customers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $owner = $_SESSION['username'];
                                        $query = "SELECT * FROM customers WHERE office_reserved_owner='$owner' AND status='approved'";
                                        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        $row = mysqli_num_rows($query_run);

                                        echo '<h1>'.$row.'</h1>';

                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $owner = $_SESSION['username'];
                                        $query = "SELECT * FROM customers WHERE status ='new' AND office_reserved_owner='$owner'";
                                        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

                                        if ($query_run) {
                                            $messages_number = mysqli_num_rows($query_run);
                                            echo '<h1>'.$messages_number.'</h1>';
                                        } else {
                                            echo "Message check failed";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="period">
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
</div>
<script>
    function reportgen() {
        let day1 = $('#start_date').val();
        let day2 = $('#end_date').val();
        if (day1 == '') {
            $('#start_date').css('border-bottom-color', '#c00');
            $('#start_date').css('color', '#c00');
        } else if (day2 == '') {
            $('#end_date').css('border-bottom-color', '#c00');
            $('#end_date').css('border-bottom-color', '#c00');
        } else {
            alert("Say something");
            $('#period').load('report_result.php?start_date=' + day1 + '&end_date=' + day2);
        }
    }
</script>
<?php
include('./inc/scripts.php');
include('./inc/footer.php');
?>