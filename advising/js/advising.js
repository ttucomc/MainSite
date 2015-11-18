$(document).ready(function() {

	// Toggling hover class on team card
	$('.team-card').each(function(){
	    $(this).find('.tm-card-details').hover(function() {
	    	$(this).parent().addClass('hover');					// Adding class on mouse enter
	    }, function(){											// Removing class on mouse exit
	  		$(this).parent().removeClass('hover');
	    });
	});

	// Opening description when letter card is clicked under 768px
	
	$('.tm-card-bio').click(function() {
		var thisCard = $(this).parent();
		if ($(window).width() < 768) {
			$(thisCard).find('.tm-card-details').css('visibility', 'initial');
			$(thisCard).find('.tm-card-details').fadeTo('fast', 1);
		}
   	});

   	$('.close').click(function() {
   		$(this).closest('.tm-card-details').fadeTo('fast', 0);
   		$(this).closest('.tm-card-details').css('visibility', 'hidden');
   	});

});