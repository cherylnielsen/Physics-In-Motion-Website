/* JavaScript for member pages. */

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


// AJAX with POST
function submitHomework(homework_id)
{
	// the table cell that requested action
	var cellID = "submit_" + homework_id;
	// the http request object
	var xhttp = new XMLHttpRequest();
	
	// anonymous function to handle the http response
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById(cellID).innerHTML = this.responseText;
		}
	};
	
	/**
	// using GET - this works
	var dataString = "submit_homework=" + homework_id;
	var url = "javascript/ActionUtility.php?" + dataString;
	xhttp.open("GET", url, true);
	xhttp.send();
	**/
	
	/**
		set dataString as the data to be sent in string format
		set url as the file to process the request on the server
		set request type as POST
		set request header as www form data
		send the request and the POST data
	**/
		
	var dataString = "submit_homework=" + homework_id;
	var url = "javascript/ActionUtility.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(dataString);

}





