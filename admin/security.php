<?php
session_start();
include('database/dbconnection.php');

if($dbconfig){
}
else{
    header('location:database/dbconnection.php');
}
if(!$_SESSION['username']){
    header('location: login.php');
}
?>