<?php include('includes/header.php') ?>
<?php include('includes/connection.php');
	$message = "";
	if(isset($_GET['forme']))
	{
		$forme = $_GET['forme'];
		if(isset($_GET['lat']) && isset($_GET['lng']))
		{
			session_start();
			$query = "SELECT * FROM `emergency` WHERE uid = '".mysqli_real_escape_string($conn,$_SESSION['uid'])."' LIMIT 1";
            $result = mysqli_query($conn, $query);
           	if (mysqli_num_rows($result) > 0) {
                    $message = "Processing Your request";
                    $row = mysqli_fetch_array($result);
                    $last_id = $row['emer_id'];
            } 
            else
            {
            	$query = "INSERT INTO `emergency` (`uid`,`elat`,`elng`) VALUES ('".mysqli_real_escape_string($conn,$_SESSION['uid'])."',
				'".mysqli_real_escape_string($conn, $_GET['lat'])."','".mysqli_real_escape_string($conn, $_GET['lng'])."') ";
				$result = mysqli_query($conn,$query);
				if($result)
				{
					$last_id = mysqli_insert_id($conn);
					$message = "The Nearest Ambulance has been succesfully notifed.Waiting For Response";
                    $get_dr = 1;
				}
            }
			
		}
	}  
?>
<section id="main-content">
    <section class="wrapper" style="margin-top: 0px;">
        <div class="typo-agile">
        	<div class="grid_3 grid_4 w3layouts">
                <?php if(isset($get_dr)): ?>
                <button onclick="startTimer();" id="getdata">Click</button>
                <script type="text/javascript"> $('#getdata').trigger('click'); </script>
                <?php endif; ?>
                <h3 class="hdg">Notify Nearest Ambulance</h3>
                <h4><?php echo $message; ?></h4>
                <input type="hidden" name="emer_id" id="emer_id" value="<?php echo $last_id; ?>">
                <?php if($forme==0): ?>
                <form action="" method="post">
					<input type="number" name="aadharin" placeholder="aadhar">
					<input type="submit" value="notify victims family" name="submit">
				</form>
				<?php endif; ?>
				<div id="driver_info">
					
				</div>
            </div>	
        	
        </div>
</section>
<div id="map"></div>
</section>

    <script type="text/javascript">
    		<?php if(!isset($_GET['lat'])): ?>
                navigator.geolocation.getCurrentPosition(function(position)
                  {
                      lat1 = position.coords.latitude;
                      lng1 = position.coords.longitude;
                      window.location.href="emergency.php?lat="+lat1+"&lng="+lng1+"&forme=<?php echo $forme; ?>";
                  });
            <?php endif; ?>
    </script>
    <script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    var myLoc;
    var markers = [];
    var infowindow;
    function initAutocomplete() {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    function showPosition(position) {
        myLoc = { lat: position.coords.latitude, lng: position.coords.longitude };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLoc,
            zoom: 15,
            mapTypeId: 'roadmap'
        });
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: myLoc,
            radius: 1500,
            types: ['hospital', 'Hospital']
        }, callback);

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                createMarker(place)

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        function callback(results, status, pagination) {
            console.log(results);
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
                if (pagination.hasNextPage) {
                    console.log(pagination.nextPage());
                }
            }
        }
        function createMarker(place) {
        // var placeLoc = place.geometry.location;
        var mark = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });
        google.maps.event.addListener(mark, 'click', function() {
        	var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">' + place.name + '</h1>'+
            '<div id="bodyContent">'+
            '<a href="http://localhost/EHealth/book.php?hid='+place.place_id+'">'+
            'Click here to book Appointment</a> '+
            '</p>'+
            '</div>'+
            '</div>';
            infowindow.setContent(contentString);
            infowindow.open(map, this);
        });
        markers.push(mark);
    }
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvABQiBNANco06dejzBwEQ58Gd2nMP42o&libraries=places&callback=initAutocomplete" async defer></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>