// ========== INTERACTIVE INFORMATION SECTION ========== //

$(document).ready(function() {
// Removing template generated H1 and wrapper containing so video is flush
    $('h1').first().parent().remove();
    // Removing template generated breadcrumbs
    $('.breadcrumbs').remove();
});

// ===== When an H4 is clicked ===== //
$('.major-interactive-left ul li h4').click(function() {

	// ***** LEFT SIDE ***** //
	//Sliding up all other 'p's
	$('.p-toggle').not($(this).next('.p-toggle')).slideUp();
	//Sliding the 'p' down under the h4 that was clicked
	$( this ).next( '.p-toggle' ).slideDown();

	//Fading out all h4s opacity to .5
	$('.major-interactive-left > ul > li').css({'opacity':'.5'});
	// Fading in the h4 clicked to full opacity
	$(this).parent().css({'opacity':'1'});

	// ***** RIGHT SIDE ***** //
	// Getting the data attribute for the link that was clicked
	var $linkVisual = $(this).attr('data-mi-visual');

	// Going through each div on right side and comparing data attributes
	$('.major-interactive-right > div').each(function() {

		var $rightLinkVisual = $(this).attr('data-mi-visual');

		if ($rightLinkVisual != $linkVisual) {
			$(this).fadeOut();
		} else {
			$(this).delay(400).fadeIn();
		}

	});

});

// ===== FAQ SECTION ===== //
$('.major-faqs li').click(function() {

	// Getting question number
	var $questionNum = $(this).attr('data-mi-question');

	// ***** LEFT SIDE ***** //
	// Hiding all arrows
	$('.faq-arrow').css({'margin-right':'-1em', 'opacity':'0', 'left':'-30px'});
	// Showing arrow of clicked question
	$(this).find('.faq-arrow').css({'margin-right':'1em', 'opacity':'1', 'left':'0'});

	// ***** RIGHT SIDE ***** //
	// Fading out current displayed answer
	$('.interactive-faq-a p').fadeOut(200);
	// Fading in answer of clicked question
	$('.interactive-faq-a').find('[data-mi-answer="' + $questionNum + '"]').delay(200).fadeIn(200);

});