var stopper = 2;
var grad = 90;
var firstbut = 1; /*0 = disabled; 1 = enabled;*/
var stopbut = 0;
var nextbut = 0;
var trueboy = 1;
var stoptimes = 0;
var numberImg = 0;
var nextRegim = 'start';



var timerid = "" +
	"<aside class='test-block__timers'>" +
    "    <div class='test-block__timers-title'>" +
    "        твоё время" +
    "    </div>" +
    "    <div id='timer_inp' class='test-timer test-timer1 '>0</div>" +
    "    <div id='timer_inp' class='test-timer test-timer2 '>0</div>" +
    "    <div id='timer_inp' class='test-timer test-timer3 '>0</div>" +
    "    <div id='timer_inp' class='test-timer test-timer4 '>0</div>" +
    "    <div id='timer_inp' class='test-timer test-timer5 '>0</div>" +
	"</aside>";
function nextImg(pathImg)
{
	if(stoptimes == 5) {
		location.href = 'test2.php';
		return;
	}//location.reload();
	
	if(nextbut == 1)
	{
		nexttimer();	
		nextbut = 0;
		document.getElementById('nextbut').src = '../../img/next_grey.png';
		let elementHTML = document.getElementById('ParentScrollingImg');
		let elementImg = document.getElementById('scrollingImg');
		
		if(numberImg >= (pathImg.length - 1) ) {
			numberImg = 0;
		} else {
			numberImg++;
		}
		elementImg.parentElement.removeChild(elementImg);
	
		elementHTML.innerHTML =  "<img src=" + pathImg[numberImg] + " height='130' width='400' id='scrollingImg'/>";
	
		firstbut = 1;
		document.getElementById('startbut').src = '../../img/start.png';
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
//setTimeout(timer,1000);
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

function superpuper(pathImg){
	switch(nextRegim) {
 		case 'start':  // if (x === 'value1')
    			nextRegim = 'stop';
    			startimer();
    			//alert(nextRegim);
    			break;
		case 'stop':  // if (x === 'value1')
    			nextRegim = 'next';
				stoptimer();
    	    	break;
		case 'next':  // if (x === 'value1')
    			nextRegim = 'start';
    			nextImg(pathImg);
    			break;
	}
}

