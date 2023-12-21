$('.signin').hover(function() {}, function() {
	$(this).addClass('animateout');
	setTimeout(function() {
	  $('.signin').removeClass('animateout');
	}, 750);
  });
  
  $('.signin').on('click', function() {
	$('.overlay').toggleClass('active');
	$('signinform-field').removeClass('focus');
	$('input').val('');
	return false;
  });
  
  
  // Autoplay by Katheryn Guthrie
  // https://codepen.io/katguth3/pen/jmOrPZ 
  
	 var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/player_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
   
		// 3. This function creates an <iframe> (and YouTube player)
		//    after the API code downloads.
		var player;
		function onYouTubePlayerAPIReady() {
		  player = new YT.Player('video', {
			playerVars: { 'autoplay': 1, 'controls': 1,'autohide':1,'wmode':'opaque' },
			videoId: 'JW5meKfy3fY',
			events: {
			  'onReady': onPlayerReady}
		  });
		}
   
		// 4. The API will call this function when the video player is ready.
		function onPlayerReady(event) {
		  event.target.mute();
		}