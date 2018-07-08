var stopper = 2;
var grad = 90;
var firstbut = 1; /*0 = disabled; 1 = enabled;*/
var stopbut = 0;
var nextbut = 0;
var firstPressedStop = 0;

var stoptimes = 0;

var number_clicks = 0;

function rotateit()
{
	if(nextbut == 1)
	{
		if(number_clicks > 3){
			location.href = 'test6.php';
        	return;	
		}
		jQuery(document).ready(function()
		{
			jQuery("#rotateImg").rotate(grad);
		});
		if(stoptimes < 3)
		{
		if(grad == 270) grad = 0;
		else if(grad == 90) grad += 180;
		else grad += 90;
		}
		nexttimer();
		
		nextbut = 0;
		document.getElementById('nextbut').src = '../../img/next_grey.png';
		firstbut = 1;
		document.getElementById('startbut').src = '../../img/start.png';
		if(stoptimes == 6) location.reload();
	}
}
function startimer()
{	
	if(firstbut == 1)
	{
		stopper = 0;
		
		document.getElementById("texthint").style.display = "none";
		document.getElementById("rotateImg").style.display = "block";
		
		firstbut = 0;
		document.getElementById('startbut').src = '../../img/start_grey.png';
		stopbut = 1;
		document.getElementById('stopbut').src = '../../img/stop.png';
	}
}
function nexttimer()
{
	document.getElementById('timer_inp').id = 'none';
}
function timer(){
	var obj=document.getElementById('timer_inp');
	setTimeout(timer,1000);
	if(stopper == 0){obj.innerHTML++;}
}
setTimeout(timer,1000);
function stoptimer()
{
	if(firstPressedStop == 0)
	{
		stopper = 1;
		stopbut = 0;
		
		document.getElementById('stopbut').src = '../../img/stop_grey.png';
		nextbut = 1;
		document.getElementById('nextbut').src = '../../img/next.png';
		document.getElementById("startbut").style.display = "none";
		document.getElementById("stopbut").style.display = "none";
		document.getElementById("nextbut").style.display = "none";
		document.getElementById("rotateImg").style.display = "none";
		
		document.getElementById("textAnswerBlock").style.display = "block";
		
		firstPressedStop = 1;
	}
	else if(firstPressedStop == 1)
	{
		document.getElementById("textAnswerBlock").style.display = "none";
		
		document.getElementById("startbut").style.display = "block";
		document.getElementById("stopbut").style.display = "block";
		document.getElementById("nextbut").style.display = "block";
		document.getElementById("rotateImg").style.display = "block";

		firstPressedStop = 2;
	}
	else if(stopbut == 1)
	{
		stopper = 1;
		if(number_clicks > 2){
			document.getElementById('nextbut').src = '../../img/nextExa.png';	
		} else {
			document.getElementById('nextbut').src = '../../img/next.png';
		}
		stopbut = 0;
		document.getElementById('stopbut').src = '../../img/stop_grey.png';
		nextbut = 1;
		number_clicks++;
		if(stoptimes == 5) document.getElementById('nextbut').src = '../../img/onemoretime.png';
			stoptimes++;
	}
}
