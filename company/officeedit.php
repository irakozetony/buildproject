<?php
include('security.php');
include('inc/header.php');
include('inc/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Office Data
            </h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['edit_button'])) {
                $id = $_GET['edit_id'];
                $query = "SELECT * FROM offices WHERE id='$id'";
                $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

                foreach ($query_run as $row) {
            ?>
                    <form action="officeedit_code.php" method="POST" class="user" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="edit_name" value="<?php echo $row['name']; ?>" placeholder="Office name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="edit_location" value="<?php echo $row['location']; ?>" placeholder="Office location">
                        </div>
                        <div class="form-group">
                            <select class="form-control form-control-user" name="edit_category" style="padding:.3em 1em; height:50px;">
                                <option selected><?php echo $row['category']; ?></option>
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="edit_price" value="<?php echo $row['price']; ?>" placeholder="Office price">
                        </div>
                        <div class="form-group">
                            <select class="form-control form-control-user" name="edit_status" style="padding:.3em 1em; height:50px;">
                                <option selected><?php echo $row['status']; ?></option>
                                <option value="available">Available</option>
                                <option value="occupied">Unavailable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" name="edit_image" value="<?php echo $row['image']; ?>" placeholder="Email Address">
                        </div>
                        <div class="modal-footer">
                            <a href="offices.php" class="btn btn-danger">Cancel</a>
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