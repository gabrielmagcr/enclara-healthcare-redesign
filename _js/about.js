
var $execs = $('[data-bio-html]'),
		$close = $('#overlay-close'),
		$bioTarget = $('#execbio-section');

var $overlay = $('#exec-overlay .overlay-content');		

$execs.each(function(index) {
	var $t = $(this),
			name = $t.find('h5').text(),
			pos = $t.find('p').text(),
			biohtml = $(this).data('bio-html'),
			imgSrc = $t.find('img').attr('src');

	var templ = '<div class="exec-bio">';
	templ += '<div class="exec-bio--title"><div class="exec-bio--img"><img src="'+imgSrc+'"></div><h3>'+name+'</h3><p>'+pos+'</p><hr></div>';
	templ += '<div class="exec-bio--bio">'+biohtml+'</div>';
	templ += '</div>';
	
	
	$t.on('click', function() {
		$s.body.addClass('is-showing-overlay');
		$bioTarget.html(templ);

		var contHeight = $overlay.outerHeight(),
				offset = ($(window).height() - contHeight)/2,
				newMargin = offset > 10 ? offset+'px' : '3%';

		$overlay.css({marginTop: newMargin });
	
	});
});

$close.on('click', function() {
	$s.body.removeClass('is-showing-overlay');
	$bioTarget.html('');
});

