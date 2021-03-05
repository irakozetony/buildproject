<?php
include('security.php');
include('inc/header.php');
include('inc/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit User Profile
            </h6>
        </div>
        <div class="card-body">
            <?php
            require('database/dbconnection.php');
            if (isset($_GET['edit_id'])) {
                $id = $_GET['edit_id'];
                $query = "SELECT * FROM users WHERE id='$id'";
                $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST" class="user">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="edit_username" value="<?php echo $row['username']; ?>" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="edit_email" value="<?php echo $row['email']; ?>" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="phone" class="form-control form-control-user" name="edit_phonenumber" value="<?php echo $row['phone']; ?>" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <select class="form-control form-control-user" name="edit_usertype" style="padding:.3em 1em; height:50px;">
                                <option selected>User Type</option>
                                <option value="admin">Admin</option>
                                <option value="company">Company</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control form-control-user" name="edit_useractive" style="padding:.3em 1em; height:50px;">
                                <option selected>User Status</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="edit_password" value="<?php echo $row['password']; ?>" placeholder="Phone Number">
                        </div>
                        <div class="modal-footer">
                            <a href="admins.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" name="update_button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>

</div>
</div>
<?php
include('inc/scripts.php');
include('inc/footer.php');
?>