var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";

function checkLogin() {
	var url = apiURL + "functions/check_login/checkLogin.php";
	var inputObj = "";
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Check Login true'))
		{	
			/*
$("#checkLogin").load("_includeMainNavi.php");
			$("#homepage_product").load("_includeHomePagePost.php");
*/
		}
		else
		{
			window.location.replace('/_staging2');
		}
	});
}

$(document).ready(function(){
	checkLogin();
});
	
	



