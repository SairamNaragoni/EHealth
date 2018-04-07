<!-- page start-->
        <div class="row">
            <div class="col-sm-12 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">All Customers</h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                        <tbody>
                        <?php 
                        $query = "SELECT * FROM users INNER JOIN appointments ON users.id=appointments.uid WHERE approval=1 AND hid='{$_SESSION['h_id']}'";
                        $result = mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_array($result)) {                        	
                        ?>
                        <tr class="">
                            <td class="inbox-small-cells">1</td>
                            <td class="view-message dont-show"><?php echo $row['username']?></td>
                            <td class="view-message dont-show"><?php echo $row['email']?></td>
                            <td class="view-message dont-show"><?php echo $row['phone']?></td>
                            <td class="view-message dont-show"><?php echo $row['date']?></td>
                            <td class="view-message dont-show"><?php echo $row['approved_time']?></td>
                            <td class="view-message dont-show" id="approve"><a href="appointments.php?type=2&uid=<?php echo $row['uid']?>">View Details</a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->