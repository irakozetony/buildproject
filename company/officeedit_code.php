<?php
include('security.php');
if(isset($_POST['update_button'])){
    $id = $_POST['edit_id'];
    $name = mysqli_real_escape_string($connection, $_POST['edit_name']);
    $location = mysqli_real_escape_string($connection, $_POST['edit_location']);
    $category = mysqli_real_escape_string($connection, $_POST['edit_category']);
    $price = mysqli_real_escape_string($connection, $_POST['edit_price']);
    $status = mysqli_real_escape_string($connection, $_POST['edit_status']);
    $image = mysqli_real_escape_string($connection, $_FILES['edit_image']['name']);

    $query = "UPDATE offices SET name='$name', location='$location', category='$category', price='$price', status='$status', image='$image' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
    move_uploaded_file($_FILES['edit_image']['tmp_name'], "officeimages/".$image);

    if($query_run){
        $_SESSION['success'] = "Office information updated successfully";
        header('location: offices.php');
    }
    else{
        $_SESSION['status'] = "Office information not updated";
        header('location: offices.php');
    }
}

if(isset($_POST['delete_button'])){
    $id = $_POST['delete_id'];
    
    $query = "DELETE FROM offices WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $_SESSION['success'] = "Office deleted";
        header('location: offices.php');
    }
    else{
        $_SESSION['status'] = "Office not deleted";
        header('location: offices.php');
    }
}
?>