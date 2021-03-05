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
                        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile"><i class="fas fa-user fa-sm text-white-50"></i>Create User Profile</button>
                    </div>
                </div>
                <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="addadminprofile" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addadminprofileLabel"> Add User Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="p-5">
                                    <form action="code.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="phone" class="form-control form-control-user" name="phonenumber" placeholder="Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select class="form-control form-control-user" name="usertype" style="padding:.3em 1em; height:50px;">
                                                    <option selected>User Type</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="company">Company</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="useractive">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" name="cpassword" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="registerbutton" class="btn btn-primary">Create Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                        $query = "SELECT * FROM users";
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
                                    <th>Pdf</th>
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

                                                <a href="register_edit.php?edit_id=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-success">Edit</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="output_files/specific.php?user=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-info">View</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="code.php?delete_id=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-danger">DELETE</button>
                                                </a>
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