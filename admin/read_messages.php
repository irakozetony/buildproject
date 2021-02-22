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
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="messages.php"><i class="fas fa-arrow-left"></i></a>
                        </h6>
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
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "SELECT * FROM contacts WHERE id='$id'";
                            $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                            if (mysqli_num_rows($query_run) > 0) {
                                $message = mysqli_fetch_assoc($query_run);
                            }
                        }
                        ?>
                        <div class="card border-left-primary" style=" border-radius: 0px; padding: 25px; padding: 25px;">
                            <h5>Sender: <?php echo $message['email']; ?></h5>
                            <h5>Subject: <?php echo $message['subject']; ?></h5>
                            <p><?php echo $message['message']; ?></p>
                            <span style="text-align: right;">
                            <a href="mailto:<?php echo $message['email']; ?>" class="btn btn-success" name="reply_button" style="width: 100px;">Reply</a>
                            </span>
                        </div>
                    </div>
                    <?php
                    $query = "UPDATE contacts SET status='read' WHERE id='$id'";
                    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    if (!$query_run) {
                        echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">No Records Found</div>';
                    }
                    ?>
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