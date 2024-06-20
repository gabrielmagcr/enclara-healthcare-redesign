

var isSingle = $s.body.hasClass('single-post');

//single post template (single.php)
if (isSingle) {

	var $socialBtn = $('.btn-social'),
			$theContent = $('.singlepost-article'),
			$prevNext = $('.singlepost-after--prevnext').find('h4 > a'),
			$imgs = $theContent.find('img[class*="wp-image-"]');

	//clean up wordpress's the_content output
	$theContent.find('p').each(function() {
		var $t = $(this),
				text = $t.text(),
				children = $t.children().length;
		if (text.length <= 1 && children === 0) {
			$t.remove();
		}
	});
	$imgs.each(function() {
		var $t = $(this),
				$a = $t.parent('a[href*="wp-content/uploads"]');
		if ($a.length)
			$t.unwrap();
	});


	//social share windows for buttons
	$socialBtn.on('click', function(e) {
		e.preventDefault();
		var $t = $(this);
		
		$.centeredPopup({
			url: $(this).attr('href'),
			title: 'Share on '+$t.find('.social-name').text(),
			width: 400,
			height: 400
		});
	});

	//adds hover effect to prevnext arrows
	$prevNext.hover(function() {
		$(this).parent('h4').next('.adjacent--arr').children('a').addClass('is-hovered');
	}, function() {
		$(this).parent('h4').next('.adjacent--arr').children('a').removeClass('is-hovered');
	});



//is blog listing page
} else {

	var $paged = $('[data-paged]'),
		$pageCountEl = $('#news-max-pages-num'),
		paged = $paged.data('paged');

	if (paged > 1) {
		$pageCountEl.text(paged);
	}

	$(document).on('click', '.news-loadmore-btn', function(e) {
		e.preventDefault();

		var $t = $(this),
				href = $t.attr('href'),
				$btnParent = $t.parents('.news-nextpage'),
				$target = $btnParent.next('.news-ajaxtarget');
		
		$target.hide();
		$t.addClass('is-loading').find('span').text('Loading').siblings('i').remove();
		$t.append('<i class="fa fa-refresh" aria-hidden="true"></i>');

		$target.load(href+' .news-ajaxbody', function() {
			$target.find('.news-postgrid').hide();

			setTimeout(function() {
				$btnParent.remove();
				$target.show().find('.news-postgrid').velocity('transition.slideUpIn', {duration: 1000});
			}, 500);
			
		});

	});

}
