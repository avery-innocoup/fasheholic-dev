$('.add-product-area').click(function(){
	$(this).slideUp();
	setTimeout(fade, 500);
});
$('.delete-product-area').click(function(){
	$('.add-display-container').slideUp();
	setTimeout(fade1, 500);
});


function fade()
{
    $('.add-display-container').slideDown();
}

function fade1()
{
    $('.add-product-area').slideDown();
}


var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";
var img_base64 = "";
var filename = "";
var file_extension = "";


// you can do this once in a page, and this function will appear in all your files 
File.prototype.convertToBase64 = function(callback){
	var FR = new FileReader();
	FR.onload = function(e) {
		callback(e.target.result)
	};       
	FR.readAsDataURL(this);
}

$("#fash-product-image").on('change',function(){
	var selectedFile = this.files[0];
// 	console.log(this.files[0]['name']);
	filename = this.files[0]['name'];
	file_extension = getFileNameExtension(this.files[0]['name']);
// 	console.log(file_extension);
	$("#fash-product-image-filename").html(filename);
	
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

function getFileNameExtension(filename) {
	return filename.substr(filename.lastIndexOf('.')+1);
}

$(".product-upload-btn").click(function(){
	var product_name = $('.product-name').val();
	var product_cat = $('.product-cat').val();
	var product_myr_price = $('.product-myr-price').val();
	var product_usd_price = $('.product-usd-price').val();
	var product_desc = $('.product-desc').val();
	var img_base64_split = splitBase64Image(img_base64);
	
	var url = apiURL + "product.php";
	var inputObj = {
		"action":"productAdd",
		"product_name":product_name,
		"product_cat":product_cat,
		"product_myr_price":product_myr_price,
		"product_usd_price":product_usd_price,
		"product_desc":product_desc,
		"product_image_base64":img_base64_split,
		"product_image_name":filename,
		"product_image_ext":file_extension
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Product Add success'))
		{	
			location.reload();
		}
		else
		{
			alert("Product Add Fail");
		}
	});
});
