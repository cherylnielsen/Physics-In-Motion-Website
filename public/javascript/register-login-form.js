/* javascript for register form */


function clearOldErrors()
{
	document.getElementById("login_errors").innerHTML = "";
	document.getElementById("action_errors").innerHTML = "";
	var theform = document.forms;
	var list = theform.getElementsByTagName("input");
	var i;
	
	for (i = 0; i < list.length; i++)
	{	
		if (list.elements[i].classList.contains("invalid") )
		{
			list.elements[i].classList.remove("invalid");
		}
	}
}


function isNamePattern(data)
{
	var ok = true;
	
	data = data.trim();
	
	// Names can only contain alphnumeric or -.' or space.
	var pattern = /^[a-zA-Z0-9 \-\'\.]+$/;
	ok = !(pattern.test(data));
	
	return ok;
}


function isPasswordPattern(data)
{
	var ok = true;
	data = data.trim();
	
	// cannot contain white space	
	var pattern = /\s/;
	ok = !(pattern.test(data));

	if(ok)
	{
		// It must have at least: one numerical digit, one lowercase letter,
		// one uppercase letter, and at least 8 characters in length.		
		var pattern = /(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S{8,}/;
		ok = pattern.test(data);
	}
	
	return ok;
}


function isEmailPattern(data)
{
	var ok = true;
	
	/****
		patterns are regular expressions	
		Email cannot contain white space
		Email cannot start with a period or @
		Email cannot end with a period or @
		Email cannot have consecutively repeating periods anywhere
		Email cannot have a second @ anywhere in the string
		Email cannot have period right before the @ sign
		Email cannot have period right after the @ sign
	****/
	var neg_patterns = [ /\s/, /^[\.@]/, /[\.@]$/, /\.\.+/, /@\S*@+/, /\.@/, /@\./ ]
	
	/***
		\S+ matches any 1 or more non-whitespaces
		Email has at least one @ and at least one period, in that order.
	**/
	var pos_pattern = /^\S+@\S+\.\S+$/;
	
	data = data.trim();
	ok = pos_pattern.test(data);
	
	if(ok)
	{
		var i;
		for (i = 0; i < neg_patterns.length; i++)
		{
			neg_patterns[i].test(data);
			ok = neg_patterns.test(data);
			if(!ok) { return false; }
		}
	}
	
	return ok;
}


function validateMatches(theform, errors)
{
	var email = theform.getElementsByName("email");
	var email_confirm = theform.getElementsByName("email_confirm");
	var name = theform.getElementsByName("email");
	var name_confirm = theform.getElementsByName("email_confirm");
	var pw = theform.getElementsByName("email");
	var pw_confirm = theform.getElementsByName("email_confirm");
	
	
	if(email.localeCompare(email_confirm) !== 0)
	{
		email.classList.add("invalid");
		email_confirm.classList.add("invalid");
		errors.push("Emails do not match.");
	}
	
	if(name.localeCompare(name_confirm) !== 0)
	{
		name.classList.add("invalid");
		name_confirm.classList.add("invalid");
		errors.push("User Names do not match.");
	}
	
	if(pw.localeCompare(pw_confirm) !== 0)
	{
		pw.classList.add("invalid");
		pw_confirm.classList.add("invalid");
		errors.push("Passwords do not match.");
	}
	
}


function validateRegistration(theform, errors)
{
	var list = theform.getElementsByTagName("input");
	var name, name_replaced, value, i;
	
	var email = "";
	var email2 = "";
	var pw = "";
	var pw2 = "";
	var uname = "";
	var uname2 = "";
	
	for (i = 0; i < list.length; i++)
	{	
		name = list.elements[i].getAttribute("name");
		name_replaced = name.replace("_", " ");
		value = list.elements[i].value;
		value = value.trim();
		
		if(value.length < 1)
		{
			errors.push("Please enter " + name_replaced + "."); 
			list.elements[i].classList.add("invalid");
		}
		else
		{
			switch(name)
			{
				case "first_name":
				case "last_name":
				case "school":
				
					if(!isNamePattern(value))
					{ 
						errors.push("Invalid name_replaced, please check spelling."); 
						list.elements[i].classList.add("invalid");
					}					
					break;
					
				case "email":
				case "email_confirm":
					
					if(!isEmailPattern(value)) 
					{ 
						errors.push("Invalid name_replaced, please check spelling."); 
						list.elements[i].classList.add("invalid");
					}
					break;
					
				case "username":
				case "username_confirm":
					
					if(!isPasswordPattern(value)) 
					{ 
						errors.push("Invalid name_replaced, please check list of requirements."); 
						list.elements[i].classList.add("invalid");
					}					
					break;
					
				case "password":
				case "password_confirm":
					
					if(!isPasswordPattern(value)) 
					{ 
						errors.push("Invalid name_replaced, please check list of requirements."); 
						list.elements[i].classList.add("invalid");
					}
					break;
			}
		}		
	} // end for loop
	
}


function validateLogin(theform, errors)
{
	var pw1 = theform.getElementsByName("username");
	var name1 = theform.getElementsByName("password");
	
	if(!isPasswordPattern(username))
	{
		pw1.classList.add("invalid");
		errors.push("Invalid password format.");
	}
	
	if(!isPasswordPattern(username))
	{
		name1.classList.add("invalid");
		errors.push("Invalid password format.");
	}
	
}


function validate()
{
	clearOldErrors();
	
	var errors = [];	
	var theform = document.forms;
	var formtype = theform.getAttribute("id");
	
	if(id.localeCompare("loginform") === 0)
	{
		validateRegistration(theform, errors);
		validateMatches(theform, errors);
	}
	else
	{
		validateLogin(theform, errors);
	}
	
	// if errors were found
	if(errors.length > 0)
	{
		var i;
		var str = "";
		
		for(i = 0; i < errors.length; i++)
		{
			str += errors[i] + " <br>"
		}
		
		document.getElementById("form_errors").innerHTML = "Errors: JAVASCRIPT <br>" + str;
		
		return false;
	}
	
	return true;
}


function init()
{
	var theform = document.forms;	
	theform.onsubmit = validate;
}


document.addEventListener( "DOMContentLoaded" , init , false ) ;


