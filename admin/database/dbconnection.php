<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php
$server_name = "localhost";
$db_username = 'root';
$db_password = '';
$db_name = 'buildproject';
$connection = mysqli_connect($server_name, $db_username, $db_password);
$dbconfig = mysqli_select_db($connection, $db_name);

if($dbconfig){
}
else{
    echo '
    <div class="container-fluid" style="margin-top: 15rem;">
    <div class="text-center">
        <div class="error mx-auto" data-text="404">:(</div>
        <p class="lead text-gray-800 mb-5">DB Connection Error</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>

    </div>

</div>
    ';
}

?>