<?php
include('security.php');

if (isset($_POST['registerbutton'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $usertype = mysqli_real_escape_string($connection, $_POST['usertype']);

    $check_users = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($connection, $check_users) or die(mysqli_error($connection));
    $user = mysqli_fetch_assoc($result);

    if($user){
        if($user['username'] == $company_name){
            $_SESSION['status'] = "Company already exists.";
            header('location: login.php');
        }
        if($user['email'] == $company_email){
            $_SESSION['status'] = "Company email already registered. Try logging in";
            header('location: login.php');
        }
    }
    if ($password === $cpassword) {
        if($_SESSION['status'] == ''){
            if ($usertype == "admin") {
                $useractive = 1;
                $query = "INSERT INTO users (username, email, phone, password, usertype, useractive) VALUES ('$username','$email','$phone','$password', '$usertype', '$useractive')";
                $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
                if ($query_run) {
                    $_SESSION['success'] = "admin profile created";
                    header("location:admins.php");
                    $query2 = "INSERT INTO admins(username, email, phone, password, usertype) VALUES ('$username', '$email', '$phone', '$password', '$usertype')";
                    $query_run2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                    if (!$query_run2) {
                        $_SESSION['status'] = "Profile not created";
                    }
                } else {
                    $_SESSION['status'] = "admin profile not created";
                    header("location:admins.php");
                }
            } else {
                $useractive = 1;
                $query = "INSERT INTO users (username, email, phone, password, usertype, useractive) VALUES ('$username', '$email', '$phone', '$password', '$usertype', '$useractive')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    $_SESSION['success'] = "company profile created";
                    header("location:admins.php");
                    $query2 = "INSERT INTO companies(username, email, phone, password, usertype) VALUES ('$username', '$email', '$phone', '$password', '$usertype')";
                    $query_run2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                    if (!$query_run2) {
                        $_SESSION['status'] = "Profile not created";
                    }
                } else {
                    $_SESSION['status'] = "company profile not created";
                    header("location:admins.php");
                }
            }
        }
    } else {
        $_SESSION['status'] = "password and confirm password do not match";
        header("location:admins.php");
    }
}

if (isset($_POST['update_button'])) {
    $id = $_POST['edit_id'];
    $username = mysqli_real_escape_string($connection, $_POST['edit_username']);
    $email = mysqli_real_escape_string($connection, $_POST['edit_email']);
    $phone = mysqli_real_escape_string($connection, $_POST['edit_phonenumber']);
    $usertype = mysqli_real_escape_string($connection, $_POST['edit_usertype']);
    $password = mysqli_real_escape_string($connection, $_POST['edit_password']);
    $useractive = mysqli_real_escape_string($connection, $_POST['edit_useractive']);

    $query = "UPDATE users SET username='$username', email='$email', phone='$phone', usertype='$usertype', password='$password', useractive='$useractive' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($query_run) {
        $_SESSION['success'] = "Profile Data Updated Successfuly";
        header("location:admins.php");
    } else {
        $_SESSION['status'] = "Profile Data Not Updated";
        header('location:admins.php');
    }
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM users WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($query_run) {
        $_SESSION['success'] = "Profile Deleted Successfully";
        header("location:admins.php");
    } else {
        $_SESSION['status'] = "Profile not Deleted";
        header("location: admins.php");
    }
}
