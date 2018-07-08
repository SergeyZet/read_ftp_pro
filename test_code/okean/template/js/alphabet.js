
var stopper = 2;
var grad = 90;
var firstbut = 1; /*0 = disabled; 1 = enabled;*/
var stopbut = 0;
var nextbut = 0;

var trueboy = 1;


var stoptimes = 0;
function rotateit()
{
	if(stoptimes == 5) {
		location.href = 'test3.php';
		return;
	}
	if(nextbut == 1)
	{
		jQuery(document).ready(function()
		{
			jQuery("#rotateImg").rotate(grad);
		});
		if(grad == 270) grad = 0;
		else grad += 90;	
		nexttimer();
		
		nextbut = 0;
		document.getElementById('nextbut').src = '../../img/next_grey.png';
		firstbut = 1;
		document.getElementById('startbut').src = '../../img/start.png';
		//location.reload();
	}
}
function startimer()
{	
	if(firstbut == 1)
	{
		stopper = 0;			
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
	if(stopbut == 1)
	{
		stopper = 1;
		
		stopbut = 0;
		document.getElementById('stopbut').src = '../../img/stop_grey.png';
		nextbut = 1;
		document.getElementById('nextbut').src = '../../img/next.png';
		
		//if(stoptimes == 4) document.getElementById('nextbut').src = '../../img/onemoretime.png';
		if(stoptimes == 4) document.getElementById('nextbut').src = '../../img/nextExa.png';
		
		stoptimes++;
	}
}