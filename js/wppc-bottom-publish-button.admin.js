(function ($) {
	"use strict";

	$(window).load( function() {

		// Button markup depending on post/page status
		if($('#publish').val() == wppcbottompublishbuttonParams.publish) {
			$('<div id="wppcbottompublishbutton"><a class="button button-totop">'+wppcbottompublishbuttonParams.totop+'</a><a class="button button-savedraft">'+wppcbottompublishbuttonParams.savedraft+'</a><a class="button button-preview">'+wppcbottompublishbuttonParams.preview+'</a><a class="button button-primary button-large">'+wppcbottompublishbuttonParams.publish+'</a></div>').appendTo("#wpbody-content");
		} else {
			$('<div id="wppcbottompublishbutton"><a class="button button-totop">'+wppcbottompublishbuttonParams.totop+'</a><a class="button button-previewchanges">'+wppcbottompublishbuttonParams.previewchanges+'</a><a class="button button-primary button-large">'+wppcbottompublishbuttonParams.update+'</a></div>').appendTo("#wpbody-content");
		}

		// DOM Caching
		var elements =  {
			box    : $('#wppcbottompublishbutton'),
			heart  : $('#jsc-heart'),
			update  : $('#wppcbottompublishbutton .button-primary'),
			publish: $('#publish'),
			postdraft: $('#save-post'),
			previewpublish: $('#post-preview'),
			totop : $('#wppcbottompublishbutton .button-totop'),
			preview : $('#wppcbottompublishbutton .button-preview'),
			previewchanges : $('#wppcbottompublishbutton .button-previewchanges'),
			savedraft : $('#wppcbottompublishbutton .button-savedraft')
		}

		// Publish/Update content
		elements.update.on('click', function(e){

			if($(this).text() == wppcbottompublishbuttonParams.publish) {
				$(this).text(wppcbottompublishbuttonParams.publishing);
				setTimeout(function() {
					$(this).text(wppcbottompublishbuttonParams.publish);
				}, 2000);
			} else {
				$(this).text(wppcbottompublishbuttonParams.updating);
				setTimeout(function() {
					$(this).text(wppcbottompublishbuttonParams.update);
				}, 2000);
			}

			elements.publish.trigger('click');

			e.preventDefault();

		});
		
		// Preview content
		elements.preview.on('click', function(e){

			elements.previewpublish.trigger('click');

			e.preventDefault();

		});
		
		// Preview changes content
		elements.previewchanges.on('click', function(e){

			elements.previewpublish.trigger('click');

			e.preventDefault();

		});
		
		// Save Draft
		elements.savedraft.on('click', function(e){

			elements.postdraft.trigger('click');

			e.preventDefault();

		});

		// Scroll to top
		elements.totop.on('click', function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop : 0}, 600);
		});

		// Check if we are near bottom, show box
		$(window).scroll(function(){
			if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
				elements.box.show();

			} else {
				elements.box.hide();
			}
		});

		// Show box on wide screens
		$(window).on('resize', function() {

			if($(window).width() > 900 && $(window).height() > 1000) {
				elements.box.show();
			} else {
				elements.box.hide();
			}

		});

	});

}(jQuery));