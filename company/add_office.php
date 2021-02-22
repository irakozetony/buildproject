<?php

include('security.php');

if(isset($_POST['addoffice_button'])){
    $name = mysqli_real_escape_string($connection, $_POST['officename']);
    $location = mysqli_real_escape_string($connection, $_POST['officelocation']);
    $category = mysqli_real_escape_string($connection, $_POST['officecategory']);
    $price = mysqli_real_escape_string($connection, $_POST['officeprice']);
    $image = mysqli_real_escape_string($connection, $_FILES['officeimage']['name']);
    $status = mysqli_real_escape_string($connection, $_POST['officestatus']);
    $owner = $_SESSION['username'];

    $query = "INSERT INTO offices (name, location, category, price, image, status, owner) VALUES ('$name', '$location', '$category', '$price', '$image', '$status', '$owner') ";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
    move_uploaded_file($_FILES['officeimage']['tmp_name'], "officeimages/".$image);

    if($query_run){
        $_SESSION['success'] = "New office added";
        header('location: offices.php');
    }
    else{
        $_SESSION['status'] = "Office not added";
        header('location: offices.php');
    }
}

?>