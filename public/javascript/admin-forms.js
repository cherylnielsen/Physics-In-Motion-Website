/* JavaScript for member user forms. */

/*
function testing(value)
{
	//alert("Hello" + value);
	//var cellID = "demo";
	//var cellName = "testing";
	//document.getElementById(cellID).innerHTML = "hello again  " + value;
	//document.getElementsByName(cellName)[0].innerHTML = "hello again  " + value;
	//document.getElementsByName('testing')[0].innerHTML = "hello again  " + value;
}
*/

/* AJAX to populate a form for editing sections 

	AJAX with POST
	set dataString as the data to be sent in string format
	set url as the file to process the request on the server
	set request type as POST
	set request header as www form data
	send the request and the POST data
	This ONLY works in the exact order of: 
	new xhttp request, onready function, open, set header, send.
*/	

function fillForm(form_type)
{
	var xhttp = new XMLHttpRequest();
	var dataString;
	var url;
	
	// anonymous function to handle the http response	
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			var strArray = this.responseText.split(/&|=/);
			
			if(form_type == "section")
			{
				document.getElementById('section_name').value = strArray[1];
				document.getElementById('professor_id').value = strArray[3];
				document.getElementById('start_date').value = strArray[5];
				document.getElementById('end_date').value = strArray[7];
				document.getElementById('description').value = strArray[9];	
			}
			
			if(form_type == "tutorial_lab")
			{
				document.getElementById('tutorial_lab_name').value = strArray[1];
				document.getElementById('web_link').value = strArray[3];
				document.getElementById('lab_status').value = strArray[5];
				document.getElementById('introduction').value = strArray[7];
				document.getElementById('prerequisites').value = strArray[9];
				document.getElementById('key_topics').value = strArray[11];
				document.getElementById('key_equations').value = strArray[13];
				document.getElementById('description').value = strArray[15];
				document.getElementById('instructions').value = strArray[17];		
			}
			
		}
	};
	
	
	if(form_type == "section")
	{
		var section_id = document.getElementById('section_id').value;
		dataString = "get_section=" + section_id;
		var url = "javascript/ajaxSection.php";
	}	
	else if(form_type == "tutorial_lab")
	{
		var lab_id = document.getElementById('tutorial_lab_id').value;
		dataString = "get_tutorial_lab=" + lab_id;
		var url = "javascript/ajaxTutorialLab.php";
	}	
	
	
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(dataString);
}

