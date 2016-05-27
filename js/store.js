var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";



$(".edit-store-update-btn").click(function(){
	var shop_name = $('#edit-store-name').val();
	var shop_country = $('#edit-shop-country-dropdown').val();
	var shop_url = $('#edit-store-url').val();
	
	var url = apiURL + "shop.php";
	var inputObj = {
		"action":"shopAddEdit",
		"shop_name":shop_name,
		"shop_country":shop_country,
		"shop_url":shop_url
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if( (output.status == "true") && ( (output.message == 'Shop Add success') || (output.message == 'Shop Edit success') ) )
		{	
			location.reload();
		}
		else
		{
// 			alert("Logout Fail");
		}
	});
});

function getShopDetails() {
	var url = apiURL + "shop.php";
	var inputObj = {
		"action":"shopGetDetails"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Shop Get Details success'))
		{	
			var shop_name = output.data[0].shop_name;
			var shop_country = output.data[0].shop_country;
			var shop_url = output.data[0].shop_url;
			
			$('#edit-store-name').val(shop_name);
			$('#edit-shop-country-dropdown').val(shop_country);
			$('#edit-store-url').val(shop_url);
		}
		else
		{
			if(output.message == 'No Shop yet') {
				
			}
		}
	});
}

$(document).ready(function(){
	getShopDetails();
});