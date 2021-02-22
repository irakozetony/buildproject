<?php
session_start();
include('database/dbconnection.php');
if(!$_SESSION['username']){
    header('location: login.php');
}
?>