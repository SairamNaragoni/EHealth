
<div class="row">
    <div class="col-sm-12 mail-w3agile">
        <section class="panel">
            <header class="panel-heading wht-bg">
             <h4 class="gen-case">Past Appointments</h4>
         </header>
         <div class="panel-body minimal">
            <div class="table-inbox-wrap ">
                <table class="table table-inbox table-hover">
                        <?php
                        $date1 =  date('Y-m-d');
                        $query = "SELECT * FROM appointments INNER JOIN users ON appointments.uid=users.id WHERE approval=1 AND appointments.date<'{$date1}'";
                        $result = mysqli_query($conn,$query);
                        if (mysqli_num_rows($result)>0) {
                            ?>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Customer No</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>View Report</th>
                    <tbody>
                            <?php  
                            while ($row = mysqli_fetch_assoc($result)) {                            
                                ?>
                                <tr class="">
                                    <td class="inbox-small-cells">1</td>
                                    <td class="view-message dont-show" ><?php echo $row['username']?></td>
                                    <?php 
                                    $query1 = "SELECT * FROM doctor INNER JOIN users ON doctor.uid=users.id WHERE dapproved=1 LIMIT 1";
                                    $result1 = mysqli_query($conn,$query);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    ?>
                                    <td class="view-message dont-show" ><?php echo $row1['username']?></td>
                                    <td class="view-message dont-show" ><?php echo $row['reason']?></td>
                                    <td class="view-message dont-show" ><?php echo $row['phone']?></td>
                                    <td class="view-message dont-show" ><?php echo $row['date']?></td>
                                    <td class="view-message dont-show" ><?php echo $row['approved_time']?></td>
                                    <td class="view-message view-message"><a href="report.php?a_id=<?php echo $row['aid']?>" id="approve">View Report</a></td>
                                </tr>    
                            <?php }}
                            else { ?>
                            <tbody>
                            <tr class="">
                                    <td class="view-message dont-show" id="name">No Past Appointments</td>
                                </tr>   
                                <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
        <!-- page end