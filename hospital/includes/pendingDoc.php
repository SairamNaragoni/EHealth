
<div class="row">
    <div class="col-sm-12 mail-w3agile">
        <section class="panel">
            <header class="panel-heading wht-bg">
             <h4 class="gen-case">Pending Approvals</h4>
         </header>
         <div class="panel-body minimal">
            <div class="table-inbox-wrap ">
                <table class="table table-inbox table-hover">
                        <?php 
                        $query = "SELECT * FROM doctor INNER JOIN users ON users.id=doctor.uid WHERE dapproved=0";
                        $result = mysqli_query($conn,$query);
                        if (mysqli_num_rows($result)>0) {
                            ?>
                            <th>Doctor</th>
                    <th>Approve</th>
                    <tbody>
                            <?php  
                            while ($row = mysqli_fetch_assoc($result)) {                            
                                ?>
                                <tr class="">
                                    <td class="inbox-small-cells">1</td>
                                    <td class="view-message dont-show" id="name"><?php echo $row['username']?></td>
                                    <td class="view-message view-message"><a href="" class="approve">Approve</a>
                                    <input type="hidden" class="did" value="<?php echo $row['did'];?>" ></td>
                                </tr>    
                            <?php }}
                            else { ?>
                            <tbody>
                            <tr class="">
                                    <td class="view-message dont-show" id="name">No Applications pending</td>
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