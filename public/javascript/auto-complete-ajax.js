/* JavaScript for member pages. */

/* auto complete for section and member lists in forms */
/* using AJAX */

function autoComplete(word, textID) 
{
	if (word.length == 0) 
	{ 
		document.getElementById(textID).innerHTML = "";
		return;
	} 
  
	var httpRequest = new XMLHttpRequest();
	var url = "javascript/Utility.php";
	var dataString = "word=" + word + "&textID=" + textID;
	
	httpRequest.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById(textID).innerHTML = this.responseText;
		}
	};
	
	//httpRequest.open("GET", "AutoComplete.php?word=" + word, true);
	//httpRequest.send();
	var url = "javascript/AutoComplete.php";
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(word);
  
}

