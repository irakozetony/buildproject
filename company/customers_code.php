<?php
include('security.php');

if(isset($_POST['approve_button'])){
    $id = $_POST['approve_id'];
    $status = "approved";
    $query = "UPDATE customers SET status='$status' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $select_office = "SELECT office_reserved_id FROM customers WHERE id='$id'";
    $run_select_office = mysqli_query($connection, $select_office) or die(mysqli_error($connection));
    $office_id = $run_select_office;

    if($query_run){
        $update_office = "UPDATE offices SET status='occupied' WHERE id='$office_id'";
        $_SESSION['success'] = "Status updated: approved";
        header('location:customers.php');
    }
    else{
        $_SESSION['status'] = "Status not updated";
        header('location:customers.php');
    }
}

if(isset($_POST['disapprove_button'])){
    $id = $_POST['disapprove_id'];
    $status = "rejected";
    $query = "UPDATE customers SET status='$status' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $_SESSION['success'] = "Status updated: disapproved";
        header('location:customers.php');
    }
    else{
        $_SESSION['status'] = "Status not updated";
        header('location:customers.php');
    }
}
?>