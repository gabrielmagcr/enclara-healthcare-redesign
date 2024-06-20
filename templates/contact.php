<?php

/* Template Name: Contact */

get_header();

$fields = null;

while (have_posts()) : the_post();
	$fields = get_fields($post->ID);
endwhile; wp_reset_postdata();
?>


<section class="hero-default">
	<div class="inner">
		
		<?php do_page_headline($fields['sub_headline'],$fields['main_headline'],$fields['paragraph']); ?>

	</div>
</section>


<section class="block-contactform">
	<div class="inner">
		<div class="inner-narrow">

		<div class="block-contact--form form-style--default">
				
<!--			<form action="">-->
<!--				-->
<!--				<div class="form-field--group">-->
<!--					<div class="form-field">-->
<!--						<label for=""><span>*</span> First Name</label>-->
<!--						<input type="text">-->
<!--					</div>-->
<!--					<div class="form-field">-->
<!--						<label for=""><span>*</span>Last Name</label>-->
<!--						<input type="text">-->
<!--					</div>-->
<!--				</div>-->
<!---->
<!--				<div class="form-field--group">-->
<!--					<div class="form-field">-->
<!--						<label for=""><span>*</span>Company</label>-->
<!--						<input type="text">-->
<!--					</div>-->
<!--					<div class="form-field">-->
<!--						<label for=""><span>*</span>Phone Number</label>-->
<!--						<input type="text">-->
<!--					</div>-->
<!--				</div>-->
<!--				-->
<!--				<div class="form-field--full">-->
<!--					<label for=""><span>*</span>Message Goes Here</label>-->
<!--					<textarea name="" id=""></textarea>-->
<!--				</div>-->
<!---->
<!--				<div class="form-field--full form-field--submit">-->
<!--					<button class="button" type="submit">Contact Us</button>-->
<!--				</div>-->
<!---->
<!--			</form>-->
			<?php echo do_shortcode('[contact-form-7 id="245" title="Contact form 1"]'); ?>

		</div>
		
		</div>
	</div>
</section>


<section class="block-divider">
	<div class="inner"><div class="inner-narrow"><hr></div></div>
</section>


<section class="block-locations">
	<div class="inner">

		<div class="inner-narrow location--main">
			<div class="location--col col-third">
				<?php
					$logo = get_field('enclara_healthcare_logo', 'option');
					$logo_url = $logo['url'];
					$logo_alt = $logo['alt'];
				?>
				<figure class="location-logo">
					<img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_url; ?>">
				</figure>
				<hr class="divider divider--red divider--small">
				<div class="location--col-details">
					<p><span>A</span> <?php the_field('display_address', $post->ID); ?></p>
					<p><span>P</span> <?php the_field('phone_number', $post->ID); ?></p>
				</div>
			 
			</div>
	<!--		<div class="location--map">
				<div class="location--map-inner">
					<div id="eh-googlemap" data-map-lat="<? /*php echo $fields['map_address']['lat']; ?>" data-map-lng="<?php echo $fields['map_address']['lng'];*/ ?>"></div>
				</div>
			</div>
		</div>-->
			
		<div class="inner-narrow location--sub">
		<?php 
			$coquery = new WP_query(array(
				'post_type' => 'enclara-companies',
				'posts_per_page' => -1,
				'order' => 'ASC'
			));
			while($coquery->have_posts()) : $coquery->the_post(); ?>

			<div class="location--col col-third">
				<div class="location--col-inner">
					<figure class="location-figure">
						<a href="<?php echo the_field('website_url') ?>" target="_blank">
							<?php
								$logo = get_field('logo', $post->ID);
							?>
							<img class="location-image--<?php echo $post->post_name?>" style="height: <?php echo $logo['height'] / 2 . 'px; width: '. $logo['width'] / 2; ?>" src="<?php echo $logo['url']; ?>">
						</a>
					</figure>
					<div class="location--col-details">
						<hr class="divider divider--red divider--small hr-divider--location">
						<p><span>A</span> <?php the_field('display_address', $post->ID); ?></p>
						<p><span>P</span> <?php the_field('phone_number', $post->ID); ?></p>
					</div>
				</div>
			</div>

			<?php endwhile; wp_reset_postdata() ?>
		</div>
		
	</div>
</section>


<?php 
get_footer();
