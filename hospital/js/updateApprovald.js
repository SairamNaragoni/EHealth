$('.approve').on('click',function(e){
	e.preventDefault();
	var did = $('.did').val();
	$.ajax({
		url: "updateApprovald.php",
		method : "post",
		data: '&did='+did,
		success: function(response){
			location.reload();
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
	
});