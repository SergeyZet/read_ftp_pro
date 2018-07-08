var first = 1;
$(document).ready(function(){
	if(first == 1)
	{
		$(".auth").hover(function() {
			$(this).stop().animate({opacity:'1.0'},500);
			$("#foot").delay(100).animate({bottom: "0px"}, 1000);
		});
		first = 0;
	}
});
function changebackimage()
{
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