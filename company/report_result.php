<?php
include('security.php');
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h6 class="m-0 font-weight-bold text-primary">Occupied Office</h6>
                        <button type="button" class="btn btn-primary"><i class="fas fa-building fa-sm text-white-50"></i>Export</button>
                    </div>
                </div>
                <div class="card-body">

                    <?php

                    if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                        echo '<div class="card border-left-success" style=" border-radius: 0px; padding: 25px;">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">' . $_SESSION['status'] . '</div>';
                        unset($_SESSION['status']);
                    }

                    ?>
                    <div class="table-responsive">
                        <?php
                        if(isset($_GET['start_date'])){
                            $start = $_GET['start_date'];
                            $end = $_GET['end_date'];
                            echo 'Reservations from '.$start.' to '.$end;
                            $owner = $_SESSION['username'];
                            $query = "SELECT offices.name as office_name, offices.category as office_category,
                            customers.name as customer_name, customers.reservation_date as reservation_date 
                            FROM offices, customers 
                            WHERE offices.owner='$owner' AND offices.status='occupied'
                            AND customers.office_reserved_id = offices.id
                            AND customers.reservation_date BETWEEN '$start' AND '$end'
                            AND customers.status = 'approved'";
                            $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                        }
                        ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N<sup>o</sup></th>
                                    <th>Office name</th>
                                    <th>Office category</th>
                                    <th>Customer name</th>
                                    <th>Reservation date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (mysqli_num_rows($query_run) > 0) {
                                    $a = 1;
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                        <tr>
                                            <td><?php echo $a; ?></td>
                                            <td><?php echo $row['office_name']; ?></td>
                                            <td><?php echo $row['office_category']; ?></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                            <td><?php echo $row['reservation_date']; ?></td>
                                        </tr>
                                <?php
                                        $a++;
                                    }
                                } else {
                                    echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">No Records Found</div>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>

<?php
include('./inc/scripts.php');
?>