var first = 1;
var temp = 0;
$(document).ready(function(){
	if(first == 1)
	{
		$(".auth").hover(function() {
			$(this).stop().animate({opacity:'1.0'},500);
			$("#foot").delay(100).animate({bottom: "0px"}, 1000);
			/*changebackimage();
			soundResume();*/
		});
		first = 0;
	}
});
function soundResume() {
	if(temp == 1) return;
  var audio = new Audio(); // Создаём новый элемент Audio
  var randnum = Math.floor((Math.random() * 3) + 1);
  if(randnum == 1) audio.src = 'song1.mp3'; // Указываем путь к звуку "клика"
  else if(randnum == 2) audio.src = 'song2.mp3'; // Указываем путь к звуку "клика"
  else if(randnum == 3) audio.src = 'song3.mp3'; // Указываем путь к звуку "клика"
  audio.autoplay = true; // Автоматически запускаем
  temp = 1;
}
function changebackimage()
{
	if(temp == 1) return;
	$(function(){
    $('.main').toggleClass( 'main2' );
	});
}
function anim(){
    $("#form_avtorization").animate({left: "-70%"}, 500);
	$("#form_avtorization").queue(function ()
	{
		document.getElementById("form_avtorization").style.display = "none";
		document.getElementById("form_register").style.display = "block";
		$("#form_register").animate({left: "0px"}, 500);
	});
	setTimeout(clearqueque, 900);
};
function animback(){
    $("#form_register").animate({left: "70%"}, 500);
	$("#form_register").queue(function ()
	{
		document.getElementById("form_register").style.display = "none";
		document.getElementById("form_avtorization").style.display = "block";
		$("#form_avtorization").animate({left: "0px"}, 500);
	});
	setTimeout(clearqueque, 900);
};
function clearqueque()
{
	$("#form_avtorization").clearQueue();
	$("#form_register").clearQueue();
};