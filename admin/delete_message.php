<?php
    include('security.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM contacts WHERE id='$id'";
        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
        if($query_run){
            $_SESSION['success'] = "Message deleted succesfully";
            header('location: messages.php');
        }
        else{
            $_SESSION['status'] = "Message not deleted";
            header('location: messages.php');
        }
    }
?>