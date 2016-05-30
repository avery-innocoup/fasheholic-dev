var baseURL = "/_fasheholic/";
var apiURL = "/_fasheholic/api/";


var pageHeight = jQuery( window ).height();
jQuery(".fash-landing-page").css({'height':pageHeight});

// Detect for page height changes
function onElementHeightChange(elm, callback){
    var lastHeight = elm.clientHeight, newHeight;
    (function run(){
        newHeight = elm.clientHeight;
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}


onElementHeightChange(document.body, function(){
    var pageHeight = jQuery( window ).height();
	jQuery(".fash-landing-page").css({'height':pageHeight});
});



// Login form
$(".login-username").keyup(function(event){
    if(event.keyCode == 13){
        $(".login-submit").click();
    }
});
$(".login-password").keyup(function(event){
    if(event.keyCode == 13){
        $(".login-submit").click();
    }
});


$(".switch-signup-btn").click(function(){
	$(".login-input-container").hide();
	$(".register-input-container").show();
});


$(".login-submit").click(function(){
//     console.log("log in");
	var login_username = $('.login-username').val();
	var login_password = $('.login-password').val();
	
	var url = apiURL + "member_login.php";
	var inputObj = {
		"action":"memberLogin",
		"username":login_username,
		"password":login_password
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Login success'))
		{	
			location.reload();
		}
		else
		{
			alert("Login Fail");
		}
	});
});



// Register form
$(".register-email").keyup(function(event){
    if(event.keyCode == 13){
        $(".register-submit").click();
    }
});
$(".register-fullname").keyup(function(event){
    if(event.keyCode == 13){
        $(".register-submit").click();
    }
});
$(".register-username").keyup(function(event){
    if(event.keyCode == 13){
        $(".register-submit").click();
    }
});
$(".register-password").keyup(function(event){
    if(event.keyCode == 13){
        $(".register-submit").click();
    }
});


$(".switch-login-btn").click(function(){
	$(".register-input-container").hide();
	$(".login-input-container").show();
});


$(".register-submit").click(function(){
//     console.log("register");
	var register_email = $('.register-email').val();
	var register_fullname = $('.register-fullname').val();
	var register_username = $('.register-username').val();
	var register_password = $('.register-password').val();
	
	var url = apiURL + "member_register.php";
	var inputObj = {
		"action":"memberRegister",
		"email":register_email,
		"name":register_fullname,
		"username":register_username,
		"password":register_password
	};
	
	$.post(url, inputObj, function(data)
	{
		var output = $.parseJSON(data);
		
		if((output.status == "true") && (output.message == 'Register success'))
		{	
			alert("Register Success");
		}
		else
		{
			if(output.message == 'Register duplicate') {
				alert(output.data[0].duplicate_msg);
			} else {
				alert(output.message);
			}
		}
	});
});