var test = document.querySelector('.test');
//start-scr---------------------------------------------------
var startScreen = document.querySelector('.test-wraper-start');
var btnStart = document.querySelector('#start-btn');
//ready-scr-------------------------------------------------
var readyScreen = document.querySelector('.test-wraper-ready');
var btnReady = readyScreen.querySelector('#btn-ready');
//task-scr--------------------------------------------------
var testQuestion = document.querySelector('.test-wraper2'); 
//task-scr 
var qa = [
{
	task: ['Дыня','Арбуз'],
	answ: ['Капуста','Морковь','Арбуз','Собака','Яблоко','Дыня'],
},
{
	task: ['Яйцо','Курица'],
	answ: ['Курица','Морковь','Арбуз','Собака','Яблоко','Яйцо'],
},
{
	task: ['Хрюкан','Кактус'],
	answ: ['Капуста','Морковь','Кактус','Собака','Хрюкан','Дыня'],
},
{
	task: ['Дерево','Пушка'],
	answ: ['Дерево','Морковь','Капуста','Собака','Яблоко','Пушка'],
},
{
	task: ['Океан','Озеро'],
	answ: ['Дерево','Река','Капуста','Озеро','Яблоко','Океан'],
},
];
var taskTest2 = document.querySelector('.task-test2');
var taskWord1 = document.querySelector('.task-word1');
var taskWord2 = document.querySelector('.task-word2');
//answwer-scr-----------------------------------------------
var testAnsw = document.querySelector('.test2-answer');
var posAnsw = document.querySelectorAll('.possible-answer__item');
var btnAnsw = document.querySelector('#btn-answ');
var allError = 0;
var a = 0;
//result-scr-------------------------------------------------
var testResult = document.querySelector('.test-wraper-result');
var btnResult = testResult.querySelector('#btn-result');
var resultBlock = testResult.querySelector('.result-block__text');

function generWord(arr) {
	taskWord1.textContent = qa[arr].task[0];
	taskWord2.textContent = qa[arr].task[1];
} 
function generAnsw(arr) {
	for (var i = 0; i< posAnsw.length; i++) {
		posAnsw[i].textContent = qa[arr].answ[i];
	};
};
//---отлов событий кликов по кнопкам перехода---------
test.addEventListener('click', function(e) {
//---start-btn------------------------------------
if (e.target.id == 'start-btn') {
	startScreen.classList.add('hidden');
	readyScreen.classList.remove('hidden');
//---btn-ready------------------------------------
} else if (e.target.id == 'btn-ready') {
	readyScreen.classList.add('hidden');
	testQuestion.classList.remove('hidden');
	generWord(a);
	generAnsw(a);
	setTimeout(function() {
		taskTest2.classList.add('hidden');
		testAnsw.classList.remove('hidden');
	}, 2000);
//---btn-answ----------------------------------------
} else if (e.target.id == 'btn-answ') {
	a++;
	if (a<5) {
		generWord(a);
		generAnsw(a);
		taskTest2.classList.remove('hidden');
		testAnsw.classList.add('hidden');
		for (var i=0; i<posAnsw.length; i++) {
			posAnsw[i].classList.remove('possible-answer__item-good');
			posAnsw[i].classList.remove('possible-answer__item-err');
		}
		b=0;
		userAnsw = [];
		btnAnsw.classList.add('hidden');
		testAnsw.querySelector('p').classList.remove('hidden');
		testAnsw.querySelector('h3').classList.add('hidden');
		testAnsw.querySelector('span').classList.add('hidden');
		setTimeout(function() {
			taskTest2.classList.add('hidden');
			testAnsw.classList.remove('hidden');
		}, 2000);
	} else {
		testQuestion.classList.add('hidden');
		testResult.classList.remove('hidden');
		result(allError);
		resultBlock.textContent = res + ' % слов';
		console.log(res);
	}
}
});
//---------------------------------------------------------
var pa = document.querySelector('.possible-answer');
var userAnsw = [];
var b = 0;
//----выбор слов по клику и запись их в массив---------------
function wordsСhoice(e) {
	userAnsw.push(e.target.innerHTML);
	console.log(userAnsw);
	for (var i=0; i<posAnsw.length; i++) {
		if (posAnsw[i].innerHTML==e.target.innerHTML) {
			posAnsw[i].classList.add('possible-answer__item-active');
		}
	}
};
//--проверка упражнения---------------------------------------
function check(arr) {
	for (var i=0; i<posAnsw.length; i++) {
		posAnsw[i].classList.remove('possible-answer__item-active');
		if (posAnsw[i].innerHTML==qa[arr].task[0]||posAnsw[i].innerHTML==qa[arr].task[1]) {
			posAnsw[i].classList.add('possible-answer__item-good');
			console.log(qa[arr].task[1]);
		};
	};
	var errorAnsw = 0;
	var goodAnsw =0;
	if (userAnsw.includes(qa[arr].task[0])) {
		goodAnsw++;
		userAnsw.splice(userAnsw.indexOf(qa[arr].task[0]),1);
		console.log(userAnsw);
	} else {
		errorAnsw++;
	}
	if (userAnsw.includes(qa[arr].task[1])) {
		goodAnsw++;
		userAnsw.splice(userAnsw.indexOf(qa[arr].task[1]),1);

	} else {
		errorAnsw++;
	}
	testAnsw.querySelector('p').classList.add('hidden');
	testAnsw.querySelector('h3').classList.remove('hidden');
	testAnsw.querySelector('h3').textContent = 'Отлично!';
//---если есть ошибки подсветить их--------------------------
if (errorAnsw>0) {
	for (var i=0; i<userAnsw.length; i++) {
		for (var j=0; j<posAnsw.length; j++) {
			if (posAnsw[j].innerHTML==userAnsw[i]) {
				posAnsw[j].classList.add('possible-answer__item-err');
			};
		}
	}
	testAnsw.querySelector('p').classList.add('hidden');
	testAnsw.querySelector('h3').classList.remove('hidden');
	testAnsw.querySelector('h3').textContent = 'Хорошо!';
	testAnsw.querySelector('span').classList.remove('hidden');
}
btnAnsw.classList.remove('hidden');
allError+=errorAnsw;
console.log('g'+goodAnsw);
console.log('e'+errorAnsw);
console.log('all'+allError);
console.log(userAnsw);
};
//--отлов событий при клике в поле ответов----------------
pa.addEventListener('mousedown', function(e) {
	console.log(e.which)
	if(e.which==1&&e.target.localName == 'span') {
		b++;
		if (b<=2) {
			wordsСhoice(e);
		};
		if (b==2) {
			console.log(a);
			setTimeout(check, 1000, a);
		}
	}
	
});
var res;
function result(errors) {
	var answers = 10;
	res = 100-(errors/answers)*100;
}

btnResult.onclick = function () {
    location.replace('http://readium.pro/test_code/okean/');
}

