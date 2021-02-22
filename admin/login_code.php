<?php
include('security.php');
if (isset($_POST['login_button'])) {
    $email_login = mysqli_real_escape_string($connection, $_POST['email']);
    $password_login = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $usertype = mysqli_fetch_array($query_run);

    if ($usertype['usertype'] == 'admin') {
        $_SESSION['username'] = $email_login;
        header('location: index.php');
    } else if ($usertype['usertype'] == 'company') {
        if ($user['useractive'] == true) {
            $_SESSION['username'] = $email_login;
            header('location: index.php');
        } else {
            $_SESSION['status'] = "Go to company login";
            header('location: login.php');
        }
    } else {
        $_SESSION['status'] = "Invalid email or password";
        header('location: login.php');
    }
}
