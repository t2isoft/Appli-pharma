$(document).ready(function(){
	$(".menu").hide();
	$("#bground").hide();
	
	$("#hovermenu").click(function(){
		$("#bground").fadeIn(600);
		$(".menu").fadeIn(700);
		
		$('body').addClass('flou').fadeIn(600);
		
		
	});
	
	
	$("#bground").click(function(){
		$("#bground").fadeOut(400);
		$(".menu").fadeOut(500);
		$('body').removeClass('flou');
	});
		
		
		
		
	
});