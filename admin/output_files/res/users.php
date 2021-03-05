
<?php

$user=mysqli_query($connection,"select * from users");
while($users=mysqli_fetch_array($user))
{
?>
<page >
<table>
<tr><th>Name</th><th>email</th><th>user_type</th></tr>
<tr><td><?php echo $users['username'];?></td><td><?php echo $users['email'];?></td><td><?php echo $users['usertype'];?></td></tr>
</table>
</page>
<?php
}
?>