<?php
include('security.php');
if(isset($_GET['admit_id'])){
    $id = $_GET['admit_id'];
    $query = "UPDATE users SET useractive=1 WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($query_run){
        $select_query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($connection, $select_query) or die(mysqli_error($connection));
        $user = mysqli_fetch_assoc($result);

        $username = $user['username'];
        $email = $user['email'];
        $phone = $user['phone'];
        $type = $user['usertype'];
        $password = $user['password'];

        $query = "INSERT INTO companies (username, email, phone, password, usertype) VALUES('$username', '$email', '$phone', '$password', '$type')";
        $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
        if($query_run){
            $_SESSION['success'] = "User admitted";
            header('location: newusers.php');
            sendSMS($username, $phone);
        }
    }
    else{
        $_SESSION['status'] = "User admission failed";
        header('location: newusers.php');
    }
}
function sendSMS($username, $phone)
{
    $data    =    array(
        "sender" => '+250788622754',
        "recipients" => $phone,
        "message" => 'Hello ' .$username. ', your user registration is complete. You can now login'
    );
    $url    =    "https://www.intouchsms.co.rw/api/sendsms/.json";
    $data    =    http_build_query($data);
    $username = "irakozetony";
    $password = "4SZUGpce8nL2.3Z";
    $ch    =    curl_init();
    curl_setopt($ch, CURLOPT_URL,    $url);
    curl_setopt($ch,    CURLOPT_USERPWD,    $username    .    ":"    .    $password);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,    CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,    CURLOPT_SSL_VERIFYPEER,    0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,    $data);
    $result    =    curl_exec($ch);
    $httpcode    =    curl_getinfo($ch,    CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo    $result;
    echo    $httpcode;
}