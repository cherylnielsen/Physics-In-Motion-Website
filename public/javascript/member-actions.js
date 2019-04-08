/* JavaScript for member pages. */

function showSelectedNotice(rowID)
{
	var row = document.getElementById(rowID);
	
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
	var table = document.getElementById(tableID);
	
	if( table.style.display == "none" )
	{
		table.style.display = "block";
		table.scrollIntoView({behavior: "smooth"});
	}
	else
	{
		table.style.display = "none";
	}
}


// AJAX with POST
function submitHomework(homework_id)
{
	// the http request object
	var xhttp = new XMLHttpRequest();
	
	// anonymous function to handle the http response
	// because the response is not complicated for homework
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			var id = "submit_homework_" + homework_id;
			document.getElementById(id).innerHTML = xhttp.responseText;
		}
	};
	
	// the data to be sent in string format
	var dataString = "submit_homework=" + homework_id;
	// sending request by post to the file "" on the server
	xhttp.open("POST", "javascript/ActionUtility.php", true);
	// set header as www (Internet) form data type
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// send the data string
	xhttp.send(dataString);
	
}



