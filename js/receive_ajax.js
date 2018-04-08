var interval = null;
var locaInterval = null;
$(document).on('ready',function(){
	interval = setInterval(receiveUserRequest,5000);
	locaInterval = setInterval(updateLocation,10000);
});
function createUserMarker(place) {
	userMarker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(place.lat, place.lng)
	});
	directionsService.route({
		origin: myLoc,
		destination: new google.maps.LatLng(place.lat, place.lng),
		travelMode: 'DRIVING'
	}, function(response, status) {
		if (status === 'OK') {
			directionsDisplay.setDirections(response);
		} else {
			window.alert('Directions request failed due to ' + status);
		}
	});
}

function createHospMarker(hid) {
	service = new google.maps.places.PlacesService(map);
	service.getDetails({
		placeId: hid,
	}, function (result, status) {
		hospMarker = new google.maps.Marker({
			map: map,
			place: {
				placeId: hid,
				location: result.geometry.location
			}
		});
		directionsService.route({
			origin: myLoc,
			destination: result.geometry.location,
			travelMode: 'DRIVING'
		}, function(response, status) {
			if (status === 'OK') {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	});
}

function receiveUserRequest(){
	var dr_id = $('#dr_id').val();
	$.ajax({
		url: "ajax/receiveUserRequest.php",
		method : "post",
		data: '&dr_id='+dr_id,
		dataType: 'JSON',
		success: function(response){
			if(response=='0')
			{
				$('#user_info').html("<p>Driver Not Available.Searching...</p>");
			}
			else
			{
				// $('#user_info').html("<label class='col-sm-3 control-label col-lg-3'>Name Of the Patient :</label>"+response[0].username+
				// 	"<br><label class='col-sm-3 control-label col-lg-3'>Phone Of the Patient :</label>" + response[0].phone +
				// 	"<br><button class='btn btn-danger' id='destRec'>Destination Reached</button>");
				if (enabled == 1) {
					if (response[0].dest_reached==0) {
						$('#user_info').html("<label class='col-sm-3 control-label col-lg-3'>Name Of the Patient :</label>"+response[0].username+
					"<br><label class='col-sm-3 control-label col-lg-3'>Phone Of the Patient :</label>" + response[0].phone +
					"<br><button class='btn btn-danger' id='destRec'>Destination Reached?</button>");
						createUserMarker(response[0]);
					}
					else if(response[0].dest_reached==1 && response[0].hid ==-1){
						test(response[0].lat,response[0].lng);
					}
					else if(response[0].dest_reached==1 && response[0].hid !=-1){
						$('#user_info').html("<label class='col-sm-3 control-label col-lg-3'>Name Of the Patient :</label>"+response[0].username+
					"<br><label class='col-sm-3 control-label col-lg-3'>Phone Of the Patient :</label>" + response[0].phone +
					"<br><button class='btn btn-danger' id='finish'>Finish?</button>");
						createHospMarker(response[0].hid);
						console.log('inn');
					}
						// clearInterval(interval);
					}
				}
			},
			error : function(jqXHR,textStatus,errorThrown){
				console.log(textStatus,errorThrown);
			}
		});
}

function receiveHosp(){
	var dr_id = $('#dr_id').val();
	var hid = $('#hospId').val();
	// clearInterval(interval)
	console.log(markers);
	markers.forEach(function(marker) {
		marker.setMap(null);
	});
	console.log(markers);
	$.ajax({
		url: "ajax/driverHospRoute.php",
		method : "post",
		data: "&hid="+hid +"&dr_id=" + dr_id ,
		dataType: 'JSON',
		success: function(response){
			console.log(response[0]);
			window.location.reload(true);	

		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
}

function updateLocation(){
	var dr_id = $('#dr_id').val();
	var lat1,lng1;
	navigator.geolocation.getCurrentPosition(function(position)
	{
		lat1 = position.coords.latitude;
		lng1 = position.coords.longitude;
	});
	$.ajax({
		url: "ajax/updateLocation.php",
		method : "post",
		data: '&dr_id='+dr_id+'&lat='+lat1+'&lng='+lng1,
		success: function(response){
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
}

$(document).on('click',"#destRec",function(){
	var dr_id = $('#dr_id').val();
	$.ajax({
		url: "ajax/destRec.php",
		method : "post",
		data: '&dr_id='+dr_id,
		success: function(response){
			alert("Ride Successfull");
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
});

$(document).on('click',"#finish",function(){
	var dr_id = $('#dr_id').val();
	$.ajax({
		url: "ajax/finish.php",
		method : "post",
		data: '&dr_id='+dr_id,
		success: function(response){
			alert("Finished");
			window.location.reload();
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
});