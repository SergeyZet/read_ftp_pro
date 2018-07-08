var header = document.querySelector('.test-header');
var test = document.querySelector('.test');
var btnStart = document.querySelector('#start-btn');
var ball = document.querySelector('.ball-screen');
var timeBar = document.querySelector('.time-bar__band');
var secCount = 0;
function timer_func()
{
	setTimeout(timer_func,1000);
	if(stopTime == 0) secCount++;
	if(secCount == 20)
	{
		stopTime = 1;
	}
	
}

function startTime()
{
	stopTime = 0;
	timer_func();
}

var firstTime = 0;
btnStart.onclick = function() {
	test.classList.add('hidden');
	header.classList.add('hidden');
	ball.classList.remove('hidden');
	timeBar.classList.add('animation-bar');
	if(firstTime == 0)
	{
		startTime();
	var directionV = 1; //1 - вниз, 2 - вверх
	var directionH = 1; //1 - вправо, 2 - влево
	var Xpos = 11;
	var Ypos = 11;
	var Speed = 5;
      var start = Date.now(); // сохранить время начала

      var timer = setInterval(function() {
        // вычислить сколько времени прошло из opts.duration
        var timePassed = Date.now() - start;

        if(Xpos >= screen.width - 200) directionH = 2;
        else if(Xpos <= 10) directionH = 1;
        if(Ypos >= screen.height - 300) directionV = 2;
        else if(Ypos <= 10) directionV = 1;
		//if (timePassed > 2000) document.write(train.style.left);

		if(directionH == 1) Xpos = Xpos + Speed;
		else if(directionH == 2) Xpos = Xpos - Speed;
		train.style.left = Xpos + 'px';
		
		if(directionV == 1) Ypos = Ypos + Speed;
		else if(directionV == 2) Ypos = Ypos - Speed;
		train.style.top = Ypos + 'px';

        if (timePassed > 20000) {clearInterval(timer); //вырубить таймер
        	location.replace('http://readium.pro/test_code/okean/index.php');
        }
      }, 20);
      firstTime = 1;
    }
  }