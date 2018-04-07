var interval = null;
var locaInterval = null;
$(document).on('ready',function(){
    interval = setInterval(receiveUserRequest,1000);
    locaInterval = setInterval(updateLocation,1000);
});
function createUserMarker(place) {
	var mark = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(place.lat, place.lng)
	});
	google.maps.event.addListener(mark, 'click', function() {

		infowindow.setContent("contentString");
		infowindow.open(map, this);
	});
	console.log(place.lat);
	// markers.push(mark);
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
					$('#user_info').html("<label class='col-sm-3 control-label col-lg-3'>Name Of the Patient :</label>"+response[0].username+
						"<br><label class='col-sm-3 control-label col-lg-3'>Phone Of the Patient :</label>" + response[0].phone +
						"<br><button class='btn btn-danger' id='destRec'>Destination Reached</button>");
					if (enabled == 1) {
						createUserMarker(response[0]);
					clearInterval(interval);
					}
				}
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