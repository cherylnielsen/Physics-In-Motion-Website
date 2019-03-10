/* JavaScript for member pages. */


function showStudentList()
{
	var listDiv = document.getElementById("studentListDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showAssignmentList()
{
	var listDiv = document.getElementById("assignmentListDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showHomeworkList()
{
	var listDiv = document.getElementById("homeworkListDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showSectionNotices()
{
	var listDiv = document.getElementById("sectionNoticeDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showMemberInBoxNotices()
{
	var listDiv = document.getElementById("memberInBoxNoticeDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}

function showMemberSentNotices()
{
	var listDiv = document.getElementById("memberSentNoticeDiv");
	
	if( listDiv.style.display == "none" )
	{
		listDiv.style.display = "block";
	}
	else
	{
		listDiv.style.display = "none";
	}
}


function showSelectedNotice(notice_id)
{
	var ID = "notice" + notice_id;
	var showDiv = document.getElementById(ID);
	
	if( showDiv.style.display == "none" )
	{
		showDiv.style.display = "block";
	}
	else
	{
		showDiv.style.display = "none";
	}
}


function addAssignment()
{
	
}


function gradeAssignment()
{
	
}


function writeNotice()
{
	
}






