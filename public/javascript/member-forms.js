/* JavaScript for write notice form. */


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
			fileListStr += "<li>" + file.name + "</li>";
			//fileListStr += file.name + "<br>";
		}
		fileListStr += "</ul>";
	}
 
	document.getElementById("fileListing").innerHTML = fileListStr;
}


function clearText()
{
	document.getElementById("fileListing").innerHTML = "";
}

