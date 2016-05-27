var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";
var img_base64 = "";
var filename = "";
// var file_extension = "";


// you can do this once in a page, and this function will appear in all your files 
File.prototype.convertToBase64 = function(callback){
	var FR = new FileReader();
	FR.onload = function(e) {
		callback(e.target.result)
	};       
	FR.readAsDataURL(this);
}

$("#fash-profile-image").on('change',function(){
	var selectedFile = this.files[0];
// 	console.log(this.files[0]['name']);
	filename = this.files[0]['name'];
// 	file_extension = getFileNameExtension(this.files[0]['name']);
// 	console.log(file_extension);
// 	$("#fash-profile-image-filename").html(filename);
	
	selectedFile.convertToBase64(function(base64){
		img_base64 = base64;
		
// 		var test64 = splitBase64Image(img_base64);
// 		console.log(test64);
	}) 
});

function splitBase64Image(base64_image) {
	var img_b = base64_image.split(",");
	
	return img_b[1];
}

/*
function getFileNameExtension(filename) {
	return filename.substr(filename.lastIndexOf('.')+1);
}
*/

$(".edit-profile-update-btn").click(function(){
	var profile_email = $('#edit-profile-email').val();
	var profile_name = $('#edit-profile-name').val();
	var profile_username = $('#edit-profile-username').val();
	var profile_desc = $('#edit-profile-desc').val();
	var img_base64_split = splitBase64Image(img_base64);
	
	var url = apiURL + "member.php";
	var inputObj = {
		"action":"memberEditProfile",
		"member_email":profile_email,
		"member_name":profile_name,
		"member_username":profile_username,
		"member_desc":profile_desc,
		"member_image_base64":img_base64_split,
		"member_image_name":filename
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Member Edit success'))
		{	
			location.reload();
		}
		else
		{
			alert("Member Edit Fail");
		}
	});
});


function memberGetProfile() {
	var url = apiURL + "member.php";
	var inputObj = {
		"action":"memberGetProfile"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Member Get Profile success'))
		{	
			var member_email = output.data[0].member_email;
			var member_name = output.data[0].member_name;
			var member_username = output.data[0].member_username;
			var member_dir = output.data[0].member_dir;
			var member_logo_image_name = output.data[0].member_logo_image_name;
			var member_description = output.data[0].member_description;
			
			var img_html = "";
			
			
			$('#edit-profile-email').val(member_email);
			$('#edit-profile-name').val(member_name);
			$('#edit-profile-username').val(member_username);
			$('#edit-profile-desc').val(member_description);
			
			if (member_logo_image_name)
				img_html = "<img class='col-xs-12' src='" + member_dir + member_logo_image_name + "' />";
	         else
	         	img_html = "No logo yet";
			
			$('#edit-profile-logo').html(img_html);
		}
		else
		{
			if(output.message == 'No Shop yet') {
				
			}
		}
	});
}

$(document).ready(function(){
	memberGetProfile();
});