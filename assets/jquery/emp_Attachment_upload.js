$(document).ready(function(){

   /*   
for(var key in inputFile) {
    alert('key: ' + key + '\n' + 'value: ' + inputFile[key]);
}*/
	
	$('#upload-btn').on('click', function(event) {
        var inputFile = $('input[name=file]');
        var filetitle=$("#attachmenttitle").val();
        var filedesc=$("#attachmentdesc").val();
	var uploadURI = $('#form-upload').attr('action');
	var progressBar = $('#progress-bar');

		var fileToUpload = inputFile[0].files[0];
		//alert(fileToUpload);
		// make sure there is file to upload
		if (fileToUpload != 'undefined') {
			// provide the form data
			// that would be sent to sever through ajax
			var formData = new FormData();
			formData.append("file", fileToUpload);
                        formData.append("attachmenttitle", filetitle);
                        formData.append("attachmentdesc", filedesc);

			// now upload the file using $.ajax
			$.ajax({
				url: uploadURI,
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				success: function(data) {
       
                                    if(data==1){
                                     ShowActionMessage("The Attachment Uploaded successfully", true);
					loadTableData()
                                        $("#form-upload").trigger('reset');
                                    } else {
                                        ShowActionMessage("Fail to upload attachment", false);
                                        loadTableData()
                                    }
				},
				xhr: function() {
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(event) {
						if (event.lengthComputable) {
							var percentComplete = Math.round( (event.loaded / event.total) * 100 );
							// console.log(percentComplete);
							
							$('.progress').show();
							progressBar.css({width: percentComplete + "%"});
							progressBar.text(percentComplete + '%');
						};
					}, false);

					return xhr;
				}
			});
		}
	});
/*
	$('body').on('click', '.remove-file', function () {
		var me = $(this);

		$.ajax({
			url: uploadURI,
			type: 'post',
			data: {file_to_remove: me.attr('data-file')},
			success: function() {
				me.closest('li').remove();
			}
		});

	})
        */
/*
	function listFilesOnServer () {
		var items = [];

		$.getJSON(uploadURI, function(data) {
			$.each(data, function(index, element) {
				items.push('<li class="list-group-item">' + element  + '<div class="pull-right"><a href="#" data-file="' + element + '" class="remove-file"><i class="glyphicon glyphicon-remove"></i></a></div></li>');
			});
			$('.list-group').html("").html(items.join(""));
		});
	}
*/
	$('body').on('change.bs.fileinput', function(e) {
		$('.progress').hide();
		progressBar.text("0%");
		progressBar.css({width: "0%"});
	});
               
            
        
})