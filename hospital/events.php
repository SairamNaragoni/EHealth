
<?php include('includes/header.php') ?>
<?php
  
  $hid = $_SESSION['h_id'];
  if(isset($_GET['event'])&&isset($_GET['description']))
  {
       $query = "INSERT INTO `events` (`ename`,`edescription`,`hid`) VALUES ( '".$_GET['event']."' , '".$_GET['description']."' , '".$hid."')";
       $result = mysqli_query($conn,$query);
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
            <form action="events.php" method="get">
            <div class="form-group">
                <label for="exampleInput">Event</label>
                <input type="text" class="form-control" id="exampleInput" name="event" placeholder="Event">
            </div>
            <div class="">
                
                <label>Description : </label>
                        <textarea name="description" rows="5" cols="80" required="" style="height: 100px;" ></textarea>
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