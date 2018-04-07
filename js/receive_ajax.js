var interval = null;
var locaInterval = null;
$(document).on('ready',function(){
    interval = setInterval(receiveUserRequest,1000);
    locaInterval = setInterval(updateLocation,1000);
});

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
					$('#user_info').html("<p>Username : "+response[0].username+"</p><p> Phone : " + response[0].phone + "</p>");
					clearInterval(interval);
				}
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
}

function updateLocation(){
	var dr_id = $('#dr_id').val();
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