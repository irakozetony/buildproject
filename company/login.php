<?php
session_start();
require('database/dbconnection.php');
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
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <?php
                                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                    echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">' . $_SESSION['status'] . '</div>';
                                    unset($_SESSION['status']);
                                }
                                ?>
                                <form class="user" action="login_code.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <button type="submit" name="login_button" class="btn btn-primary btn-user btn-block">Login</button>
                                    <a type="submit" href="./signup.php" class="btn btn-secondary btn-user btn-block">Sign Up</a>
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
include('./inc/scripts.php');
include('./inc/footer.php');
?>