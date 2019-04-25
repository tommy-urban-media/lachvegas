jQuery.noConflict();
jQuery(document).ready(function($){


	var msnry = $('#masonry-wall').masonry({
		// options
		columnWidth: '.grid-sizer',
		itemSelector: '.article-list-item',
		percentPosition: true,
		gutter: '.gutter-sizer',
		transitionDuration: '0.4s',
		stagger: 30
	});


	$('.button').on('click', function() {

		console.log('clicked');

    var $button = $(this);
    var url = $button.data('url');
		var action = $button.data('action');
		var key = $button.data('key');
		var postID = $button.data('post');

    if ( url != '' ) {

			$.ajax({
				url: url,
				dataType: 'json',
				data: {
					action: 'add_vote',
					key: key,
					postID: postID
				},
				type: 'POST',
				success: function(data) {
					console.log(data);

					// update the list

					var postVotesUp = data.votes['post-votes-up'],
					 		postVotesDown = data.votes['post-votes-down'],
							postVotesNeutral = data.votes['post-votes-neutral'],
							postVotesSum = postVotesUp + postVotesDown;


					var postVotesUpPercent = postVotesUp * 100 / postVotesSum;
					var postVotesDownPercent = postVotesDown * 100 / postVotesSum;
					var postVotesNeutralPercent = postVotesNeutral * 100 / postVotesSum;

					$('.post-votes .post-votes-up').css('width', (postVotesUpPercent) + '%');
					$('.post-votes .post-votes-down').css('width', (postVotesDownPercent) + '%');
					$('.post-votes .post-votes-neutral').css('width', (postVotesNeutralPercent) + '%');

					$('.post-votes .post-votes-up').text( 'lustig (' + Math.round(postVotesUpPercent) + '%)' );
					$('.post-votes .post-votes-down').text( 'nicht lustig (' + Math.round(postVotesDownPercent) + '%)' );
					$('.post-votes .post-votes-neutral').text( 'weder noch (' + Math.round(postVotesNeutralPercent) + '%)' );

				}
			});

    }

	});


	$('.menu-icon').on('click', function(e){

		e.preventDefault();

		$('#menu-mainmenu').slideToggle('fast');

	});


});
