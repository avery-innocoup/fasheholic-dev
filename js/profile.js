var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";



function profileGetDetails() {
	var url = apiURL + "profile.php";
	var inputObj = {
		"action":"profileGetDetails"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Profile Get Details success'))
		{	
			var shop_name = output.data[0].shop_name;
			var shop_country = output.data[0].shop_country;
			var shop_banner_image_name = output.data[0].shop_banner_image_name;
			var member_logo_image_name = output.data[0].member_logo_image_name;
			var member_description = output.data[0].member_description;
			var banner_dir = output.data[0].banner_dir;
			var logo_dir = output.data[0].logo_dir;
			var total_product = output.data[0].total_product;
			var product_dir = output.data[0].product_dir;
			
			var banner_html = "";
			var logo_html = "";
	
			var i;
			var prod_html = "";
			
			if (shop_banner_image_name)
				banner_html = "<img class='col-xs-12 no-padding' src='" + banner_dir + shop_banner_image_name + "' />";
	         else
	         	banner_html = "No banner yet";
	         	
			if (member_logo_image_name)
				logo_html = "<img class='col-xs-12' src='" + logo_dir + member_logo_image_name + "' />";
	         else
	         	logo_html = "No logo yet";
			
			$('#profile-banner').html(banner_html);
			$('#profile-logo').html(logo_html);
			$('#profile-shop-name').html(shop_name);
			$('#profile-desc').html(member_description);
			
			
			for (i=0; i<total_product; ++i) {
				product_id = output.data[0].product_obj[i].product_id;
				product_name = output.data[0].product_obj[i].product_name;
				product_desc = output.data[0].product_obj[i].product_desc;
				product_myr_price = output.data[0].product_obj[i].product_myr_price;
				product_usd_price = output.data[0].product_obj[i].product_usd_price;
				product_image_name = output.data[0].product_obj[i].product_image_name;
			    
			    
			    prod_html += "<div class='col-xs-12 col-sm-6 col-md-4 product-container-next'>";
			    prod_html += "<div class='col-xs-12 product-container-each no-padding'>";
			    prod_html += "<div class='col-xs-12 no-padding' style='background-image: url(" + product_dir + product_image_name + "); background-size: cover; background-position: 50% 50%; height: 250px'>";
			    prod_html += "</div>";
			    prod_html += "<div class='col-xs-12'>";
			    prod_html += "<div class='col-xs-12 product-name'>";
			    prod_html += product_name;
			    prod_html += "</div>";
			    prod_html += "<div class='col-xs-12 product-price'>MYR ";
			    prod_html += product_myr_price;
			    prod_html += "</div>";
			    prod_html += "</div></div></div>";
			}
			
			$("#profile-product-container").html(prod_html);

			
	                    
	                    
	                    
	                   /*
 <!--
<div class='col-xs-12'>
	                        <button type='button' class='product-button'>PROMOTE</button>
	                        <button type='button' class='product-button'>EDIT</button>
	                    </div>
-->
*/

			
		}
		else
		{
			
		}
	});
}

$(document).ready(function(){
	profileGetDetails();
});