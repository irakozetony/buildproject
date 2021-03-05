<page>
    <?php
    session_start();



    // $user=mysqli_query($connection,"select * from users where id='$user'");
    // $use=mysqli_fetch_array($user);

    // echo "UserName:".$use['username']."<br>";
    // echo "Email:".$use['email']."<br>";
    // echo "User_type:".$use['usertype']."<br>";

    $owner = $_SESSION['username'];
    $query = "SELECT offices.name as office_name, offices.category as office_category,
                            customers.name as customer_name, customers.reservation_date as reservation_date 
                            FROM offices, customers 
                            WHERE offices.owner='$owner' AND offices.status='occupied'
                            AND customers.office_reserved_id = offices.id
                            AND customers.reservation_date BETWEEN '$start' AND '$end'
                            AND customers.status = 'approved'";
    $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));
    ?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>N<sup>o</sup></th>
                <th>Office name</th>
                <th>Office category</th>
                <th>Customer name</th>
                <th>Reservation date</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (mysqli_num_rows($query_run) > 0) {
                $a = 1;
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <tr>
                        <td><?php echo $a; ?></td>
                        <td><?php echo $row['office_name']; ?></td>
                        <td><?php echo $row['office_category']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['reservation_date']; ?></td>
                    </tr>
            <?php
                    $a++;
                }
            } else {
                echo '<div class="card border-left-danger" style=" border-radius: 0px; padding: 25px;">No Records Found</div>';
            }
            ?>
        </tbody>
    </table>

</page>