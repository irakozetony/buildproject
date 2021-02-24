<?php
include('security.php');
if(isset($_POST['admit_button'])){
    $id = $_POST['admit_id'];
    $query = "UPDATE users SET useractive=1 WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $select_query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($connection, $select_query) or die(mysqli_error($connection));
        $user = mysqli_fetch_assoc($result);

        $username = $user['username'];
        $email = $user['email'];
        $phone = $user['phone'];
        $type = $user['type'];
        $password = $user['password'];

        $query = "INSERT INTO companies (username, email, phone, password, usertype) VALUES('$username', '$email', '$phone', '$password', '$type')";
        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
        if($query_run){
            $_SESSION['success'] = "User admitted";
            header('location: newusers.php');
        }
    }
    else{
        $_SESSION['status'] = "User admission failed";
        header('location: newusers.php');
    }
}