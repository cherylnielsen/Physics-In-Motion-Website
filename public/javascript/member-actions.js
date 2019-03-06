/* JavaScript for member pages. */


function showStudentList($section_id)
{
	var listDiv = document.getElementById("studentListDiv");
	
	if( listDiv.style.display === "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}

function showAssignmentList($section_id)
{
	var listDiv = document.getElementById("assignmentListDiv");
	
	if( listDiv.style.display === "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function addSectionAssignment($section_id)
{
	var listDiv = document.getElementById("assignmentListDiv");
	
	if( listDiv.style.display === "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showSectionNotices($section_id)
{
	var listDiv = document.getElementById("studentListDiv");
	
	if( listDiv.style.display === "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function addSectionNotice($section_id)
{
	var listDiv = document.getElementById("studentListDiv");
	
	if( listDiv.style.display === "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


/**

function init()
{
	
}

document.addEventListener( "DOMContentLoaded" , init , false );

**/
