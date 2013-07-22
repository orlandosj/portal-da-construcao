$(document).ready(function(){
	
	/* Function for lavalamp navigation menu */	
	$("#menu").lavaLamp({
		fx: "backout",
		speed: 700
	});
	
	$("#anuncios ul li:even").addClass("left");
	$("#anuncios ul li:odd").addClass("right");
	$("#anuncios ul li:last").addClass("last");
	$("#anuncios ul li:last").prev().addClass("last");
	
	$("#contactFormArea .input-help").focus(function(){
		var input = $(this);
		$("#contactFormArea .form-help").addClass("hidden");
		$("#contactFormArea .help-"+input.attr("name")).removeClass("hidden");
	});
	$("#contactFormArea .input-help").blur(function(){
		$("#contactFormArea .form-help").addClass("hidden");
	});
	

	if($("#last_twitter_update").length > 0){
		$.getScript("http://twitter.com/statuses/user_timeline/quizzpot.json?callback=twitterCallbackQuizz&;count=1");
	}
	
});

function twitterCallbackQuizz(twitters){
	var last = twitters[0];
	var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	var txt = last.text.replace(exp,"<a href='$1'>$1</a>"); 
	var posted = new Date(last.created_at)
	
	$("#last_twitter_update").html(txt);
	
}