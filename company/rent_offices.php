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
                        <h6 class="m-0 font-weight-bold text-primary">Offices</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile"><i class="fas fa-building fa-sm text-white-50"></i>    Add new office</button>
                    </div>
                </div>
                <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="addadminprofile" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addadminprofileLabel">Add new office</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="p-5">
                                <?php
                                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                    echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">'. $_SESSION['status'] . '</div>';
                                    unset($_SESSION['status']);
                                }
                                ?>
                                    <form action="add_office.php" method="POST" class="user" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="officename" placeholder="Building/Office Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="officelocation" placeholder="Office Location">
                                        </div>

                                        <div class="form-group">
                            <select class="form-control form-control-user" name="officecategory" style="padding:.3em 1em; height:50px;">
                                <option selected>Office Category</option>
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                            </select>
                        </div>
                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="officeprice" placeholder="Office Price">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control form-control-user" name="officeimage" placeholder="Office Image">
                                        </div>
                                        <input type="hidden" name="officestatus" value="available">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="addoffice_button" class="btn btn-primary">Add office</button>
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
                        $owner = $_SESSION['username'];
                        $query = "SELECT * FROM offices WHERE owner='$owner' AND status='occupied' AND category='rent'";
                        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N<sup>o</sup></th>
                                    <th>Office name</th>
                                    <th>Location</th>
                                    <th>Office category</th>
                                    <th>Office price</th>
                                    <th>Office status</th>
                                    <th>Image</th>
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
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['location']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['image']; ?></td>
                                            <td>
                                                <form action="officeedit.php" method="POST">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-success" name="edit_button">EDIT</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="officeedit_code.php" method="POST">
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

include('./inc/scripts.php');
include('./inc/footer.php');

?>