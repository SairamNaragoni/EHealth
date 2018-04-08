
<?php include('includes/header.php') ?>
<?php

  $hid = $_SESSION['hid'];

  if(isset($_POST['event'])&&isset($_POST['description']))
  {
      
       $query = "INSERT INTO `events` (`ename`,`edescription`,`hid`) VALUES ( '".$_POST['event']."' , '".$_POST['description']."' , '".$hid."')";
       $result = mysqli_query($conn,$result);
       if(!$result){
          echo "Query Failed";
       }


  }

 

?>
<section id="main-content">
	<section class="wrapper">
		<div class="agil-info-calendar">
		<div class="col-md-2"></div>
		<div class="col-md-8 w3agile-notifications">
			<div class="notifications">
				<!--notification start-->
					<div class="panel-heading">Enter the Following Details of the Event  </div>
    <div>
        <h1></h1>
    <div class="bg-agile">
    <div class="book-appointment">
    <h2>Create An Event Here</h2>
    <br/>
            <form action="events.php" method="post">
            <div class="form-group">
                <label for="exampleInput">Event</label>
                <input type="password" class="form-control" id="exampleInput" name="event" placeholder="Event">
            </div>
            <div class="left-agileits-w3layouts same">
                <div class="gaps">
                <label>Description : </label>
                        <textarea name="description" rows="5" cols="102" required="" style="height: 80px;" ></textarea>
                </div>
            </div>
           
            <div class="clear"></div>
            <br/>
            <input type="submit" value="Submit" class="btn btn-info">
            </form>
        </div>
   </div>
    </div>
			</div>
				<!--notification end-->
				<div class="col-md-2"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
</section>




<?php include('includes/footer.php') ?>