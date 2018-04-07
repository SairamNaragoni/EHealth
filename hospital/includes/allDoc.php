<!-- page start-->
        <div class="row">
            <div class="col-sm-12 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">All Doctors</h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                        <tbody>
                        <?php 
                        $query = "SELECT * FROM doctor INNER JOIN users ON users.id=doctor.uid WHERE dapproved=1 AND user_type=2";
                        $result = mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_assoc($result)) {                        	
                        ?>
                        <tr class="">
                            <td class="inbox-small-cells">1</td>
                            <td class="view-message dont-show"><?php echo $row['username']?></td>
                            <td class="view-message dont-show"><?php echo $row['email']?></td>
                            <td class="view-message dont-show"><?php echo $row['phone']?></td>
                            <td class="view-message dont-show" id="approve">View License</td>
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