<?php
include('inc/header.php');
include('inc/navbar.php');

?>


<main id="main">

    

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Office Details</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Office Details</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->

    <?php
    include('database/dbconnection.php');

    if(isset($_GET['id']))
    {
     $id = $_GET['id'];
     $query = "SELECT * FROM offices WHERE id='$id'";
     $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
     $row = mysqli_fetch_assoc($query_run);
    }
?>
                <section id="portfolio-details" class="portfolio-details">
                    <div class="container">
                        <h2 class="portfolio-title"><?php echo $row['name']; ?></h2>
                        <div class="row">

                            <div class="col-lg-8" data-aos="fade-right">

                                <img src="company/officeimages/<?php echo $row['image']; ?>" class="img-fluid" alt="">


                            </div>

                            <div class="col-lg-4 portfolio-info" data-aos="fade-left">
                                <h3>Office information</h3>
                                <ul>
                                    <li><strong>Category: </strong><?php echo $row['category']; ?></li>
                                    <li><strong>Location: </strong><?php echo $row['location']; ?></li>
                                    <li><strong>Status: </strong><?php echo $row['status']; ?></li>
                                    <li><strong>Owner: </strong><?php echo$row['owner']; ?></li>
                                    <li><strong>Price: </strong><?php echo$row['price']; ?></li>
                                        <input type="hidden" name="reserve_id" value="<?php echo$row['id']; ?>">
                                        <a class="btn cta-btn align-middle" href="#" style="background-color: #f03c02; color:white;" data-toggle="modal" data-target="#contactowner">Reserve</a>
                                    </li>
                                </ul>


                            </div>

                        </div>

                    </div>

                </section><!-- End Portfolio Details Section -->
                <div class="modal fade" id="contactowner" tabindex="-1" role="dialog" aria-labelledby="addadminprofile" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addadminprofileLabel">Reserve office</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-5">
                        <form action="reserve_office.php" method="POST" class="user">
                        <input type="hidden" name="reserve_id" value="<?php echo$row['id']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="phone" class="form-control form-control-user" name="phonenumber" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <input type="date" name="reserve_date" class="form-control form-control-user">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="reserve_button" class="btn" style="background-color: #f03c02; color:white;">Reserve</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php

include('inc/scripts.php');
include('inc/footer.php');

?>