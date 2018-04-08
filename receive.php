<?php include('includes/header.php'); ?>
<?php include('includes/connection.php');
session_start();
$uid = $_SESSION['uid'];
$dr_query = "SELECT dr_id FROM `driver` WHERE uid = $uid LIMIT 1";
$dr_result = mysqli_query($conn,$dr_query);
$dr_row = mysqli_fetch_array($dr_result);
$driver_id = $dr_row['dr_id'];
?>
<section id="main-content">
    <section class="wrapper" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="typo-agile">
            <div class="grid_3 grid_4 w3layouts">
                <h3 class="hdg">Receive | Select Hospital</h3>
                <div class="bs-example">
                 <div class="panel panel-default" >
                    <input id="pac-input" class="controls" type="text" placeholder="SearchBox">
                    <input type="hidden" name="driver_id" id="dr_id" value="<?php echo $driver_id; ?>">
                    <a href="" onclick="initAutocomplete();"><i class="fa fa-refresh"></i></a>

                    <br>
                    <div id="user_info" style="padding-left: 15px;"></div>
                </div>
            </div>
        </div>
        <div class="row" style="width: 100%;height: 100%;">

        </div><!-- /.row -->
    </div>
</section>
<div id="map"></div>
</section>
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
    var enabled = 0;
    var map;
    var myMarker;
    var userMarker;
    var hospMarker;
    var directionsService;
    var directionsDisplay;
    var service;
    function initAutocomplete() {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    function showPosition(position,set=0) {
        myLoc = { lat: position.coords.latitude, lng: position.coords.longitude };
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLoc,
            zoom: 15,
            mapTypeId: 'roadmap'
        });
        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);
        infowindow = new google.maps.InfoWindow();
}
    function callback(results, status, pagination) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
            if (pagination.hasNextPage) {
                pagination.nextPage();
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
                '<a onclick="receiveHosp()">'+
                'Click here to route<input type="hidden" id="hospId" value="'+ place.place_id + '"</a> '+
                '</p>'+
                '</div>'+
                '</div>';
                infowindow.setContent(contentString);
                infowindow.open(map, this);
            });
            markers.push(mark);
        }

        function myMarkerCb(place){
            if (myMarker != undefined) {
                myMarker.setMap(null);
            }
            var pinColor = "FE7569";
            var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                new google.maps.Size(21, 34),
                new google.maps.Point(0, 0),
                new google.maps.Point(10, 34));
            var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                new google.maps.Size(40, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(12, 35));
            myMarker= new google.maps.Marker({
                map: map,
                icon: pinImage,
                position: new google.maps.LatLng(place.coords.latitude, place.coords.longitude)
            });
        }
        function createMyMarker(){
            navigator.geolocation.getCurrentPosition(myMarkerCb);
        }
        setInterval(createMyMarker,2000);
        enabled = 1;
        function test(place){
            markers = [];
            directionsDisplay.setMap(null);
            service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: myLoc,
            radius: 1500,
            types: ['hospital', 'Hospital']
        }, callback);
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

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
                    createMarker(place);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvABQiBNANco06dejzBwEQ58Gd2nMP42o&libraries=places&callback=initAutocomplete" async defer></script>
<script src="js/receive_ajax.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>