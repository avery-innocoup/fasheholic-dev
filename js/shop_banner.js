var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";
var img_base64 = "";
var filename = "";


// you can do this once in a page, and this function will appear in all your files 
File.prototype.convertToBase64 = function(callback){
	var FR = new FileReader();
	FR.onload = function(e) {
		callback(e.target.result)
	};       
	FR.readAsDataURL(this);
}

$("#fash-banner-image").on('change',function(){
	var selectedFile = this.files[0];
	filename = this.files[0]['name'];
	
	selectedFile.convertToBase64(function(base64){
		img_base64 = base64;
	}) 
});

function splitBase64Image(base64_image) {
	var img_b = base64_image.split(",");
	
	return img_b[1];
}


$(".edit-banner-update-btn").click(function(){
	var img_base64_split = splitBase64Image(img_base64);
	
	var url = apiURL + "shop.php";
	var inputObj = {
		"action":"shopEditBanner",
		"banner_image_base64":img_base64_split,
		"banner_image_name":filename
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Shop Edit Banner success'))
		{	
			location.reload();
		}
		else
		{
			alert("Shop Edit Banner Fail");
		}
	});
});


function shopGetBanner() {
	var url = apiURL + "shop.php";
	var inputObj = {
		"action":"shopGetBanner"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Shop Get Banner success'))
		{	
			var banner_dir = output.data[0].banner_dir;
			var shop_banner_image_name = output.data[0].shop_banner_image_name;
			
			var img_html = "";
			
			if (shop_banner_image_name)
				img_html = "<img class='col-xs-12' src='" + banner_dir + shop_banner_image_name + "' />";
	         else
	         	img_html = "No banner yet";
			
			$('#edit-shop-banner').html(img_html);
		}
		else
		{
			if(output.message == 'No Shop yet') {
				
			}
		}
	});
}

$(document).ready(function(){
	shopGetBanner();
});