$('#approve').on('click',function(e){
	e.preventDefault();
	var aid = $('.aid').val();
	$.ajax({
		url: "ajax/updateApproval.php",
		method : "post",
		data: '&aid='+aid,
		success: function(response){
			location.reload();
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
	
});