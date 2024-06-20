<?php

// Footer

$root = get_template_directory_uri();
?>
</main><?php //close main, opens in header ?>

<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="inner">
		
		<div class="col-fourth">
			<a href="<?php echo get_site_url(); ?>">
				<div class="site-footer--logo"></div>
			</a>
		</div>

		<div class="col-fourth">
			<nav class="site-footer--nav">
				<ul>
					<li><a href="<?php echo get_site_url(); ?>/about">About</a></li>
					<li><a href="<?php echo get_site_url(); ?>/companies">Companies</a></li>
					<li><a href="<?php echo get_site_url(); ?>/contact">Contact Us</a></li>
				</ul>
			</nav>
		</div>

		<div class="col-fourth">
			<div class="site-footer--links">
				<h5>Links</h5>
				<ul>
					<?php 
					$coquery = new WP_query(array(
						'post_type' => 'enclara-companies',
						'posts_per_page' => -1,
						'order' => 'ASC'
					));
					while($coquery->have_posts()) : $coquery->the_post(); ?>

					<li><a href="<?php the_field('website_url',$post->ID); ?>"><?php the_title(); ?></a></li>

					<?php endwhile; wp_reset_postdata() ?>
				</ul>
			</div>
		</div>

		<div class="col-fourth">
			
		</div>
	  
	</div>
	<div class="inner inner-copyright">
		<div class="site-footer--copyright" style="position:relative !important; display: flex; justify-content: end;">
 			<p><span>&copy; <?php echo bloginfo('name').' '.date('Y'); ?></span> | <a href="<?php echo get_site_url() . '/privacy'; ?>">Privacy Policy</a> | <a href="https://enclarapharmacia.com/notice-of-privacy-practices"  target="_blank">Notice of Privacy Practices</a>
			<a style="cursor:pointer;" onclick="OneTrust.ToggleInfoDisplay()">&nbsp; Your Privacy Choices <img width="30" src="https://enclarahealthcare.com/wp-content/uploads/privacyoptions730x350.png" alt="Privacy Choices" class="nu-ml-1" height="14" style="margin-bottom: -2px;"></a>
			
			</p>
			
			
			<!--<div id="sitebymag">Site by <a href="#0">Magnetic</a></div>-->
		</div>
	</div>
</footer>

</div><?php //end #site-container-- ?>



<div class="overlay-outer" id="exec-overlay">
	<div class="overlay-content">
		<div class="overlay-content--inner">
			<button id="overlay-close">
				<svg viewBox="0 0 85.11 85.11">
				  <title>close-mark</title>
				  <path d="M12.47,72.68a42.57,42.57,0,1,0,0-60.21A42.62,42.62,0,0,0,12.47,72.68ZM69.39,15.76a37.92,37.92,0,1,1-53.62,0A38,38,0,0,1,69.39,15.76Z" transform="translate(-0.02 -0.02)" style="fill: #353535"/>
				  <g class="svg-close-x">
				  	<line x1="29.18" y1="56.05" x2="55.92" y2="29.05" style="fill: none;stroke: #353535;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 4.75px"/>
				  	<line x1="56.05" y1="55.92" x2="29.05" y2="29.18" style="fill: none;stroke: #353535;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 4.75px"/>
					</g>
				</svg>
				<span class="sr-only">Close</span>
			</button>
			<div id="execbio-section">
			</div>
		</div>
	</div>
</div>

<!-- OneTrust Cookies Consent Notice start for enclarahealthcare.com -->
<script src=https://cdn.cookielaw.org/scripttemplates/otSDKStub.js data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="e38a742c-e161-478e-a6bc-8478e076851d" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for enclarahealthcare.com -->

<script src="<?php echo "$root/assets/js/plugins.js"; ?>"></script>
<script src="<?php echo "$root/assets/js/global.js"; ?>"></script>

<script>
	$(document).EnclaraWebsite({
		//easing: '' //from velocity js easings, applied site wide
		//pageChangeDuration: 999 //smooth page transition time
	});
</script>
<?php wp_footer(); ?>
</body>
