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


function isPasswordPattern(data)
{
	var ok = true;
	data = data.trim();
	
	// minimum length is at least 8 characters
	// cannot contain white space
	
	var pattern = /\s/;
	ok = !(pattern.test(data));

	if(ok)
	{
		// It must have at least: one numerical digit, one lowercase letter,
		// one uppercase letter, and one non-alphanumeric character.		
		var pattern = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W]).{8,}/;
		ok = pattern.test(data);
	}
	
	return ok;
}


function isEmailPattern(data)
{
	var ok = true;
	data = data.trim();
	
	// cannot contain white space
	pattern = /\s/;
	ok = !(pattern.test(data));
	
	if(ok)
	{
		// \S+ matches any 1 or more non-whitespaces
		// Email has at least one @ and at least one period, in that order.
		var pattern = /^\S+@\S+\.\S+$/;
		ok = pattern.test(data);		
	}
	
	if(ok)
	{
		// cannot start with a period or @
		pattern = /^[\.@]/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot end with a period or @
		pattern = /[\.@]$/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have consecutively repeating periods anywhere
		pattern = /\.\.+/;
		ok = !(pattern.test(data));
	}
	
	if(ok)
	{
		// cannot have a second @ anywhere in the string
		pattern = /@\S*@+/;
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
	
	
	
	return ok;
	
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



function compairMatches(errors, list, data_array, data_type)
{
	var ok = true;
	
	if(data_array.length === 4)
	{
		if(data_array[0].localeCompare(data_array[2]) === 0)
		{
			errors += data_type + " do not match.";
			ok = false;
			
			if(!list.elements[data_array[1]].classList.contains("invalid") )
			{
				list.elements[data_array[1]].classList.add("invalid");
			}
			
			if (!list.elements[data_array[3]].classList.contains("invalid") )
			{
				list.elements[data_array[3]].classList.add("invalid");
			}
		}
	}
	else
	{
		ok = false;
	}
	
	return ok;
	
}


function validate()
{
	clearOldErrors();
	var errors = "";	
	
	var theform = document.forms;
	var list = theform.getElementsByTagName("input");
	
	var name, name_replaced, value, i;
	var emails = [], passwords = [], usernames = [];
	
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
					if(!isNamePattern(value))
					{ 
						errors += "Invalid name_replaced, please check spelling. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					break;
					
				case "email":
				case "email_confirm":
					if(!isEmailPattern(value)) 
					{ 
						errors += "Invalid name_replaced address, please check spelling. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						emails.push(value);
						email_index.push(i);
					}
					break;
					
				case "username":
				case "username_confirm":
					if(!isPasswordPattern(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						usernames.push(value);
						username_index.push(i);
					}
					break;
					
				case "password":
				case "password_confirm":
					if(!isPasswordPattern(value)) 
					{ 
						errors += "Invalid name_replaced address, please check list of requirements. <br>"; 
						list.elements[i].classList.add("invalid");
					}
					else
					{
						passwords.push(value);
						password_index.push(i);
					}
					break;
					
			}
		}
		
	} // end for loop
	
	var ok = compairMatches(errors, list, emails, "Emails");
	var ok1 = compairMatches(errors, list, passwords, "Passwords");
	var ok2 = compairMatches(errors, list, usernames, "User Names");
	
	if(ok1 && ok2)
	{
		if(usernames[0].localeCompare(passwords[0]) === 0)
		{
			errors += "Password cannot match User Name.";
			if(!list.elements[passwords[1]].classList.contains("invalid") )
			{
				list.elements[passwords[1]].classList.add("invalid");
			}
			
			if (!list.elements[passwords[3]].classList.contains("invalid") )
			{
				list.elements[passwords[3]].classList.add("invalid");
			}
		}
	}
	
	
	// if errors were found
	if(errors.length > 0)
	{
		document.getElementById("login_errors").innerHTML = "Errors: <br>" + errors;
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


