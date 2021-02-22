<?php
include('database/dbconnection.php');

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $status = "new";

    $query = "INSERT INTO contacts (name, email, subject, message, status) VALUES ('$name', '$email', '$subject', '$message', '$status')";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $_SESSION['success'] = "message sent succesfully";
        header('location:contact.php');
    }
    else{
        $_SESSION['status'] = "message not sent";
        header('location: contact.php');
    }
}
?>