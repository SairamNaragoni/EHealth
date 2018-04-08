
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
                                    <td> <a href="#myModal" data-toggle="modal" class="btn btn-success">View Report</a></td>
                                                <?php 
                                                    $aidhere = $row['aid'];
                                                    $report_query = "SELECT * FROM `report` WHERE aid = $aidhere";
                                                    $report_result = mysqli_query($conn,$report_query);
                                                    $report_row = mysqli_fetch_array($report_result);
                                                 ?>
                                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                        <h4 class="modal-title">Report</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" enctype="multipart/form-data" class="uform">
                                                            <div class="form-group">
                                                                <label for="summary">Summary</label>
                                                                 <textarea class="form-control summary" rows="3" name="summary" required=""><?php echo $report_row['summary']; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="prescription">Prescription</label>
                                                                 <textarea class="form-control prescription" rows="3" name="prescription" required=""><?php echo $report_row['prescription']; ?></textarea>
                                                            </div>
                                                            <div>
                                                                <a href="../images/reports/<?php echo $report_row['report']; ?>" data-toggle="modal" class="btn btn-success" target = "_blank">View File </a></td>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div></td>
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