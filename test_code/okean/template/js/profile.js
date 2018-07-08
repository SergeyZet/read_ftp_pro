function showblock(page) /*Упражнения*/
{
	document.getElementById("startpage").style.display = "none";
	document.getElementById("stats").style.display = "none";
	document.getElementById("study").style.display = "none";
	document.getElementById("classes").style.display = "none";
	document.getElementById("personal").style.display = "none";
	if(page == 'stats')
	{
		document.getElementById("stats").style.display = "block";
	}
	else if(page == 'study')
	{
		document.getElementById("study").style.display = "block";
	}
	else if(page == 'classes')
	{
		document.getElementById("classes").style.display = "block";
	}
	else if(page == 'personal')
	{
		document.getElementById("personal").style.display = "block";
	}
}
function exit()
{
	document.location.href = '../index.php?page=exit';
}