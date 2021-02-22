<?php
include('security.php');
if(isset($_POST['admit_button'])){
    $id = $_POST['admit_id'];
    $query = "UPDATE users SET useractive=1 WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $_SESSION['success'] = "User admitted";
        header('location: newusers.php');
    }
    else{
        $_SESSION['status'] = "User admission failed";
        header('location: newusers.php');
    }
}