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
                                    echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">' . $_SESSION['status'] . '</div>';
                                    unset($_SESSION['status']);
                                }
                                ?>
                                <form class="user" action="signup_code.php" method="POST" id="signup-form">
                                    <div class="form-group">
                                        <input type="text" name="company_name" class="form-control form-control-user" id="company_name" placeholder="Company name" >
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Email address" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="Phone number" >
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control form-control-user" id="usertype" name="usertype" placeholder="Type of User (Admin/Company)" value="company">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="cpassword" name="cpassword" placeholder="Confirm Password">
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

<script>

    jQuery('#signup-form').on('submit', function(e) {
        let name = $('#company_name').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let password = $('#password').val();
        let cpassword = $('#cpassword').val();

        if(name ==''){
            $('#company_name').css('border-bottom-color', '#c00');
            $('#company_name').css('color', '#c00');
        }
        else if(email == ''){
            $('#email').css('border-bottom-color', '#c00');
            $('#email').css('color', '#c00');
        }
        else if(phone == ''){
            $('#phone').css('border-bottom-color', '#c00');
            $('#phone').css('color', '#c00');
        }
        else if(((password == '') || (cpassword == '')) || (password != cpassword)){
            $('#password').css('border-bottom-color', '#c00');
            $('#cpassword').css('border-bottom-color', '#c00');
            $('#password').css('color', '#c00');
            $('#cpassword').css('color', '#c00');
        }
        else{
            jQuery('#signup-submit').val('Please wait...');
        jQuery('#signup-submit').attr('disabled', true);
        jQuery.ajax({
            url: 'signup_code.php',
            type: 'post',
            data: jQuery('#signup-form').serialize(),
            success: function(result) {
                jQuery('#signup-form')['0'].reset();
                jQuery('#signup-submit').val('Signup');
                jQuery('#signup-submit').attr('disabled', false);
            }

        });   
        }
        e.preventDefault();
    });
</script>