// Toggling sound for header video
$(document).ready(function() {

    // Removing template generated H1 and wrapper containing so video is flush
    $('h1').first().parents().eq(2).remove();
    // Removing template generated breadcrumbs
    $('.breadcrumbs').remove();

	$('#videoHeader video').prop('muted', true);


    // Making the mute button for the videos
	$('#videoHeader').click(function() {
		if ($('#videoHeader video').prop('muted')) {
			$('#videoHeader video').prop('muted', false);
		} else {
			$('#videoHeader video').prop('muted', true);
		}
	});

    // List of videos
    var videosmp4 = [
        '/comc/images/home/video/DylanGeorgeAmbassador.mp4',
        '/comc/images/home/video/MarcosPalaciosAmbassador.mp4',
        '/comc/images/home/video/RobinDuffeeAmbassador.mp4',
        '/comc/images/home/video/VanessaLedesmaAmbassador.mp4'
        ], i = 0;
    // Randomly selecting one of the videos
    var mp4Source = videosmp4[i=Math.floor(Math.random()*(videosmp4.length))];
    var webmSource = "";
    var oggSource = "";

    // Testing mp4 src and making webm match
    if (mp4Source == '/comc/images/home/video/DylanGeorgeAmbassador.mp4') {
    	webmSource = '/comc/images/home/video/DylanGeorgeAmbassador.webm';
        oggSource = '/comc/images/home/video/DylanGeorgeAmbassador.ogg';
    } else if (mp4Source == '/comc/images/home/video/MarcosPalaciosAmbassador.mp4') {
    	webmSource = '/comc/images/home/video/MarcosPalaciosAmbassador.webm';
        oggSource = '/comc/images/home/video/MarcosPalaciosAmbassador.ogg';
    } else if (mp4Source == '/comc/images/home/video/RobinDuffeeAmbassador.mp4') {
    	webmSource = '/comc/images/home/video/RobinDuffeeAmbassador.webm';
        oggSource = '/comc/images/home/video/RobinDuffeeAmbassador.ogg';
    } else if (mp4Source == '/comc/images/home/video/VanessaLedesmaAmbassador.mp4') {
    	webmSource = '/comc/images/home/video/VanessaLedesmaAmbassador.webm';
        oggSource = '/comc/images/home/video/VanessaLedesmaAmbassador.ogg';
    } else {
    	webmSource = '/comc/images/home/video/DylanGeorgeAmbassador.webm';
        oggSource = '/comc/images/home/video/DylanGeorgeAmbassador.ogg';
    }

    // Giving the video the src directory
    $('*[type="video/mp4"]').attr('src', mp4Source+ "?" + new Date().getTime());
    $('*[type="video/webm"]').attr('src', webmSource+ "?" + new Date().getTime());
    $('*[type="video/ogg"]').attr('src', oggSource+ "?" + new Date().getTime());

    // Loading the video after src has been set
    $('#videoHeader video')[0].load();

  });