<?php

include('database/dbconnection.php');

if(isset($_POST['reserve_button'])){
    $id = $_POST['reserve_id'];
    $name = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phonenumber']);
    $date = mysqli_real_escape_string($connection, $_POST['reserve_date']);
    $select_office = "SELECT * FROM offices WHERE id='$id'";
    $run_select_office = mysqli_query($connection, $select_office) or die(mysqli_error($connection));
    $office = mysqli_fetch_assoc($run_select_office);
    $officename = $office['name'];
    $owner = $office['owner'];
    $status = "new";
    $query = "INSERT INTO customers (name, email, phone, reservation_date, office_reserved, office_reserved_owner, status, office_reserved_id) VALUES ('$name', '$email', '$phone', '$date', '$officename', '$owner', '$status', '$id')";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query){
        header('location:offices.php');
    }
    else{
        echo "Reservation failed";
    }

}

?>