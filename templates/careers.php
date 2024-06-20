<?php

/* Template Name: Careers */

get_header();

$fields = null;

while ( have_posts() ) : the_post();
	$fields = get_fields( $post->ID );
endwhile;
wp_reset_postdata();
?>


	<section class="hero-default hero-careers">
		<div class="inner">

			<?php do_page_headline( $fields['sub_headline'], $fields['main_headline'] ); ?>
			<div class="apply-container" style="display: none">
				<a href="<?php echo $fields['application_link']?>" class="button apply-now"><?php echo $fields['cta_button_text']; ?></a>
			</div>
			<div class="inner-narrow">
				<figure class="img-full-width">
					<img src="<?php echo $fields['image']['sizes']['page_full_width']; ?>"
					     alt="<?php echo $fields['image']['alt']; ?>">
				</figure>

				<div class="introcopy--narrow">
					<?php //var_dump($fields['image']);
					echo $fields['body_text'];
					?>
				</div>

				<div class="apply-container" style="margin-top: 3rem;">
					<a href="<?php echo $fields['application_link']?>" class="button apply-now"><?php echo $fields['cta_button_text']; ?></a>
				</div>

			</div>
		</div>
	</section>


	<!-- <section class="body-sectiontoggle">
		<div class="inner">

			<div class="button-set">
				<div class="button-set--half">
					<button id="why" class="is-active" data-section-toggle="">Why Work Here</button>
				</div>
				<div class="button-set--half">
					<button id="who" data-section-toggle="">Who We Hire</button>
				</div>
			</div>

		</div>
	</section> -->

<?php // body1 is the default content of the careers page ?>
	<section>
		<!-- <div class="core-values">
			<div class="inner">
				<div class="inner-narrrow">
					<figure class="img-center core-values-image">
						<img src="<?php echo $fields['core_values_image']['url']; ?>">
					</figure>
					<div class="core-values-text-container">
						<h4 class="section--title"><?php echo $fields['core_values_header'] ?></h4>
						<p><?php echo $fields['core_values_text'] ?></p>
						<hr class="divider divider--red">
					</div>
				</div>
			</div>
		</div> -->
		<div class="values-list">
			<div class="inner" style="display: none">
				<?php foreach ( $fields['core_value_fields'] as $value ) { ?>
					<div class="value-item">
						<div class="value-title-container">
							<figure
								class="values-icon-fig"><?php get_template_part( 'partials/icons/' . $value['core_value_icon'] ) ?></figure>
							<h3>
								<?php echo $value['core_value_title'] ?>
							</h3>
							<span class="toggle-icon-container">
								<span class="toggle-icon"></span>
								<span class="toggle-icon"></span>
							</span>
						</div>
						<div class="value-hidden-container">
							<h6><?php echo $value['core_value_subtitle'] ?></h6>
							<?php echo $value['core_value_text'] ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="career--positions" style="margin-top: 5rem;">
				<div class="inner">
					<div class="inner-narrrow"> 
						<div>
							<h3><?php echo $fields['benefits_title'] ?></h3>
							<p><?php echo $fields['benefits_paragraph'] ?></p>
							<hr class="divider divider--red">
						</div>
					</div>
				</div>
			</div>
		</div>
		<section class="block-benefits">
			<div class="inner benefits-inner" style="display: none">
				<div class="inner-narrow">
					<?php
					$count = 0;
					foreach($fields['benefit_columns'] as $value) {
						$count++;
						if($count === 1 || $count === 4) {
							echo '<div class="clear">';
						}
						?>
						<div class="benefit-container col-third">
							<figure class="icon-fig">
								<!--benefit icon-->
								<?php get_template_part( 'partials/icons/' . $value['benefit_icon'] ) ?>
							</figure>
							<h5>
								<?php echo $value['benefit_title']?>
							</h5>
							<ul>
								<?php foreach($value['benefit_details'] as $details) {?>
									<li><?php echo $details['detail_highlight'] ?></li>
								<?php }?>
							</ul>
						</div>
						<?php
						if($count === 3) {
							echo '</div>'; } ?>
					<?php } ?>
					<?php echo '</div>'; ?>
				</div>
			</div>
		</section>

		<section class="rewards-section" style="display: none">
			<div class="inner">
				<div class="inner-narrow">
					<div class="col-seven">
						<h3><?php echo $fields['rewards_section_title']; ?></h3>
						<hr class="divider divider--red">
						<?php echo $fields['rewards_section_paragraphs']; ?>
					</div>
					<div class="careers-image-container col-five">
						<figure>
							<img
								src="<?php echo $fields['rewards_section_image']['sizes']['careers_page_image']; ?>">
						</figure>
						<div class="image-container-background"></div>
					</div>
				</div>
			</div>
		</section>
	</section>

<?php // body2 is the content that gets swapped on click of who we hire ?>
	<section class=""> 

		<div id="section-whywehire" class="career--positions">
			<div class="inner">
				<div class="inner-narrow">
					<h3><?php echo $fields['who_we_hire_title']; ?></h3>
					<p><?php echo $fields['who_we_hire_body']; ?></p>
					<hr class="divider divider--red">
				</div>
			</div>

			<div class="inner feature-cols career-inner">
				<?php foreach ( $fields['position_types'] as $key => $value ) { ?>
				<div class="col-fourth" data-in-view>
					<div class="feature-col-content">
						<figure><?php get_template_part( 'partials/icons/' . $value['icon'] ) ?></figure>
						<h4><?php echo $value['name']; ?></h4>
						<ul class="positions-list">
							<?php foreach ( $value['positions_list'] as $nvalue ) { ?>
								<li><?php echo $nvalue['position_name']; ?></li>
								<?php
							}
							echo '</ul>';
							echo '</div>';
							echo '</div>';
							}
							?>
					</div>

					<div class="inner">
						<a href="<?php echo $fields['application_link']?>" class="button positions-button">View Open Positions</a>
					</div>
			</div>

			<section class="careers-eeo">
				<div class="inner">
					<div class="careers-eeo--content">
						<h3 class="eeo-title"><?php echo $fields['equal_opportunity_title']; ?></h3>
						<hr class="divider divider--red">
						<p><?php echo $fields['equal_opportunity_body']; ?></p>
					</div>
				</div>
			</section>

			<section class="block-services home-services">
				<div class="inner">
					<hr class="divider divider--red">
				</div>
				<div class="inner inner--tagline" data-in-view>
					<div class="block-services--tagline">
						<h4><?php echo $fields['office_locations_title'] ?></h4>
						<blockquote><?php echo $fields['office_locations_subheader_text'] ?></blockquote>
					</div>
				</div>
			</section>

			<section class="locations-section">
				<div class="inner"></div>
				<div class="inner">
					<div class="inner-narrow">
						<div class="sidebar">
							<?php
							$count = 0;
							foreach ( $fields['locations_address'] as $key => $value ) {
								$count ++;
								if ( $count < 3 ): ?>
									<div class="locations-tile <?php echo $count ?>">
										<h5 class="section-header tile-header"><?php echo $value['city_name'] ?></h5>
										<hr class="divider divider--red">
										<ul>
											<?php foreach ( $value['location_details'] as $inner_key => $inner_value ) { ?>
												<li><?php echo $inner_value['details'] ?></li>
												<?php
											}
											?>
										</ul>
									</div>

									<?php
								endif;
							}
							?>
						</div>
						<div class="image-container">
							<figure>
								<img
									src="<?php echo $fields['locations_content_image']['sizes']['careers_page_image']; ?>">
							</figure>
							<div class="image-container-background"></div>
						</div>
					</div>
					<div class="inner-narrow">
						<div class="bottom-bar">
							<?php
							$count = 0;
							foreach ( $fields['locations_address'] as $key => $value ) {
								$count ++;
								if ( $count >= 3 ) {
									?>
									<div class="locations-tile col-third">
										<h5 class="tile-header"><?php echo $value['city_name'] ?></h5>
										<hr class="divider divider--red">
										<ul>
											<?php foreach ( $value['location_details'] as $inner_key => $inner_value ) { ?>
												<li><?php echo $inner_value['details'] ?></li>
												<?php
											}
											?>
										</ul>
									</div>

									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</section>
	</section>

	<section class="cta-banner">
		<div class="inner careers-inner">
			<div class="inner-narrow">
				<div>
					<h4 class="join-us-title"><?php echo $fields['cta_title']; ?></h4>
					<p><?php echo $fields['cta_text']; ?></p>
					<a href="<?php echo $fields['application_link']?>" class="button apply-now"><?php echo $fields['cta_button_text']; ?></a>
				</div>
			</div>
		</div>
		<div id="particles-js"></div>
	</section>

	<section class="block-services">
		<div class="inner inner--tagline" data-in-view>
			<div class="block-services--tagline">
				<h4><?php echo $fields['testimonials_title'] ?></h4>
				<div class="carousel" data-flickity>
					<?php foreach ( $fields['testimonials'] as $testimonial ) { ?>
						<div class="carousel-cell">
							<div class="carousel-inner">
								<blockquote><?php echo $testimonial['quote']; ?></blockquote>
								<figure class="testimonial-image-figure">
									<img class="testimonial-image" src="<?php echo $testimonial['headshot']['url']; ?>">
								</figure>
								<div class="testimonial-text-container">
									<h5 class="testimonial-name"><?php echo $testimonial['name']; ?></h5>
									<p class="testimonial-title"><?php echo $testimonial['title']; ?></p>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
?>
