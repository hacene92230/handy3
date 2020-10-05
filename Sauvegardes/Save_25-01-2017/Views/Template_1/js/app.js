(function($){

	function SendSearch(id1, id2) {

		$(id1).click(function(e) {
			e.preventDefault();
			var research = $(id2).val().replace('/', '');

			window.location = '../../../search/' + research;
			});
		$(id2).keyup(function(e) {
			if(e.keyCode == 13) {
				e.preventDefault();
				var research = $(id2).val().replace('/', '');

				window.location = '../../../search/' + research;
			}
		});

	}

	SendSearch('#fa-search', '#search-bar');
	SendSearch('#fa-search-large', '#search-bar-large');

	$('img').on('dragstart', function(event) { event.preventDefault(); });

	$('#save_require').click(function(e){
		e.preventDefault();
		var save = confirm('Vous venez de demander une sauvegarde du site. Confirmez-vous la demande ?');
		if(save == true) {
			window.location = '../../../save';
		}
	});

	$(window).scroll(function(){
		if($(this).scrollTop() > 250) {
			$('#scroll').fadeIn();
		} else{
			$('#scroll').fadeOut();
		}
	});

	$('#scroll a').click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 300);
		return false;
	});

})(jQuery);