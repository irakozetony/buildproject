<page>
<?php
$user=mysqli_query($connection,"select * from users where id='$user'");
$use=mysqli_fetch_array($user);

echo "UserName:".$use['username']."<br>";
echo "Email:".$use['email']."<br>";
echo "User_type:".$use['usertype']."<br>";
?>

</page>