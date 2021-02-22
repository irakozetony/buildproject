<?php

include('security.php');

if (isset($_POST['signup_button'])) {

    $company_name = mysqli_real_escape_string($connection, $_POST['company_name']);
    $company_email = mysqli_real_escape_string($connection, $_POST['email']);
    $company_phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $usertype = "company";
    $useractive = 0;

    if (empty($company_name)) {
        $_SESSION['status'] = 'Company name required';
        header('location: signup.php');
    }
    if (empty($company_email)) {
        $_SESSION['status'] = 'Email required';
        header('location: signup.php');
    }
    if (empty($company_phone)) {
        $_SESSION['status'] = 'Phone contact required';
        header('location: signup.php');
    }
    if (empty($password)) {
        $_SESSION['status'] = 'Password required';
        header('location: signup.php');
    }
    if ($password === $cpassword) {
        $query = "INSERT INTO users (username, email, phone, password, usertype, useractive) VALUES ('$company_name', '$company_email', '$company_phone', '$cpassword', '$usertype', '$useractive')";
        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($query_run) {
            $_SESSION['username'] = $company_email;
            header('location: index.php');
        } else {
            $_SESSION['status'] = 'Company not registered';
            header('location: signup.php');
        }
    }
    else{
        $_SESSION['status'] = 'Password and confirm password do not match';
        header("location:signup.php");
    }
}
