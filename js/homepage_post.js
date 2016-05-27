var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";





function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


function loadPostHtml(product_dir, product_image_name, member_logo_image_name, logo_dir, member_logo_image_name, shop_name, shop_country, product_name, product_desc, product_myr_price, product_usd_price) {
	var prod_html = "";
	
	prod_html = "<div class='col-xs-12 pos-template no-padding'>";
	prod_html += "<div class='col-sm-7 col-xs-12 product-image-area '>";
    prod_html += "<img src='" + product_dir + product_image_name + "' />";
    prod_html += "</div>";
    prod_html += "<div class='col-sm-5 col-xs-12 product-details no-padding'>";
    prod_html += "<div class='col-xs-12 product-details-each'>";
    prod_html += "<div class='col-sm-4 col-xs-12 no-padding'>";
    prod_html += "<div class='col-xs-12 no-padding shop-logo'>";
    if (member_logo_image_name) {
    	prod_html += "<img src='" + logo_dir + member_logo_image_name + "' class='homepage-post-shop-logo' />";
    } else {
	    prod_html += "SHOP LOGO";
    }
    prod_html += "</div>";
    prod_html += "</div>";
    prod_html += "<div class='col-sm-4 col-xs-12 shop-name'>";
	prod_html += shop_name;
	prod_html += "</div>";
	prod_html += "<div class='col-sm-4 col-xs-12 my'>";
	prod_html += shop_country;
	prod_html += "</div>";
	prod_html += "</div>";
	prod_html += "<div class='col-xs-12 product-details-each'>";
	prod_html += product_name;
	prod_html += "</div>";
	prod_html += "<div class='col-xs-12 product-details-each' style='height: 200px;padding-top:90px'>";
	prod_html += product_desc;
	prod_html += "</div>";
	prod_html += "<div class='col-xs-12 product-details-each'>SHIPPING</div>";
	prod_html += "<div class='col-xs-12 product-details-each' style='border-bottom: none'>";
	prod_html += "<div class='col-xs-5 price-container no-padding pull-left'>";
	prod_html += "<div class='col-xs-12 local-price-header'>Local Price</div>";
	prod_html += "<div class='col-xs-12 local-price-body'>MYR ";
	prod_html += product_myr_price;
	prod_html += "</div>";
	prod_html += "</div>";
	prod_html += "<div class='col-xs-5 price-container no-padding pull-right'><div class='col-xs-12 int-price-header'>International Price</div>";
	prod_html += "<div class='col-xs-12 int-price-body'>USD ";
	prod_html += product_usd_price;
	prod_html += "</div></div></div></div></div>";
	
	return prod_html;
}

function loadAllPost() {
	var url = apiURL + "product.php";
	var inputObj = {
		"action":"productGetAll"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Product Get All success'))
		{	
			var total_product = output.data[0].total_product;
			var product_dir = output.data[0].product_dir;
			var logo_dir = output.data[0].logo_dir;
			var i;
			var prod_html = "";
			
			var product_name = "";
			var product_desc = "";
			var product_myr_price = "";
			var product_usd_price = "";
			var product_image_name = "";
			var shop_id = "";
			var shop_name = "";
			var shop_country = "";
			
			for (i=0; i<total_product; ++i) {
				product_name = output.data[0].product_obj[i].product_name;
				product_desc = output.data[0].product_obj[i].product_desc;
				product_myr_price = output.data[0].product_obj[i].product_myr_price;
				product_usd_price = output.data[0].product_obj[i].product_usd_price;
				product_image_name = output.data[0].product_obj[i].product_image_name;
				shop_id = output.data[0].product_obj[i].shop_id;
				shop_name = output.data[0].product_obj[i].shop_name;
				shop_country = output.data[0].product_obj[i].shop_country;
				member_logo_image_name = output.data[0].product_obj[i].member_logo_image_name;
			    
				prod_html += loadPostHtml(product_dir, product_image_name, member_logo_image_name, logo_dir, member_logo_image_name, shop_name, shop_country, product_name, product_desc, product_myr_price, product_usd_price);
			}
			
			$("#fash-product-post").html(prod_html);
		}
		else
		{
			alert("Product Get All Fail");
		}
	});
}

function loadQueryPost(url_query) {
	var url = apiURL + "product.php";
	var inputObj = {
		"action":"productGetQuery",
		"q":url_query
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		if((output.status == "true") && (output.message == 'Product Get Query success'))
		{	
			var total_product = output.data[0].total_product;
			var product_dir = output.data[0].product_dir;
			var logo_dir = output.data[0].logo_dir;
			var i;
			var prod_html = "";
			
			var product_name = "";
			var product_desc = "";
			var product_myr_price = "";
			var product_usd_price = "";
			var product_image_name = "";
			var shop_id = "";
			var shop_name = "";
			var shop_country = "";
			
			for (i=0; i<total_product; ++i) {
				product_name = output.data[0].product_obj[i].product_name;
				product_desc = output.data[0].product_obj[i].product_desc;
				product_myr_price = output.data[0].product_obj[i].product_myr_price;
				product_usd_price = output.data[0].product_obj[i].product_usd_price;
				product_image_name = output.data[0].product_obj[i].product_image_name;
				shop_id = output.data[0].product_obj[i].shop_id;
				shop_name = output.data[0].product_obj[i].shop_name;
				shop_country = output.data[0].product_obj[i].shop_country;
				member_logo_image_name = output.data[0].product_obj[i].member_logo_image_name;
			    
				prod_html += loadPostHtml(product_dir, product_image_name, member_logo_image_name, logo_dir, member_logo_image_name, shop_name, shop_country, product_name, product_desc, product_myr_price, product_usd_price);
			}
			
			$("#fash-product-post").html(prod_html);
		}
		else
		{
			alert("No such product");
			loadAllPost();
		}
	});
}


function checkShop() {
	var url = apiURL + "functions/check_shop/checkShop.php";
	var inputObj = "";
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Check Shop true'))
		{	
			$("#check_shop").load("_includeHomePageAddProduct.php");
			
		}
		else
		{
			$("#check_shop").load("_includeHomePageAddShop.php");

		}
	});
	
	
	var url_query = getUrlParameter('q');
	var url_category = getUrlParameter('category');
	
	
	if (url_query) {
		loadQueryPost(url_query);
		
	} else if (url_category) {
		loadCategoryPost(url_category);
		
	} else {
		loadAllPost();
	}
}


$(document).ready(function(){
	checkShop();
});
