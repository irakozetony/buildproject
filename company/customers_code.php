<?php
include('security.php');

if (isset($_GET['approve_id'])) {
    $id = $_GET['approve_id'];
    $status = "approved";
    $query = "UPDATE customers SET status='$status' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $select_query = "SELECT * FROM customers WHERE id='$id'";
    $run_select_query = mysqli_query($connection, $select_query) or die(mysqli_error($connection));
    $selected_customer = mysqli_fetch_assoc($run_select_query);

    $name = $selected_customer['name'];
    $date = $selected_customer['reservation_date'];
    $phone = $selected_customer['phone'];

    if ($query_run) {  
        $update_office = "UPDATE offices JOIN customers on customers.office_reserved_id = offices.id set offices.status='occupied' WHERE customers.id='$id'";
        $update_office_run = mysqli_query($connection, $update_office) or die(mysqli_error($connection));
        $_SESSION['success'] = "Status updated: approved";
        header('location:customers.php');
        sendSMS($name, $date, $phone);
    } else {
        $_SESSION['status'] = "Status not updated";
        header('location:customers.php');
    }
}

if (isset($_GET['disapprove_id'])) {
    $id = $_GET['disapprove_id'];
    $status = "rejected";
    $query = "UPDATE customers SET status='$status' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($query_run) {
        $_SESSION['success'] = "Status updated: disapproved";
        header('location:customers.php');
    }else {
        $_SESSION['status'] = "Status not updated";
        header('location:customers.php');
    }
}

function sendSMS($name, $date, $phone)
{
    $data    =    array(
        "sender" => '+250788622754',
        "recipients" => $phone,
        "message" => 'Hello ' .$name. ', your reservation for the office on ' .$date . ' has been approved. Thank you for working with us'
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
?>