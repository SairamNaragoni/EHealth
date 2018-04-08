$(document).on('click',".reportSubmit",function(e){
	var aid = $('.aid').val();
	var summary = $('.summary').val();
	var prescription = $('.prescription').val();
	var property = document.getElementById('file').files[0];
    var form_data = new FormData();
    form_data.append("file",property);
    form_data.append("summary",summary);
    form_data.append("prescription",prescription);
    form_data.append("aid",aid);
    $.ajax({
        url: "ajax/submitReport.php",
        type: 'POST',
        data: form_data,
        async: false,
        success: function (data) {
           alert(data);
           $('#myModal').modal('toggle');
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});