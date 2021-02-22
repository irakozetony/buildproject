<?php
include('security.php');
include("inc/header.php");
include("inc/navbar.php");
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h6 class="m-0 font-weight-bold text-primary">Companies</h6>
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

                        require('database/dbconnection.php');
                        $query = "SELECT * FROM users WHERE useractive=1 AND usertype='company'";
                        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N<sup>o</sup></th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>User Type</th>
                                    <th>Password</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['usertype']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td>
                                                <form action="register_edit.php" method="POST">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-success" name="edit_button">EDIT</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-danger" name="delete_button">DELETE</button>
                                                </form>
                                            </td>
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

include('inc/scripts.php');
include('inc/footer.php');

?>