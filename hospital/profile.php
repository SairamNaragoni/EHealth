<?php include('includes/header.php') ?>
<section id="main-content">
	<section class="wrapper">
		<div class="mail-w3agile">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12 com-w3ls">
                <section class="panel">
                    <div class="panel-body" style="margin: auto;text-align: center;">
                        <ul class="nav nav-pills nav-stacked mail-nav" style="margin:auto;">
                        <?php 
                            $h_id = $_SESSION['h_id'];
                            $query = "SELECT * FROM hospital WHERE h_id='{$h_id}'";
                            $result = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                            <li style="display: inline-block;margin-right: auto;margin-left: auto;"><img class='' src="images/g8.jpg" alt='profile_img' style="display: block;border-radius: 50%" width='150px' height='150px'></li>
                            <li><a><?php echo $row['hname']?></a></li>
                            <li><a><?php echo $row['hmail']?></a></li>
                            <li><a><i class="fa fa-volume-control-phone" ></i>: <?php echo $row['hphone']?></a></li>
                            <li><a><?php echo $row['haddr']?></a></li>
                        </ul>
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

