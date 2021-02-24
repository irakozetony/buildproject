<?php
session_start();
include('database/dbconnection.php');
include('inc/header.php');
?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                </div>
                                <?php
                                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                    echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">'. $_SESSION['status'] . '</div>';
                                    unset($_SESSION['status']);
                                }
                                ?>
                                <form class="user" action="signup_code.php" method="POST" id="signup-form">
                                    <div class="form-group">
                                        <input type="text" name="company_name" class="form-control form-control-user" placeholder="Company name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email address" required>
                                    </div>
                                    <div class="form-group">
                                    <input type="text" name="phone" class="form-control form-control-user" placeholder="Phone number" required pattern="+2507[2,3,8][0-9]{8}">
                                    </div>
                                    <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="usertype" placeholder="Type of User (Admin/Company)" value="company">
                                        </div>
                                    <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" name="cpassword" placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                    <button type="submit" name="signup_button" id="signup-submit" class="btn btn-primary btn-user btn-block">Signup</button>
                                    <a type="submit" href="./login.php" class="btn btn-secondary btn-user btn-block">Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</div>

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>