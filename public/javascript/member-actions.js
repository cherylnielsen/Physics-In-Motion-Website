/* JavaScript for member pages. */

// for use with the AJAX function below
const actions = {
    SUBMIT_HOMEWORK: 1,
    GRADE_HOMEWORK: 2,
    CHANGE_GRADE: 3,
    DELETE_ASSIGNMENT: 4
}


function showSelectedNotice(rowID)
{
	// get the row where the notice is to be show
	var row = document.getElementById(rowID);
	
	// toggle the row display on or off
	if( row.style.display == "none" )
	{
		row.style.display = "table-row";
		row.scrollIntoView({behavior: "smooth"});
	}
	else
	{
		row.style.display = "none";
	}
}
		
		
function showTable(tableID)
{
	// get the div containing the table
	var tableDiv = document.getElementById(tableID);
	
	// toggle the div table display on or off
	if( tableDiv.style.display == "none" )
	{
		tableDiv.style.display = "block";
		tableDiv.scrollIntoView({behavior: "smooth"});
	}
	else
	{
		tableDiv.style.display = "none";
	}
}


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
function homeworkActions(item_id, action)
{
	var xhttp = new XMLHttpRequest();
	
	// anonymous function to handle the http response
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			if(this.responseText != -1)
			{
				switch(action)
				{
					case actions.SUBMIT_HOMEWORK:
						var cellID = "submit_" + item_id;
						document.getElementById(cellID).innerHTML = this.responseText;
					break;
					
					case actions.DELETE_ASSIGNMENT:
						var rowID = "assignment_" + item_id;
						document.getElementById(rowID).style.display = "none";
					break;
				}
			}
		}
	};
	
	var dataString;
	
	switch(action)
	{
		case actions.SUBMIT_HOMEWORK:
			dataString = "submit_homework=" + item_id;
		break;
		
		case actions.DELETE_ASSIGNMENT:
			var dataString = "delete_assignment=" + item_id;
		break;
	}
	
	var url = "javascript/ajaxHomework.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(dataString);
}


