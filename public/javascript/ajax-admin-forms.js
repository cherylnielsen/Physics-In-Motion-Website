/* JavaScript for member user forms. */

/**
function showHideNav(navID)
{
	// get the div containing the table
	var navigationDiv = document.getElementById(navID);
	
	// toggle the div table display on or off
	if( navigationDiv.style.display == "none" )
	{
		navigationDiv.style.display = "block";
	}
	else
	{
		navigationDiv.style.display = "none";
	}
}
**/

/* AJAX to populate a form for editing sections */
/**
	AJAX with POST
	set dataString as the data to be sent in string format
	set url as the file to process the request on the server
	set request type as POST
	set request header as www form data
	send the request and the POST data
	This ONLY works in the exact order of: 
	new xhttp request, onready function, open, set header, send.
**/	
/**
function populateForm(object_type)
{
	var xhttp = new XMLHttpRequest();
	var dataString;
	
	// anonymous function to handle the http response
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			if(this.responseText != -1)
			{
				var response = this.responseText;
				var strArray = response.splitsplit(/&|=/);
				var key, theValue;
				for(var i = 0; i < strArray.length; i++)
				{
					key = strArray[i];
					i++;
					theValue = strArray[i];
					
					document.getElementsByName(key).value = theValue;
					
				}
				
			}
		}
	};
	
	if(object_type == "section")
	{
		var section_id = document.getElementById(section_id).value;
		dataString = "get_section=" + section_id;
	}	
	else if(object_type == "tutorial_lab")
	{
		var lab_id = document.getElementById(section_id).value;
		dataString = "get_lab=" + lab_id;
	}	
	
	var url = "javascript/ajaxSection.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(dataString);
}
**/