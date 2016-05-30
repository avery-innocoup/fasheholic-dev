var baseURL = "/_fasheholic/";
var apiURL = "/_fasheholic/api/";



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