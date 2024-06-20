//sitewide javascript
;(function($) { 

	$.fn.EnclaraWebsite = function(options) {

		var defaults = {
			easing: 'easeOutCirc',
			pageChangeDuration: 999,
			gmapsKey: 'AIzaSyCmQltveJTrzgy3GKGdNPVkiAbdlT3chIE'
		},
		$s = {}, 
		s = $.extend(defaults,options),
		
		propSetup = function() {
			//dom elements
			$s.doc = $(this);
			$s.win = $(window);
			$s.body = $('body');
			$s.header = $('#site-header');
			$s.nav = $('#main-nav');
			$s.navToggle = $('#main-nav-toggle');
			$s.internalAnchor = $('a[href^="'+window.location.origin+'"]:not([href*="uploads"], [class="news-loadmore-btn"])');
			$s.scrollAnchor = $('[data-scroll]');
			$s.lazyImgs = $('[data-img], [data-bgimg]');
			$s.inViewEls = $('[data-in-view]');
			$s.parallax = $('[data-parallax]');

			//state props
			s.navOpen = false;
			s.modalOpen = false;
			s.breakpoint = window.getComputedStyle(document.getElementById('site-container'), ':before').getPropertyValue('content').replace(/\"/g,'');
			s.didScroll = false;
			s.didResize = false;
			s.winTop = window.pageYOffset;
			s.winHeight = $s.win.height();
			s.inView = [];
			s.page = {
				home: $s.body.hasClass('home'),
				about: $s.body.hasClass('page-template-about'),
				companies: $s.body.hasClass('page-template-companies'),
				careers: $s.body.hasClass('page-template-careers'),
				contact: $s.body.hasClass('page-template-contact'),
				newsFeed: $s.body.hasClass('page-template-news') || $s.body.hasClass('archive'),
				newsSingle: $s.body.hasClass('single-post'),
				privacy: $s.body.hasClass('page-template-privacy'),
			};

			s.debug = true;

			if (s.debug)
				console.log('settings: ', s);
				console.log('elements:', $s);
		},



		//test if el is partially in viewport
		//----------------------------------------//
		inView = function() {
			var $t = $(this),
	      	elTop = $t.offset().top;
			return ((elTop <= s.winTop+s.winHeight) && (elTop+$t.outerHeight() >= s.winTop));
		},
		
		//show data-inview elements
		showInViewEls = function() {
			
			if ($s.inViewEls.length && s.inView.length < $s.inViewEls.length) {
				
				$s.inViewEls.each(function(index) {
					var $t = $(this);
					
					if (inView.call($t) && !$t.hasClass('is-in-view')) {
						
						$(this).addClass('is-in-view');
						s.inView.push(index);
					
					} 
				});
			
			}
		},


		//equalize element heights
		//----------------------------------------//
		heightEqualize = function(container) {
			var $groups = $('[data-equalize-parent]');
			if ($groups.length)
				$groups.each(function() {
					var bp = $(this).data('equalize-parent');
					var $cols = $(this).find('[data-equalize-item]'),
							$mes = $cols.find('[data-equalize-measure]'),
							tallest = getTallest($mes);
					$cols.css({height:tallest+'px'});
				});
		},
		getTallest = function($els) {
			var tallest=0;
			$els.each(function() {
				var $t = $(this),
						height = $t.outerHeight();
				if (height > tallest)
					tallest = height;
			});
			return tallest;
		},


		//lazy loaded images
		//----------------------------------------//
		imgLazyLoad = function() {
			echo.init({

			});
		},

		//small screen nav
		//-------------------------------//
		mobileNavToggle = function() {
			var doToggle = function() {
				if (!s.navOpen) {
					$s.nav.velocity('slideDown', {duration:450, ease:'easeOutCirc'});
					$s.body.addClass('is-showing-nav');
					s.navOpen = true;
				} else {
					$s.nav.velocity('slideUp', {duration:450, ease:'easeOutCirc'});
					$s.body.removeClass('is-showing-nav');
					s.navOpen = false;
				}
			};
			$s.navToggle.click(doToggle);
		},


		//Resize callback (gets debounced)
		//---------------------------------------//
		resizeCallback = function() {
			s.breakpoint = window.getComputedStyle(document.getElementById('site-container'), ':before').getPropertyValue('content').replace(/\"/g,'');
			s.winHeight = $s.win.height();

			heightEqualize();

			if (s.debug)
				console.log('Breakpoint: ', s.breakpoint);
		},


		//Onscroll stuff
		//-----------------------------------//
		scrollCallback = function() {
			if (s.didScroll) {
				s.winTop = window.pageYOffset;

				if (s.page.home)
					TweenMax.set($s.parallax, { y:s.winTop*0.2 });

				showInViewEls();

				s.didScroll = false;
			}
		},


		//scroll ticker
		//--------------------------------//
		rafTicker = function() {
			scrollCallback();
			requestAnimationFrame(rafTicker);
		},

		

		//Initial page load
		//----------------------------------//
		pageLoadHandler = function() {
			$s.body.addClass('is-loaded');
		},


		//smooth site navigation
		//-------------------------------//
		smoothPageLoads = function() {
			var doChange = function(e) {
				if (Modernizr.history) {
					e.preventDefault();
					var $t = $(this),
							nextUrl = $t.attr('href');

					$s.body.addClass('is-unloading');
					history.pushState({state:nextUrl}, null, nextUrl);
					
					window.setTimeout(function() {
						window.location.replace(nextUrl);
					}, s.pageChangeDuration);
				}
			};

			$s.internalAnchor.click(doChange);
		},


		//smooth hash scroll
		//----------------------------//
		smoothHashScroll = function() {
			var doScroll = function(e) {
				e.preventDefault();
				var elId = $(this).attr('href'),
						offset = parseInt( $(this).data('scroll-offset') );
				$(elId).velocity('scroll', {easing: s.easing, offset: offset});
			};
			$s.scrollAnchor.click(doScroll);
		},




		//Home Page Specific----------------------//
		doHomePage = function() {
			//news slider
			var $newsFeed = $('.block-news--content'),
					$slider = $('.posts-slider'),
					$slide = $('.posts-slider--item'),
					$liners = $('.posts-slider--itemliner'),
					$larr = $('#slider-arr-left'),
					$rarr = $('#slider-arr-right');

			var setSliderHeight = function() {
				var heightval = getTallest($liners)+'px';
				$slider.css({height: heightval});
			},
			moveRight = function() {
				$slide.each(function() {
					var $t = $(this);
					if ($t.hasClass('item--1')) {
						$t.removeClass('item--1').addClass('item--3');
					} else if ($t.hasClass('item--2')) {
						$t.removeClass('item--2').addClass('item--1');
					} else if ($t.hasClass('item--3')) {
						$t.removeClass('item--3').addClass('item--2');
					}
				});
			},
			moveLeft = function() {
				$slide.each(function() {
					var $t = $(this);
					if ($t.hasClass('item--1')) {
						$t.removeClass('item--1').addClass('item--2');
					} else if ($t.hasClass('item--2')) {
						$t.removeClass('item--2').addClass('item--3');
					} else if ($t.hasClass('item--3')) {
						$t.removeClass('item--3').addClass('item--1');
					}
				});
			};


			$larr.click(moveLeft);
			$rarr.click(moveRight);
			$(document).on('click', '.item--2', moveLeft);
			$(document).on('click', '.item--3', moveRight);

			setSliderHeight();
			$s.win.on({
				resize: $.debounce(250, setSliderHeight)
			});

			$('.learn-more').click(function(e) { e.preventDefault(); $(this.hash).velocity('scroll')  });
		},


		//everything in the right order
		//-----------------------------------------//
		init = function() {
			propSetup();
			rafTicker();
			imgLazyLoad();
			heightEqualize();
			//smoothPageLoads();

			//Anything not global can be written in a separate file
			//and can be gulp-included here
			if (s.page.home) {
				doHomePage();
			} else if (s.page.contact) {
				//=require contact.js
			} else if (s.page.careers) {
				//=require careers.js
			} else if (s.page.about) {
				//=require about.js
			} else if (s.page.newsFeed || s.page.newsSingle) {
				//=require news.js
			} else if (s.page.privacy) {
				//=require privacy.js
			}
			
			//document ready stuff
			$s.doc.ready([mobileNavToggle, smoothHashScroll]);

			$s.win.on({
				scroll: function() { s.didScroll = true; },
				resize: $.debounce(250, resizeCallback),
				load: pageLoadHandler
			});
		};

		return init();
	};

})(jQuery);
