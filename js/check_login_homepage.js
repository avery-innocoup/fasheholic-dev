var baseURL = "/_fasheholic/";
var apiURL = "/_fasheholic/api/";

function checkLogin() {
	var url = apiURL + "functions/check_login/checkLogin.php";
	var inputObj = "";
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Check Login true'))
		{	
			$("#checkLogin").load("_includeMainNavi.php");
			$("#homepage_product").load("_includeHomePagePost.php");
		}
		else
		{
// 			window.location.replace('/_fasheholic');
			$("#checkLogin").load("_includeLoginPanel.php");
		}
	});
}

$(document).ready(function(){
	checkLogin();
});
	
	



