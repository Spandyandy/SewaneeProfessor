//Right arrow
function nextSlide(){
	var currentSlide = $('.slide.active');
	var nextSlide = currentSlide.next();
	var currentDot = $('.dot.active');
	var nextDot = currentDot.next();

	currentSlide.fadeOut(700).removeClass('active');
	nextSlide.fadeIn(700).addClass('active');
	currentDot.removeClass('active');
	nextDot.addClass('active');


	if(nextSlide.length == 0){
		$('.slide').first().fadeIn(700).addClass('active');
		$('.dot').first().addClass('active');
	}
}

$('#right-jumbotron').click(function(){
	nextSlide();
});

// Left arrow
function prevSlide(){
	var currentSlide = $('.slide.active');
	var prevSlide = currentSlide.prev();
	var currentDot = $('.dot.active');
	var prevDot = currentDot.prev();

	currentSlide.fadeOut(700).removeClass('active');
	prevSlide.fadeIn(700).addClass('active');
	currentDot.removeClass('active');
	prevDot.addClass('active');

	if(prevSlide.length == 0){
		$('.slide').last().fadeIn(700).addClass('active');
		$('.dot').last().addClass('active');
	}
}


$('#left-jumbotron').click(function(){
	prevSlide();
});

// Automatically reveal next slide in 4sec
$(document).ready(function() {
	setInterval(nextSlide, 4000);
});



//top-nav appears when scrolled down
$(window).scroll(function(){
	var currentPos = $(this).scrollTop();
	var topNav = $('.top-nav');
	var dot = $('.dot');
	if(currentPos >= dot.offset().top){
		topNav.addClass('active');
	}else{
		topNav.removeClass('active');
	}
});
