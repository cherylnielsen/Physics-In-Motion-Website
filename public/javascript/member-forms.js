/* JavaScript for member user forms. */

/*  to be done later add filter for file types? and file sizes?*/

/* Displays the names of files to be uploaded. */
function showFileNames()
{
	var attachments = document.getElementById("attachments");
	var numfiles = document.getElementById("numfiles");
	var fileListStr = "";
	var file;

	if (attachments.files.length == 0) 
	{
	  fileListStr = "Select one or more files.";
	} 
	else if (attachments.files.length >= 2)
	{
		fileListStr += "<ul>";
		for (var i = 0; i < attachments.files.length; i++) 
		{
			file = attachments.files[i];
			fileListStr += "<li>" + file.name + "  (" + file.size +" bytes)</li>";
			
		}
		fileListStr += "</ul>";
	}
 
	document.getElementById("fileListing").innerHTML = fileListStr;
}


/* Clears the display of the names of files to be uploaded. */
function clearText()
{
	document.getElementById("fileListing").innerHTML = "";
}


/* JavaScript for implementing a 5 star rating system by on click, 
on mouse over, and on mouse out, where start = int values 1,2,3,4,5. */

var starColor = [];

function ratingClicked(star)
{
	for(var i = 1; i <= star; i++)
	{
		var id = 'star-' + i;
		document.getElementById(id).style.color = "gold";
		starColor[i] = "gold";
	}
	
	for(var i = 5; i > star; i--)
	{
		var id = 'star-' + i;
		document.getElementById(id).style.color = "gray";
		starColor[i] = "gray";
	}
}

function ratingOnMouseOver(star)
{
	for(var i = 1; i <= 5; i++)
	{
		var id = 'star-' + i;
		starColor[i] = document.getElementById(id).style.color;
	}
	
	for(var i = 1; i <= star; i++)
	{
		var id = 'star-' + i;
		document.getElementById(id).style.color = "gold";
	}
	
	for(var i = 5; i > star; i--)
	{
		var id = 'star-' + i;
		document.getElementById(id).style.color = "gray";
	}
}

function ratingOnMouseOut(star)
{
	for(var i = 1; i <= 5; i++)
	{
		var id = 'star-' + i;
		document.getElementById(id).style.color = starColor[i];
	}
}


