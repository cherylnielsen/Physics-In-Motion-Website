/* javascript for login form */


function validate()
{
	var ok = true;
	var name = document.getElementById("username").value;
	var pw = document.getElementById("password").value;
	var error_message = document.getElementById("login_errors");
	var action_message = document.getElementById("action_errors");	
	var errors = "";
	
	error_message.innerHTML = "";
	action_message.innerHTML = "";
		
	name = name.trim();
	pw = pw.trim();
	
	
	if ((name.length < 1) || (pw.length < 1))
	{
		ok = false;
		errors += "Enter user name and password.<br>";
		document.getElementById("username").
	}	
	
	if(!ok)
	{
		error_message.innerHTML = "Error: " + errors;
	}
	
	return ok;
}

function init()
{
	var theform = document.getElementById("registerform");	
	
	theform.onsubmit = validate;	
}

document.addEventListener( "DOMContentLoaded" , init , false ) ;


