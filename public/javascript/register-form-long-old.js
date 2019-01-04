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


function isPasswordUsername(data)
{
	var ok = true;
	// minimum length is at least 8 characters
	var minlength = 8;
	
	data = data.trim();
	
	// cannot contain white space
	var pattern = /\s/;
	ok = !(pattern.test(data));
	
	if(ok)
	{
		// must have at least minlength characters
		ok = (data.length >= minlength);
	}
	
	if(ok)
	{
		// must have at least one numerical digit
		pattern = /[0-9]/;
		ok = pattern.test(data);
	}
	
	if(ok)
	{
		// must have at least one letter
		var pattern = /[a-zA-Z]/;
		ok = pattern.test(data);
	}
	
	return ok;
}


function isEmail(data)
{
	var ok = true;
	data = data.trim();
	
	//\S+ matches any 1 or more non-whitespace
	// Email has an @ and at least one period, in that order.
	var pattern = /\S+@\S+\.\S+/;
	ok = pattern.test(data);
	
	if(ok)
	{
		// cannot contain white space
		pattern = /\s/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot start with a period
		pattern = /^\./;
		ok = !(pattern.test(data));
	}
		
	if(ok)
	{
		// cannot end with a period
		pattern = /\.$/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have repeating periods
		pattern = /\.\.+/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have period right before the @ sign
		pattern = /\.@/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have period right after the @ sign
		pattern = /@\./;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have more than one @
		pattern = /\@\S*@+/;
		ok = !(pattern.test(data));
	}
	
	return ok;
	
}


function isName(data)
{
	var ok = true;
	
	data = data.trim();
	
	// Names can only contain alphnumeric and _-.' or space.
	var pattern = /[a-zA-Z0-9 _\-\'\.]+/;
	ok = !(pattern.test(data));
	
	return ok;
}



function validate()
{
	clearOldErrors();
	var errors = "";	
	
	var theform = document.forms;
	var list = theform.getElementsByTagName("input");
	
	var name, name2, value, i;
	
	var email1 = "", email2 = "";
	var email1_index = -1, email2_index = -1;
	var password1 = "", password2 = "";
	var password1_index = -1, password2_index = -1;
	var username1 = "", username2 = "";
	var username1_index = -1, username2_index = -1;
	
	for (i = 0; i < list.length; i++)
	{	
		name = list.elements[i].getAttribute("name");
		name_replaced = name.replace("_", " ");
		value = list.elements[i].value;
		value = value.trim();
		
		if(value.length < 1)
		{
			errors += "Please enter " + name_replaced + ". <br>"; 
			list.elements[i].classList.add("invalid");
		}
		else
		{
			switch(name)
			{
				case "first_name":
				case "last_name":
				case "school":
					if(!isName(value))
					{ 
						errors += "Invalid name_replaced, please check spelling. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					break;
					
				case "email":
					if(!isEmail(value)) 
					{ 
						errors += "Invalid name_replaced address, please check spelling. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						email1 = value;
						email1_index = i;
					}
					break;
				case "email_confirm":
					if(!isEmail(value)) 
					{ 
						errors += "Invalid name_replaced address, please check spelling. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						email2 = value;
						email2_index = i;
					}
					break;
					
				case "username":
					if(!isPasswordUsername(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						username1 = value;
						username1_index = i;
					}
					break;
				case "username_confirm":
					if(!isPasswordUsername(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						username2 = value;
						username2_index = i;
					}
					break;
				case "password":
					if(!isPasswordUsername(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						password1 = value;
						password1_index = i;
					}
					break;
				case "password_confirm":
					if(!isPasswordUsername(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						password2 = value;
						password2_index = i;
					}
					break;
			}
		}
		
	} // end for loop
	
	if((email1_index > -1) && (email2_index > -1))
	{
		if(email1.localeCompare(email2) === 0)
		{
			errors += "Emails do not match.";
			list.elements[email1_index].classList.add("invalid");
			list.elements[email2_index].classList.add("invalid");
		}
	}
	
	if((username1_index > -1) && (username2_index > -1))
	{
		if(username1.localeCompare(username2) === 0)
		{
			errors += "User Names do not match.";
			list.elements[username1_index].classList.add("invalid");
			list.elements[username2_index].classList.add("invalid");
		}
	}
	
	if((password1_index > -1) && (password2_index > -1))
	{
		if(password1.localeCompare(password2) === 0)
		{
			errors += "Passwords do not match.";
			list.elements[password1_index].classList.add("invalid");
			list.elements[password2_index].classList.add("invalid");
		}
	}
	
	// if errors were found
	if(errors.length > 2)
	{
		document.getElementById("login_errors").innerHTML = "Errors: <br>" + errors;
	}
	
	return ok;
}


function init()
{
	var theform = document.forms;	
	theform.onsubmit = validate;
}


document.addEventListener( "DOMContentLoaded" , init , false ) ;


