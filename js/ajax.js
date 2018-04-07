var interval = null;
$(document).on('ready',function(){
    interval = setInterval(updateResponse,1000);
});
function updateResponse(){
	var last_id = $('#emer_id').val();
	$.ajax({
		url: "ajax/getDriverResponse.php",
		method : "post",
		data: '&emer_id='+last_id,
		success: function(response){
				if(response=='0')
				{
					$('#driver_info').html("<p>Driver Not Available.Searching...</p>");
				}
				else
				{
					$('#driver_info').html(response);
					 clearInterval(interval);
				}	
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
}