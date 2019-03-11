/* JavaScript for write notice form. */

// the file input for attachments for the form
var input = document.getElementById('attachments');
// the div where the filenames will be shown
var infoArea = document.getElementById('file_attachments');

// event listener attached to the file input 
input.addEventListener('change', showFileName );

function showFileName( event ) 
{
	var input = event.srcElement;	
	var fileName = input.files[0].name; 
	// shows like a tool tip with mouse hover, not as text on the screen
	infoArea.textContent = '<p>File name: ' + fileName + '</p>';
}

