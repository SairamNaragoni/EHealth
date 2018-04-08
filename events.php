<?php include('includes/header.php') ?>
<?php
  include('includes/connection.php');
  $query = "SELECT * FROM events";
  $result = mysqli_query($conn,$query);
  $num_rows = mysqli_num_rows($result);
?>
<?php 
    function getHname($hid)
    {
      include('includes/connection.php');
      $h_query = "SELECT * from hospital where h_id= '$hid'";
      $h_result = mysqli_query($conn,$h_query);
      $h_row = mysqli_fetch_assoc($h_result);
      return $h_row['hname'];
    }
?>
<section id="main-content">
	<section class="wrapper">
		<div class="col-sm-9 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">Events</h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="table-inbox-wrap ">
                      <table class="table" ui-jq="footable" ui-options='{
                        "paging": {
                          "enabled": true
                        },
                        "filtering": {
                          "enabled": true
                        },
                        "sorting": {
                          "enabled": true
                        }}'>
                        <thead>
                          <tr>
                            <th data-breakpoints="xs">Event Name</th>
                            <th>Event Description</th>
                            <th data-breakpoints="xs">Event Date</th>
                            <th>Hospital</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if($num_rows>0): ?>
                          <?php while($row = mysqli_fetch_array($result)) : ?>
                          <tr>
                            <td><?php echo $row['ename']; ?></td>
                            <td><?php echo $row['edescription']; ?></td>
                            <td><?php echo $row['edate']; ?></td>
                            <td><?php echo getHname($row['hid']); ?></td>
                          </tr>
                        <?php endwhile; ?>
                      <?php else: ?>
                          <tr>
                            <td>No Data</td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        <?php endif; ?>
                        </tbody>
                      </table>
                        </div>
                    </div>
                </section>
            </div>
			<div class="clearfix"> </div>
		</div>
</section>
<?php include('includes/footer.php') ?>