'use strict'

var clickPlace = document.querySelector('.test');
var button = document.querySelector('#start-btn');
var firstScreen = clickPlace.querySelector('.test-wraper-start');
var testAbc = clickPlace.querySelector('.test-wraper-2');
console.log(button);
clickPlace.addEventListener('click', function() {
	if (button.firstChild.nodeValue == 'Старт') {
		firstScreen.classList.add('hidden');
		testAbc.classList.remove('hidden');
	}
	
});