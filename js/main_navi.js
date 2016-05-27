var baseURL = "/_staging2/";
var apiURL = "/_staging2/api/";



$(".main-navi-logout-btn").click(function(){
	var url = apiURL + "member_login.php";
	var inputObj = {
		"action":"memberLogout"
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Logout success'))
		{	
			location.reload();
		}
		else
		{
// 			alert("Logout Fail");
		}
	});
});