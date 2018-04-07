<?php include('includes/header.php') ?>
<?php include("includes/connection.php"); ?>
<section id="main-content">
    <section class="wrapper">
        <div class="mail-w3agile">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-3 com-w3ls">
                <section class="panel">
                    <div class="panel-body" style="margin: auto;text-align: center;">
                        <ul class="nav nav-pills nav-stacked mail-nav" style="margin:auto;">
                        <?php 
                            $uid = $_SESSION['uid'];
                            $query = "SELECT * FROM users WHERE id={$uid}";
                            $result = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                            <li style="display: inline-block;margin-right: auto;margin-left: auto;"><img class='' src="images/avatars/<?php echo $row['avatar']?>" alt='profile_img' style="display: block;border-radius: 50%" width='150px' height='150px'></li>
                            <li><a>Name : <?php echo $row['username']?></a></li>
                            <li><a><?php echo $row['email']?></a></li>
                            <li><a><i class="fa fa-volume-control-phone" ></i>: +91<?php echo $row['phone']?></a></li>
                            <li><a href="#"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-sm-9 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">Profile</h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Aadhar No</td>
                            <td class="view-message view-message"><?php echo $row['aadhar']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Date of Birth</td>
                            <td class="view-message view-message"><?php echo $row['dob']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Blood Group</td>
                            <td class="view-message view-message"><?php echo $row['bloodgroup']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Emergency Contact 1</td>
                            <td class="view-message view-message"><?php echo $row['emer1']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Emergency Contact 2</td>
                            <td class="view-message view-message"><?php echo $row['emer2']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Permanent Residence</td>
                            <td class="view-message view-message"><?php echo $row['addr']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Pincode</td>
                            <td class="view-message view-message"><?php echo $row['pincode']?></td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells"></i></td>
                            <td class="view-message dont-show">Medical History</td>
                            <td class="view-message view-message"><?php echo $row['medicalHis']?></td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </div>
</section>
<?php include('includes/footer.php') ?>
</section>
<!--main content end-->
</section>

